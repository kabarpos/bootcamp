<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateWhatsappSettingsRequest;
use App\Models\Setting;
use App\Models\WhatsappTemplate;
use App\Services\WhatsappNotificationService;
use Illuminate\Http\Request;

class WhatsappSettingsController extends Controller
{
    public function edit()
    {
        $enabledSetting = Setting::get('whatsapp_enabled', false);
        $enabled = is_bool($enabledSetting)
            ? $enabledSetting
            : filter_var($enabledSetting, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        $settings = [
            'enabled' => (bool) $enabled,
            'api_key' => Setting::get('whatsapp_api_key'),
            'sender_number' => Setting::get('whatsapp_sender_number'),
            'webhook_token' => Setting::get('whatsapp_webhook_token'),
            'api_base_url' => Setting::get('whatsapp_api_base_url', 'https://app.dripsender.com/api/v3'),
            'message_endpoint' => Setting::get('whatsapp_message_endpoint', 'messages/send'),
        ];

        $templates = WhatsappTemplate::orderBy('name')->get();

        return view('admin.settings.whatsapp', compact('settings', 'templates'));
    }

    public function update(UpdateWhatsappSettingsRequest $request)
    {
        $data = $request->validated();

        Setting::set('whatsapp_enabled', $data['enabled']);
        Setting::set('whatsapp_api_key', $data['api_key']);
        Setting::set('whatsapp_sender_number', $data['sender_number']);
        Setting::set('whatsapp_webhook_token', $data['webhook_token']);
        Setting::set('whatsapp_api_base_url', $data['api_base_url'] ?? 'https://app.dripsender.com/api/v3');
        Setting::set('whatsapp_message_endpoint', $data['message_endpoint'] ?? 'messages/send');

        $message = 'Pengaturan WhatsApp berhasil disimpan.';

        if ($data['enabled']) {
            $service = app(WhatsappNotificationService::class);
            $diagnosis = $service->diagnoseConnection(
                $data['api_key'] ?? null,
                $data['api_base_url'] ?? null
            );

            if (! $diagnosis['ok']) {
                Setting::set('whatsapp_enabled', false);

                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['api_key' => $diagnosis['message']])
                    ->with('error', 'Gagal mengaktifkan WhatsApp: ' . $diagnosis['message']);
            }

            $message .= ' ' . $diagnosis['message'];
        }

        return redirect()->route('admin.settings.whatsapp.edit')
            ->with('success', $message);
    }

    public function testConnection(Request $request)
    {
        $service = app(WhatsappNotificationService::class);
        $diagnosis = $service->diagnoseConnection();

        if (! $diagnosis['ok']) {
            return redirect()
                ->route('admin.settings.whatsapp.edit')
                ->withErrors(['api_key' => $diagnosis['message']])
                ->with('error', 'Tes koneksi WhatsApp gagal: ' . $diagnosis['message']);
        }

        return redirect()
            ->route('admin.settings.whatsapp.edit')
            ->with('success', 'Koneksi ke Dripsender berhasil.');
    }

    public function editTemplate(WhatsappTemplate $template)
    {
        return view('admin.settings.whatsapp-template-edit', compact('template'));
    }

    public function updateTemplate(Request $request, WhatsappTemplate $template)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $placeholders = $this->extractPlaceholders($validated['content']);

        $template->update([
            'name' => $validated['name'],
            'content' => $validated['content'],
            'is_active' => $request->boolean('is_active', true),
            'placeholders' => $placeholders,
        ]);

        return redirect()->route('admin.settings.whatsapp.edit')
            ->with('success', 'Template WhatsApp berhasil diperbarui.');
    }

    private function extractPlaceholders(string $content): array
    {
        preg_match_all('/{{\s*(.*?)\s*}}/', $content, $matches);

        return array_values(array_unique($matches[1] ?? []));
    }
}
