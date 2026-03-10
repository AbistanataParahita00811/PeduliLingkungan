<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'poster' => ['nullable', 'image', 'max:2048'],
            'event_date' => ['required', 'date'],
            'event_time' => ['nullable', 'string'],
            'location' => ['required', 'string'],
            'category' => ['required', 'string'],
            'tags' => ['nullable', 'array'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'has_popup' => ['nullable', 'boolean'],
            'popup_image_url' => ['nullable', 'url', 'max:500'],
        ];
    }
}
