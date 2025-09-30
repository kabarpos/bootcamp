<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole('admin') ?? false;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'batch_id' => ['required', 'exists:batch,id'],
            'referral_id' => ['nullable', 'exists:users,id'],
            'status' => ['required', 'in:pending,confirmed,cancelled,completed'],
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'user',
            'batch_id' => 'batch',
            'referral_id' => 'referral',
        ];
    }
}
