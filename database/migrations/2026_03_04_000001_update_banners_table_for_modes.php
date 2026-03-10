<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            // Mode penanda: default (hero bawaan) atau custom
            $table->boolean('is_default')
                ->default(false)
                ->after('image');

            // Gambar dibuat opsional agar mode default bisa tanpa backdrop
            $table->string('image')->nullable()->change();

            // Batasi panjang judul + deskripsi sesuai requirement (validasi akan mengatur, ini hanya dokumentatif)
            $table->string('title', 255)->change();
            $table->text('subtitle')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('is_default');

            // Kembalikan ke definisi awal (wajib gambar)
            $table->string('image')->nullable(false)->change();
        });
    }
};

