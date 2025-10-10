<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateWhatsappSettingsRequest;
use App\Models\Setting;
use App\Models\WhatsappTemplate;
use Illuminate\Http\Request;

class WhatsappSettingsController extends Controller
{
    public function edit()
    {
        $settings = [
            'enabled' => (bool) Setting::get('whatsapp_enabled', false),
            'api_key' => Setting::get('whatsapp_api_key'),
            'sender_number' => Setting::get('whatsapp_sender_number'),
            'webhook_token' => Setting::get('whatsapp_webhook_token'),
            'api_base_url' => Setting::get('whatsapp_api_base_url', 'https://app.dripsender.id/api/v1'),
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
        Setting::set('whatsapp_api_base_url', $data['api_base_url'] ?? 'https://app.dripsender.id/api/v1');

        return redirect()->route('admin.settings.whatsapp.edit')
            ->with('success', 'Pengaturan WhatsApp berhasil disimpan.');
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
