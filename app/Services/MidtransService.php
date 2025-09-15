<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    protected $serverKey;
    protected $clientKey;
    protected $isProduction;
    protected $baseUrl;

    public function __construct()
    {
        $this->serverKey = config('midtrans.server_key');
        $this->clientKey = config('midtrans.client_key');
        $this->isProduction = config('midtrans.is_production', false);
        $this->baseUrl = $this->isProduction ? 
            'https://app.midtrans.com' : 
            'https://app.sandbox.midtrans.com';
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
            $response = Http::withBasicAuth($this->serverKey, '')
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->post("{$this->baseUrl}/snap/v1/transactions", [
                    'transaction_details' => $transactionDetails,
                    'credit_card' => [
                        'secure' => true,
                    ],
                ]);

            if ($response->successful()) {
                $result = $response->json();
                return $result['token'] ?? null;
            } else {
                Log::error('Midtrans Snap Token Error', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Token Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
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
        $transactionStatus = $notification['transaction_status'];
        $fraudStatus = $notification['fraud_status'];
        $orderId = $notification['order_id'];

        $status = 'pending';

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $status = 'challenge';
            } elseif ($fraudStatus == 'accept') {
                $status = 'paid';
            }
        } elseif ($transactionStatus == 'settlement') {
            $status = 'paid';
        } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $status = 'failed';
        }

        return [
            'order_id' => $orderId,
            'status' => $status,
            'transaction_status' => $transactionStatus,
            'fraud_status' => $fraudStatus,
        ];
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
        return $this->isProduction ? 
            'https://app.midtrans.com/snap/snap.js' : 
            'https://app.sandbox.midtrans.com/snap/snap.js';
    }
}