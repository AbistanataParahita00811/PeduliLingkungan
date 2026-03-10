<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Mode
            'is_default' => ['sometimes', 'boolean'],

            // Custom banner fields (semua opsional di mode custom)
            'title' => ['nullable', 'string', 'max:150'],
            'subtitle' => ['nullable', 'string', 'max:300'],
            // max dalam kilobyte (15 MB = 15360 KB)
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:15360'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string'],

            // Status & urutan
            'is_active' => ['nullable', 'boolean'],
            'order_index' => ['nullable', 'integer'],
        ];
    }
}
