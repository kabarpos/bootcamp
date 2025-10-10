<?php

namespace App\Services;

use App\Models\EmailTemplate;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailNotificationService
{
    public function enabled(): bool
    {
        return (bool) Setting::get('email_enabled', false);
    }

    public function sendTemplate(string $templateKey, string $email, array $payload = []): bool
    {
        if (! $this->enabled()) {
            Log::debug('Email notification skipped - feature disabled');
            return false;
        }

        $template = EmailTemplate::where('key', $templateKey)->where('is_active', true)->first();

        if (! $template) {
            Log::warning('Email template not found or inactive', ['template' => $templateKey]);
            return false;
        }

        $subject = $this->interpolate($template->subject, $payload);
        $body = $this->interpolate($template->content, $payload);

        try {
            Mail::send([], [], function ($message) use ($email, $subject, $body) {
                $message->to($email)->subject($subject);
                $message->html($this->formatHtmlBody($body));
                $message->text($this->formatTextBody($body));
            });

            if (method_exists(Mail::getFacadeRoot(), 'failures') && count(Mail::failures()) > 0) {
                Log::error('Email sending failed', ['email' => $email, 'template' => $templateKey]);
                return false;
            }

            return true;
        } catch (\Throwable $throwable) {
            Log::error('Email notification exception', [
                'message' => $throwable->getMessage(),
                'template' => $templateKey,
            ]);
            return false;
        }
    }

    protected function interpolate(string $content, array $payload): string
    {
        return preg_replace_callback('/{{\\s*(.*?)\\s*}}/', function ($matches) use ($payload) {
            $key = $matches[1];
            return $payload[$key] ?? $matches[0];
        }, $content);
    }

    protected function formatHtmlBody(string $body): string
    {
        $escaped = e($body);
        $withBreaks = nl2br($escaped, false);

        return '<div style="font-family:Arial, sans-serif; font-size:14px; line-height:1.6; color:#1f2937;">' .
            $withBreaks .
            '</div>';
    }

    protected function formatTextBody(string $body): string
    {
        $normalized = preg_replace("/\r\n|\r|\n/", PHP_EOL, $body);

        return trim(strip_tags($normalized));
    }
}
