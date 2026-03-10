<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $eventId = DB::table('events')->first()?->id;

        $galleries = [
            [
                'title' => 'Galeri 1',
                'image' => 'galleries/placeholder1.jpg',
                'caption' => 'Caption untuk galeri pertama',
                'event_id' => $eventId,
                'is_featured' => true,
                'order_index' => 0,
            ],
            [
                'title' => 'Galeri 2',
                'image' => 'galleries/placeholder2.jpg',
                'caption' => 'Caption untuk galeri kedua',
                'event_id' => $eventId,
                'is_featured' => false,
                'order_index' => 1,
            ],
            [
                'title' => 'Galeri 3',
                'image' => 'galleries/placeholder3.jpg',
                'caption' => null,
                'event_id' => null,
                'is_featured' => true,
                'order_index' => 2,
            ],
            [
                'title' => 'Galeri 4',
                'image' => 'galleries/placeholder4.jpg',
                'caption' => 'Caption untuk galeri keempat',
                'event_id' => $eventId,
                'is_featured' => false,
                'order_index' => 3,
            ],
            [
                'title' => 'Galeri 5',
                'image' => 'galleries/placeholder5.jpg',
                'caption' => null,
                'event_id' => null,
                'is_featured' => false,
                'order_index' => 4,
            ],
            [
                'title' => 'Galeri 6',
                'image' => 'galleries/placeholder6.jpg',
                'caption' => 'Caption untuk galeri keenam',
                'event_id' => $eventId,
                'is_featured' => true,
                'order_index' => 5,
            ],
        ];

        foreach ($galleries as $gallery) {
            DB::table('galleries')->insert(array_merge($gallery, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
