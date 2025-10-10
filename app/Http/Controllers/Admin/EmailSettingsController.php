<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateEmailSettingsRequest;
use App\Models\EmailTemplate;
use App\Models\Setting;
use Illuminate\Http\Request;

class EmailSettingsController extends Controller
{
    public function edit()
    {
        $settings = [
            'enabled' => (bool) Setting::get('email_enabled', false),
            'smtp_host' => Setting::get('email_smtp_host'),
            'smtp_port' => Setting::get('email_smtp_port'),
            'smtp_username' => Setting::get('email_smtp_username'),
            'smtp_password' => Setting::get('email_smtp_password'),
            'from_name' => Setting::get('email_from_name', config('mail.from.name')),
            'from_address' => Setting::get('email_from_address', config('mail.from.address')),
            'api_endpoint' => Setting::get('email_api_endpoint'),
            'api_login' => Setting::get('email_api_login'),
            'api_token' => Setting::get('email_api_token'),
        ];

        $templates = EmailTemplate::orderBy('name')->get();

        return view('admin.settings.email', compact('settings', 'templates'));
    }

    public function update(UpdateEmailSettingsRequest $request)
    {
        $data = $request->validated();

        Setting::set('email_enabled', $data['enabled']);
        Setting::set('email_smtp_host', $data['smtp_host']);
        Setting::set('email_smtp_port', $data['smtp_port']);
        Setting::set('email_smtp_username', $data['smtp_username']);
        Setting::set('email_smtp_password', $data['smtp_password']);
        Setting::set('email_from_name', $data['from_name']);
        Setting::set('email_from_address', $data['from_address']);
        Setting::set('email_api_endpoint', $data['api_endpoint']);
        Setting::set('email_api_login', $data['api_login']);
        Setting::set('email_api_token', $data['api_token']);

        return redirect()->route('admin.settings.email.edit')
            ->with('success', 'Pengaturan email berhasil disimpan.');
    }

    public function editTemplate(EmailTemplate $template)
    {
        return view('admin.settings.email-template-edit', compact('template'));
    }

    public function updateTemplate(Request $request, EmailTemplate $template)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $placeholders = $this->extractPlaceholders($validated['subject'] . ' ' . $validated['content']);

        $template->update([
            'name' => $validated['name'],
            'subject' => $validated['subject'],
            'content' => $validated['content'],
            'is_active' => $request->boolean('is_active', true),
            'placeholders' => $placeholders,
        ]);

        return redirect()->route('admin.settings.email.edit')
            ->with('success', 'Template email berhasil diperbarui.');
    }

    private function extractPlaceholders(string $content): array
    {
        preg_match_all('/{{\s*(.*?)\s*}}/', $content, $matches);

        return array_values(array_unique($matches[1] ?? []));
    }
}
