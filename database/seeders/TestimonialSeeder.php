<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Budi Santoso',
                'role' => 'Warga Purbalingga',
                'quote' => 'Gerakan Peduli Lingkungan sangat inspiratif. Saya dan keluarga ikut merasakan manfaatnya.',
                'avatar' => null,
                'is_active' => true,
                'order_index' => 0,
            ],
            [
                'name' => 'Siti Aminah',
                'role' => 'Pengurus RT',
                'quote' => 'Program tanam pohon dan bersih lingkungan membuat lingkungan kami semakin asri.',
                'avatar' => null,
                'is_active' => true,
                'order_index' => 1,
            ],
            [
                'name' => 'Ahmad Rizki',
                'role' => 'Relawan Lingkungan',
                'quote' => 'Saya bangga bisa berkontribusi melalui kegiatan peduli lingkungan. Mari kita jaga bumi bersama.',
                'avatar' => null,
                'is_active' => true,
                'order_index' => 2,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            DB::table('testimonials')->insert(array_merge($testimonial, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
