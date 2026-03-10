@extends('admin.layouts.dashboard')

@section('page_title', 'Edit Banner')

@section('content')
    <div class="mb-4">
        <h1 class="text-base font-semibold text-forest">Edit Banner</h1>
        <p class="text-xs text-gray-600 mt-1">
            Sesuaikan mode dan konten banner. Perubahan akan mempengaruhi hero di homepage.
        </p>
    </div>

    <form
        action="{{ route('admin.banners.update', $banner) }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white rounded-2xl shadow-sm p-4 space-y-4"
        x-data="{ isDefault: @json((bool) old('is_default', $banner->is_default)) }"
    >
        @csrf
        @method('PUT')

        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 border-b border-gray-100 pb-3">
            <div>
                <h2 class="text-sm font-semibold text-forest">Mode Banner</h2>
                <p class="text-xs text-gray-600 mt-1">
                    Mode default menggunakan teks hero bawaan dan hanya mengatur backdrop.
                    Mode custom menggunakan judul, deskripsi, dan tombol CTA dari banner ini.
                </p>
            </div>
            <label class="inline-flex items-center gap-2 text-xs text-gray-700">
                <input
                    type="checkbox"
                    name="is_default"
                    value="1"
                    class="rounded border-gray-300 text-forest focus:ring-forest"
                    x-model="isDefault"
                >
                <span>Gunakan Tampilan Default</span>
            </label>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">
                        Gambar Banner / Backdrop
                        <span class="font-normal text-gray-500">(maks. 2MB, JPG/PNG/WebP)</span>
                    </label>
                    <x-admin.image-preview name="image" :existing-url="$banner->image_url" />
                    @error('image')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-[11px] text-gray-500" x-show="isDefault">
                        Mode default: gambar opsional. Jika kosong, hero akan menggunakan gradient bawaan.
                    </p>
                    <p class="mt-1 text-[11px] text-gray-500" x-show="!isDefault">
                        Mode custom: disarankan mengisi gambar agar banner lebih menarik.
                    </p>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">
                        Aktifkan Banner
                    </label>
                    <label class="inline-flex items-center gap-2 text-xs text-gray-700">
                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            class="rounded border-gray-300 text-forest focus:ring-forest"
                            {{ old('is_active', $banner->is_active) ? 'checked' : '' }}
                        >
                        <span>Banner aktif dan ikut rotasi (maks. 4 aktif sekaligus)</span>
                    </label>
                    @error('is_active')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">
                        Judul Banner (Mode Custom)
                    </label>
                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $banner->title) }}"
                        maxlength="150"
                        class="w-full rounded-lg border-gray-300 text-sm focus:ring-forest focus:border-forest"
                        :disabled="isDefault"
                    >
                    <p class="mt-1 text-[11px] text-gray-500">
                        Maksimal 150 karakter. Digunakan hanya saat mode custom.
                    </p>
                    @error('title')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">
                        Deskripsi Banner (Mode Custom)
                    </label>
                    <textarea
                        name="subtitle"
                        rows="3"
                        maxlength="300"
                        class="w-full rounded-lg border-gray-300 text-sm focus:ring-forest focus:border-forest"
                        :disabled="isDefault"
                    >{{ old('subtitle', $banner->subtitle) }}</textarea>
                    <p class="mt-1 text-[11px] text-gray-500">
                        Maksimal 300 karakter. Biasanya berisi highlight event / campaign.
                    </p>
                    @error('subtitle')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">
                            Teks Tombol CTA
                        </label>
                        <input
                            type="text"
                            name="button_text"
                            value="{{ old('button_text', $banner->button_text) }}"
                            maxlength="100"
                            class="w-full rounded-lg border-gray-300 text-sm focus:ring-forest focus:border-forest"
                            :disabled="isDefault"
                        >
                        @error('button_text')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">
                            Link Tombol CTA
                        </label>
                        <input
                            type="url"
                            name="button_url"
                            value="{{ old('button_url', $banner->button_url) }}"
                            class="w-full rounded-lg border-gray-300 text-sm focus:ring-forest focus:border-forest"
                            :disabled="isDefault"
                        >
                        @error('button_url')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between pt-2 border-t border-gray-100">
            <a href="{{ route('admin.banners.index') }}" class="text-xs text-gray-600 hover:text-forest">
                ← Kembali ke daftar banner
            </a>
            <button
                type="submit"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-forest text-cream text-xs font-semibold"
            >
                Simpan Perubahan
            </button>
        </div>
    </form>
@endsection

