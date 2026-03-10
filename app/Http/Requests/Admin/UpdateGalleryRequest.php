<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'caption' => ['nullable', 'string'],
            'event_id' => ['nullable', 'exists:events,id'],
            'activity_date' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_featured' => ['sometimes', 'boolean'],
            'order_index' => ['nullable', 'integer', 'min:0'],
        ];
    }
}

