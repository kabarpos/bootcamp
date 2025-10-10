<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWhatsappSettingsRequest extends FormRequest
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
            'api_key' => [$enabled ? 'required' : 'nullable', 'string'],
            'sender_number' => [$enabled ? 'required' : 'nullable', 'string'],
            'webhook_token' => ['nullable', 'string'],
            'api_base_url' => ['nullable', 'url'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'enabled' => $this->boolean('enabled'),
        ]);
    }
}
