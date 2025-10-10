<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMidtransSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole('admin') ?? false;
    }

    public function rules(): array
    {
        $mode = $this->input('mode');

        return [
            'mode' => ['required', 'in:sandbox,production'],
            'sandbox_server_key' => [
                Rule::requiredIf(fn () => $mode === 'sandbox'),
                'nullable',
                'string',
            ],
            'sandbox_client_key' => [
                Rule::requiredIf(fn () => $mode === 'sandbox'),
                'nullable',
                'string',
            ],
            'production_server_key' => [
                Rule::requiredIf(fn () => $mode === 'production'),
                'nullable',
                'string',
            ],
            'production_client_key' => [
                Rule::requiredIf(fn () => $mode === 'production'),
                'nullable',
                'string',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'mode' => 'mode',
            'sandbox_server_key' => 'sandbox server key',
            'sandbox_client_key' => 'sandbox client key',
            'production_server_key' => 'production server key',
            'production_client_key' => 'production client key',
        ];
    }
}
