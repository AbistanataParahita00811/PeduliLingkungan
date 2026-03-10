@extends('admin.layouts.dashboard')

@section('page_title', 'Pengaturan Situs')

@section('content')
    <h1 class="text-base font-semibold text-forest mb-4">Pengaturan Situs</h1>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="bg-white rounded-2xl shadow-sm p-4 space-y-4">
        @csrf

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-xs font-semibold text-gray-600 mb-2 uppercase tracking-[0.18em]">Kontak & Sosial</h2>

                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Link Grup WhatsApp</label>
                        <input type="url" name="wa_group_link" value="{{ old('wa_group_link', setting('wa_group_link')) }}" class="w-full text-xs border rounded-md px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nomor WA Kontak</label>
                        <input type="text" name="wa_phone" value="{{ old('wa_phone', setting('wa_phone')) }}" class="w-full text-xs border rounded-md px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">URL Instagram</label>
                        <input type="url" name="instagram_url" value="{{ old('instagram_url', setting('instagram_url')) }}" class="w-full text-xs border rounded-md px-3 py-2">
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-xs font-semibold text-gray-600 mb-2 uppercase tracking-[0.18em]">Hero Section</h2>
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Followers</label>
                        <input type="text" name="hero_stats_followers" value="{{ old('hero_stats_followers', setting('hero_stats_followers', '1.193+')) }}" class="w-full text-xs border rounded-md px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Jumlah Aksi</label>
                        <input type="text" name="hero_stats_actions" value="{{ old('hero_stats_actions', setting('hero_stats_actions', '86')) }}" class="w-full text-xs border rounded-md px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Tahun Berdiri</label>
                        <input type="text" name="hero_stats_since" value="{{ old('hero_stats_since', setting('hero_stats_since', '2025')) }}" class="w-full text-xs border rounded-md px-3 py-2">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-2 flex justify-end">
            <button type="submit" class="px-4 py-2 rounded-lg bg-forest text-cream text-xs font-semibold">
                Simpan Pengaturan
            </button>
        </div>
    </form>
@endsection

