<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class ProcessEnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'batch_id' => ['required', 'exists:batch,id'],
            'terms' => ['accepted'],
        ];
    }

    public function attributes(): array
    {
        return [
            'batch_id' => 'batch',
            'terms' => 'terms and conditions',
        ];
    }
}
