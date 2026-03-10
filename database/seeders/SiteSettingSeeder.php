<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['wa_group_link', 'https://chat.whatsapp.com/Lo7XaVcbPi68DXbW212FX4', 'url', 'WhatsApp Group Link', 'contact'],
            ['wa_phone', '0812-2942-8356', 'text', 'WhatsApp Phone', 'contact'],
            ['instagram_url', 'https://instagram.com/pedullingkungan', 'url', 'Instagram URL', 'contact'],
            ['address', 'Purbalingga, Jawa Tengah, Indonesia', 'textarea', 'Alamat', 'contact'],
            ['hero_stats_followers', '1.193+', 'text', 'Hero Stats Followers', 'hero'],
            ['hero_stats_actions', '86', 'text', 'Hero Stats Actions', 'hero'],
            ['hero_stats_since', '2025', 'text', 'Hero Stats Since', 'hero'],
            ['hero_tagline', 'Bergabung bersama generasi muda yang peduli bumi.', 'textarea', 'Hero Tagline', 'hero'],
            ['about_vision', 'Menjadi komunitas pemuda terdepan di Purbalingga yang menginspirasi gerakan hijau dengan aksi nyata berkelanjutan.', 'textarea', 'Visi', 'about'],
            ['about_mission', 'Menggerakkan pemuda untuk aksi lingkungan nyata: tanam pohon, edukasi sekolah, bersih sungai, zero waste.', 'textarea', 'Misi', 'about'],
            ['meta_title', 'Peduli Lingkungan — Hijaukan Aksimu, Pedulikan Sekitarmu', 'text', 'Meta Title', 'seo'],
            ['meta_description', 'Komunitas pemuda peduli lingkungan di Purbalingga. Bergabung dan wujudkan aksi hijau nyata.', 'textarea', 'Meta Description', 'seo'],
        ];

        foreach ($settings as $setting) {
            DB::table('site_settings')->updateOrInsert(
                ['key' => $setting[0]],
                [
                    'key' => $setting[0],
                    'value' => $setting[1],
                    'type' => $setting[2],
                    'label' => $setting[3],
                    'group' => $setting[4],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
