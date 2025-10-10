<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\WhatsappTemplate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class WhatsappNotificationService
{
    protected string $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = Setting::get('whatsapp_api_base_url', 'https://app.dripsender.id/api/v1');
    }

    public function enabled(): bool
    {
        $enabled = Setting::get('whatsapp_enabled', false);

        $enabled = is_bool($enabled)
            ? $enabled
            : filter_var($enabled, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        return (bool) $enabled && ! empty($this->getApiKey());
    }

    public function sendTemplate(string $templateKey, string $phoneNumber, array $payload): bool
    {
        if (! $this->enabled()) {
            Log::debug('WhatsApp notification skipped - feature disabled');
            return false;
        }

        $template = WhatsappTemplate::where('key', $templateKey)->where('is_active', true)->first();

        if (! $template) {
            Log::warning('WhatsApp template not found or inactive', ['template' => $templateKey]);
            return false;
        }

        $message = $this->interpolateContent($template->content, $payload);

        return $this->sendMessage($phoneNumber, $message);
    }

    public function diagnoseConnection(?string $apiKey = null, ?string $baseUrl = null): array
    {
        $apiKey = $apiKey ?? $this->getApiKey();
        $baseUrl = rtrim($baseUrl ?? $this->apiBaseUrl, '/');

        if (! $baseUrl) {
            return [
                'ok' => false,
                'code' => 'missing_base_url',
                'message' => 'Base URL Dripsender belum dikonfigurasi.',
            ];
        }

        if (! $apiKey) {
            return [
                'ok' => false,
                'code' => 'missing_api_key',
                'message' => 'API key Dripsender belum diisi.',
            ];
        }

        try {
            Http::timeout(5)
                ->connectTimeout(5)
                ->withOptions(['http_errors' => false])
                ->get($baseUrl);
        } catch (\Throwable $throwable) {
            return [
                'ok' => false,
                'code' => 'connection_error',
                'message' => sprintf(
                    'Tidak dapat terhubung ke %s (%s).',
                    $baseUrl,
                    $throwable->getMessage()
                ),
            ];
        }

        $endpoints = ['/me', '/profile', '/device'];
        $lastResponse = null;

        foreach ($endpoints as $endpoint) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Accept' => 'application/json',
                ])
                    ->timeout(10)
                    ->connectTimeout(5)
                    ->retry(1, 500)
                    ->withOptions(['http_errors' => false])
                    ->get($baseUrl . $endpoint);
            } catch (\Throwable $throwable) {
                return [
                    'ok' => false,
                    'code' => 'connection_error',
                    'message' => sprintf(
                        'Gagal menghubungi endpoint %s (%s).',
                        $endpoint,
                        $throwable->getMessage()
                    ),
                ];
            }

            if ($response->status() === 401) {
                return [
                    'ok' => false,
                    'code' => 'invalid_api_key',
                    'message' => 'API key Dripsender ditolak (HTTP 401). Periksa kembali API key pada dashboard.',
                ];
            }

            if ($response->status() === 403) {
                return [
                    'ok' => false,
                    'code' => 'forbidden',
                    'message' => 'Dripsender menolak akses (HTTP 403). Pastikan akun memiliki izin yang benar.',
                ];
            }

            if ($response->successful()) {
                return [
                    'ok' => true,
                    'code' => 'ok',
                    'message' => 'Koneksi ke Dripsender berhasil diverifikasi.',
                ];
            }

            if ($response->status() >= 500) {
                return [
                    'ok' => false,
                    'code' => 'server_error',
                    'message' => 'Dripsender mengembalikan status ' . $response->status() . '. Coba lagi beberapa saat lagi.',
                ];
            }

            $lastResponse = $response;
        }

        if ($lastResponse) {
            return [
                'ok' => false,
                'code' => 'unrecognized_response',
                'message' => sprintf(
                    'Tidak dapat memverifikasi API key. Respons terakhir: HTTP %s - %s',
                    $lastResponse->status(),
                    Str::limit($lastResponse->body() ?? '', 200)
                ),
            ];
        }

        return [
            'ok' => false,
            'code' => 'unknown',
            'message' => 'Tidak dapat memverifikasi koneksi Dripsender.',
        ];
    }

    protected function interpolateContent(string $content, array $payload): string
    {
        return preg_replace_callback('/{{\\s*(.*?)\\s*}}/', function ($matches) use ($payload) {
            $key = $matches[1];
            return $payload[$key] ?? $matches[0];
        }, $content);
    }

    protected function sendMessage(string $phoneNumber, string $message): bool
    {
        $apiKey = $this->getApiKey();
        $sender = Setting::get('whatsapp_sender_number');

        if (empty($sender)) {
            Log::warning('WhatsApp sender number not configured');
            return false;
        }

        $normalized = $this->normalizePhoneNumber($phoneNumber);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
            ])
                ->timeout(15)
                ->connectTimeout(5)
                ->retry(2, 500)
                ->withOptions(['http_errors' => false])
                ->post($this->apiBaseUrl . '/message/send', [
                'sender' => $sender,
                'number' => $normalized,
                'type' => 'text',
                'text' => $message,
            ]);

            if (! $response->successful()) {
                Log::error('Failed to send WhatsApp message', [
                    'status' => $response->status(),
                    'body' => Str::limit($response->body(), 500),
                ]);
                return false;
            }

            return true;
        } catch (\Throwable $throwable) {
            Log::error('WhatsApp notification exception', [
                'message' => $throwable->getMessage(),
            ]);
            return false;
        }
    }

    protected function normalizePhoneNumber(string $phoneNumber): string
    {
        $phoneNumber = preg_replace('/[^0-9+]/', '', $phoneNumber);

        if (Str::startsWith($phoneNumber, '0')) {
            return '62' . substr($phoneNumber, 1);
        }

        if (! Str::startsWith($phoneNumber, ['62', '+62'])) {
            return ltrim($phoneNumber, '+');
        }

        return ltrim($phoneNumber, '+');
    }

    protected function getApiKey(): ?string
    {
        return Setting::get('whatsapp_api_key');
    }
}
