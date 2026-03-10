<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::query()
            ->orderBy('group')
            ->orderBy('id')
            ->get()
            ->groupBy('group');

        return view('admin.settings.index', compact('settings'));
    }

    public function update(UpdateSettingRequest $request)
    {
        $data = $request->validated();

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'label' => ucfirst(str_replace('_', ' ', $key)),
                    'group' => $this->detectGroup($key),
                ]
            );

            Cache::forget("site_setting_{$key}");
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan situs berhasil disimpan.');
    }

    protected function detectGroup(string $key): string
    {
        return match (true) {
            str_starts_with($key, 'wa_'),
            str_contains($key, 'instagram') => 'contact',
            str_starts_with($key, 'hero_') => 'hero',
            str_starts_with($key, 'about_') => 'about',
            default => 'general',
        };
    }
}

