<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmailSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole('admin') ?? false;
    }

    public function rules(): array
    {
        $enabled = $this->boolean('enabled');

        return [
            'enabled' => ['required', 'boolean'],
            'smtp_host' => [$enabled ? 'required' : 'nullable', 'string', 'max:255'],
            'smtp_port' => [$enabled ? 'required' : 'nullable', 'integer'] ,
            'smtp_username' => [$enabled ? 'required' : 'nullable', 'string', 'max:255'],
            'smtp_password' => [$enabled ? 'required' : 'nullable', 'string', 'max:255'],
            'from_name' => [$enabled ? 'required' : 'nullable', 'string', 'max:255'],
            'from_address' => [$enabled ? 'required' : 'nullable', 'email'],
            'api_endpoint' => ['nullable', 'url'],
            'api_login' => ['nullable', 'string', 'max:255'],
            'api_token' => ['nullable', 'string', 'max:255'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'enabled' => $this->boolean('enabled'),
            'smtp_port' => $this->input('smtp_port') !== null ? (int) $this->input('smtp_port') : null,
        ]);
    }
}
