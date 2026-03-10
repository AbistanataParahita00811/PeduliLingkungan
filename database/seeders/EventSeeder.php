<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'Tanam Pohon di Taman Kota',
                'slug' => 'tanam-pohon-di-taman-kota',
                'description' => 'Ajak masyarakat untuk menanam pohon di taman kota dalam rangka menjaga kelestarian lingkungan.',
                'content' => null,
                'poster' => null,
                'event_date' => now()->addDays(7)->toDateString(),
                'event_time' => '08:00',
                'location' => 'Taman Kota Purbalingga',
                'category' => 'Tanam Pohon',
                'tags' => json_encode(['lingkungan', 'tanam-pohon', 'hijau']),
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Edukasi Daur Ulang Sampah',
                'slug' => 'edukasi-daur-ulang-sampah',
                'description' => 'Workshop tentang cara mendaur ulang sampah rumah tangga menjadi barang berguna.',
                'content' => null,
                'poster' => null,
                'event_date' => now()->addDays(14)->toDateString(),
                'event_time' => '09:00',
                'location' => 'Balai Desa Purbalingga',
                'category' => 'Edukasi',
                'tags' => json_encode(['daur-ulang', 'sampah', 'edukasi']),
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'title' => 'Bersih-Bersih Sungai',
                'slug' => 'bersih-bersih-sungai',
                'description' => 'Aksi bersih sungai dari sampah untuk menjaga kebersihan air dan ekosistem.',
                'content' => null,
                'poster' => null,
                'event_date' => now()->addDays(21)->toDateString(),
                'event_time' => '07:00',
                'location' => 'Sungai Klawing',
                'category' => 'Bersih Lingkungan',
                'tags' => json_encode(['sungai', 'bersih', 'aksi']),
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Gerakan Tanam Pohon di Sekolah',
                'slug' => 'gerakan-tanam-pohon-di-sekolah',
                'description' => 'Mengajak siswa-siswa sekolah untuk menanam pohon di lingkungan sekolah.',
                'content' => null,
                'poster' => null,
                'event_date' => now()->addDays(28)->toDateString(),
                'event_time' => '08:30',
                'location' => 'SD Negeri 1 Purbalingga',
                'category' => 'Tanam Pohon',
                'tags' => json_encode(['sekolah', 'tanam-pohon', 'pendidikan']),
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'title' => 'Seminar Lingkungan Hidup',
                'slug' => 'seminar-lingkungan-hidup',
                'description' => 'Seminar tentang pentingnya menjaga lingkungan hidup untuk generasi mendatang.',
                'content' => null,
                'poster' => null,
                'event_date' => now()->addDays(35)->toDateString(),
                'event_time' => '10:00',
                'location' => 'Gedung Serba Guna Purbalingga',
                'category' => 'Edukasi',
                'tags' => json_encode(['seminar', 'lingkungan', 'edukasi']),
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        foreach ($events as $event) {
            $event['tags'] = is_string($event['tags']) ? $event['tags'] : json_encode($event['tags']);
            DB::table('events')->insert(array_merge($event, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
