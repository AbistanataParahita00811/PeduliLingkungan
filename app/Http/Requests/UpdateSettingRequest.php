<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'wa_group_link' => ['nullable', 'url'],
            'wa_phone' => ['nullable', 'string'],
            'instagram_url' => ['nullable', 'url'],
            'address' => ['nullable', 'string'],
            'hero_stats_followers' => ['nullable', 'string'],
            'hero_stats_actions' => ['nullable', 'string'],
            'hero_stats_since' => ['nullable', 'string'],
            'hero_tagline' => ['nullable', 'string'],
            'about_vision' => ['nullable', 'string'],
            'about_mission' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
        ];
    }
}
