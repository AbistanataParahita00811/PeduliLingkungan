<?php

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        $cacheKey = "site_setting_{$key}";

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($key, $default) {
            return SiteSetting::where('key', $key)->value('value') ?? $default;
        });
    }
}

