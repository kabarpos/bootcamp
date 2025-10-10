<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DripsenderWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $expectedToken = Setting::get('whatsapp_webhook_token');

        if ($expectedToken) {
            $provided = $request->header('X-Webhook-Token') ?? $request->input('token');

            if (! hash_equals($expectedToken, (string) $provided)) {
                Log::warning('Invalid Dripsender webhook token received');
                return response()->json(['status' => 'INVALID_TOKEN'], 403);
            }
        }

        Log::info('Dripsender webhook payload', [
            'event' => $request->input('event'),
            'body' => $request->all(),
        ]);

        return response()->json(['status' => 'RECEIVED', 'timestamp' => now()->toIso8601String()]);
    }
}
