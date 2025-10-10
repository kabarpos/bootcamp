<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecordingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole('admin') ?? false;
    }

    public function rules(): array
    {
        return [
            'batch_id' => ['required', 'exists:batch,id'],
            'title' => ['required', 'string', 'max:255'],
            'youtube_url' => ['required', 'url', 'max:2048'],
            'description' => ['nullable', 'string'],
            'recorded_at' => ['nullable', 'date'],
            'position' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['boolean'],
        ];
    }
}
