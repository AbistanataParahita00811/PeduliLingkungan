<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            SiteSettingSeeder::class,
            BannerSeeder::class,
            EventSeeder::class,
            TestimonialSeeder::class,
            GallerySeeder::class,
        ]);
    }
}
