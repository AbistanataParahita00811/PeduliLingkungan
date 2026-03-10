<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Banner 1',
                'subtitle' => 'Subtitle untuk banner pertama',
                'image' => 'banners/placeholder1.jpg',
                'button_text' => 'Lihat Selengkapnya',
                'button_url' => '#',
                'is_active' => true,
                'order_index' => 0,
            ],
            [
                'title' => 'Banner 2',
                'subtitle' => 'Subtitle untuk banner kedua',
                'image' => 'banners/placeholder2.jpg',
                'button_text' => 'Gabung Sekarang',
                'button_url' => '#',
                'is_active' => true,
                'order_index' => 1,
            ],
            [
                'title' => 'Banner 3',
                'subtitle' => 'Subtitle untuk banner ketiga',
                'image' => 'banners/placeholder3.jpg',
                'button_text' => null,
                'button_url' => null,
                'is_active' => true,
                'order_index' => 2,
            ],
        ];

        foreach ($banners as $banner) {
            DB::table('banners')->insert(array_merge($banner, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
