<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    protected $serverKey;
    protected $clientKey;
    protected $isProduction;
    protected $snapBaseUrl;
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->serverKey = config('midtrans.server_key');
        $this->clientKey = config('midtrans.client_key');
        $this->isProduction = config('midtrans.is_production', false);
        $this->snapBaseUrl = $this->isProduction ?
            'https://app.midtrans.com' :
            'https://app.sandbox.midtrans.com';
        $this->apiBaseUrl = $this->isProduction ?
            'https://api.midtrans.com' :
            'https://api.sandbox.midtrans.com';
    }

    /**
     * Get Snap token from Midtrans
     *
     * @param array $transactionDetails
     * @return string|null
     */
    public function getSnapToken($transactionDetails)
    {
        try {
            Log::debug('Midtrans Snap Token Request', [
                'order_id' => $transactionDetails['order_id'] ?? null,
                'gross_amount' => $transactionDetails['gross_amount'] ?? null,
                'is_production' => $this->isProduction,
            ]);

            $response = Http::withBasicAuth($this->serverKey, '')
                ->timeout(10)
                ->retry(3, 200)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->post("{$this->snapBaseUrl}/snap/v1/transactions", [
                    'transaction_details' => $transactionDetails,
                    'credit_card' => [
                        'secure' => true,
                    ],
                    'callbacks' => [
                        'finish' => route('payment.success.redirect'),
                    ],
                ]);

            if ($response->successful()) {
                $result = $response->json();
                Log::info('Midtrans Snap Token issued', [
                    'order_id' => $transactionDetails['order_id'] ?? null,
                    'redirect_url_present' => isset($result['redirect_url']),
                ]);
                return $result['token'] ?? null;
            } else {
                Log::error('Midtrans Snap Token Error', [
                    'status' => $response->status(),
                    'order_id' => $transactionDetails['order_id'] ?? null,
                ]);
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Token Exception', [
                'message' => $e->getMessage(),
                'order_id' => $transactionDetails['order_id'] ?? null,
            ]);
            return null;
        }
    }

    /**
     * Handle Midtrans notification
     *
     * @param array $notification
     * @return array
     */
    public function handleNotification($notification)
    {
        $transactionStatus = $notification['transaction_status'] ?? 'unknown';
        $fraudStatus = $notification['fraud_status'] ?? 'unknown';
        $orderId = $notification['order_id'] ?? 'unknown';

        $status = match (true) {
            $transactionStatus === 'capture' && $fraudStatus === 'accept' => 'paid',
            $transactionStatus === 'settlement' => 'paid',
            $transactionStatus === 'expire' => 'expired',
            in_array($transactionStatus, ['cancel', 'deny'], true) => 'failed',
            in_array($transactionStatus, ['refund', 'partial_refund'], true) => 'refunded',
            default => 'pending',
        };

        return [
            'order_id' => $orderId,
            'status' => $status,
            'transaction_status' => $transactionStatus,
            'fraud_status' => $fraudStatus,
        ];
    }

    /**
     * Validate Midtrans notification signature.
     */
    public function validateSignature(array $notification): bool
    {
        if (! isset($notification['signature_key'], $notification['order_id'], $notification['status_code'], $notification['gross_amount'])) {
            return false;
        }

        $rawSignature = $notification['order_id'] . $notification['status_code'] . $notification['gross_amount'] . $this->serverKey;
        $expectedSignature = hash('sha512', $rawSignature);

        return hash_equals($expectedSignature, $notification['signature_key']);
    }

    /**
     * Fetch latest transaction status from Midtrans.
     */
    public function getTransactionStatus(string $orderId): ?array
    {
        $url = "{$this->apiBaseUrl}/v2/{$orderId}/status";

        try {
            Log::debug('Midtrans Status Request', ['order_id' => $orderId]);

            $response = Http::withBasicAuth($this->serverKey, '')
                ->timeout(10)
                ->retry(3, 200)
                ->withHeaders([
                    'Accept' => 'application/json',
                ])
                ->get($url);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Midtrans Status Error', [
                'status' => $response->status(),
                'order_id' => $orderId,
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Status Exception', [
                'message' => $e->getMessage(),
                'order_id' => $orderId,
            ]);
        }

        return null;
    }

    /**
     * Get client key for frontend integration
     *
     * @return string
     */
    public function getClientKey()
    {
        return $this->clientKey;
    }

    /**
     * Get Snap.js URL for frontend integration
     *
     * @return string
     */
    public function getSnapJsUrl()
    {
        return "{$this->snapBaseUrl}/snap/snap.js";
    }
}


