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
        return (bool) Setting::get('whatsapp_enabled', false) && ! empty($this->getApiKey());
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
            ])->post($this->apiBaseUrl . '/message/send', [
                'sender' => $sender,
                'number' => $normalized,
                'type' => 'text',
                'text' => $message,
            ]);

            if (! $response->successful()) {
                Log::error('Failed to send WhatsApp message', [
                    'status' => $response->status(),
                    'body' => $response->body(),
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
