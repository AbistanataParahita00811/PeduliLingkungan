@extends('admin.layouts.dashboard')

@section('page_title', 'Edit Event')

@push('head')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.flatpickr) {
                flatpickr('[data-datepicker]', {
                    dateFormat: 'Y-m-d',
                    defaultDate: '{{ $event->event_date?->format('Y-m-d') }}',
                });
                flatpickr('[data-timepicker]', {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: 'H:i',
                    time_24hr: true,
                    defaultDate: '{{ $event->event_time }}',
                });
            }

            if (window.tinymce) {
                tinymce.init({
                    selector: 'textarea[name=content]',
                    plugins: 'advlist autolink lists link image charmap preview anchor ' +
                        'searchreplace visualblocks code fullscreen insertdatetime ' +
                        'media table help wordcount',
                    toolbar: 'undo redo | blocks | bold italic forecolor | ' +
                        'alignleft aligncenter alignright alignjustify | ' +
                        'bullist numlist outdent indent | removeformat | help',
                    menubar: false,
                    height: 450,
                    content_style: 'body { font-family: DM Sans, sans-serif; font-size: 16px; }',
                    branding: false,
                });
            }

            const titleInput = document.querySelector('input[name=title]');
            const slugInput = document.querySelector('input[name=slug]');
            if (titleInput && slugInput) {
                titleInput.addEventListener('input', () => {
                    if (slugInput.dataset.userEdited === 'true') return;
                    slugInput.value = titleInput.value
                        .toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/(^-|-$)+/g, '');
                });
                slugInput.addEventListener('input', () => {
                    slugInput.dataset.userEdited = 'true';
                });
            }
        });
    </script>
@endpush

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-base font-semibold text-forest">Edit Event</h1>
    </div>

    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm p-4 space-y-4">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-[1.3fr_1fr] gap-4">
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}" class="w-full text-xs border rounded-md px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $event->slug) }}" class="w-full text-xs border rounded-md px-3 py-2" data-user-edited="true">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Deskripsi Singkat (maks 200 karakter)</label>
                    <textarea name="description" rows="3" maxlength="200" class="w-full text-xs border rounded-md px-3 py-2">{{ old('description', $event->description) }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Konten Lengkap</label>
                    <textarea name="content" rows="6" class="w-full text-xs border rounded-md px-3 py-2">{{ old('content', $event->content) }}</textarea>
                </div>

                <div class="grid md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Tanggal Event</label>
                        <input type="text" name="event_date" value="{{ old('event_date', $event->event_date?->format('Y-m-d')) }}" data-datepicker class="w-full text-xs border rounded-md px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Jam Event</label>
                        <input type="text" name="event_time" value="{{ old('event_time', $event->event_time) }}" data-timepicker class="w-full text-xs border rounded-md px-3 py-2">
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $event->location) }}" class="w-full text-xs border rounded-md px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Kategori</label>
                        <input type="text" name="category" value="{{ old('category', $event->category) }}" class="w-full text-xs border rounded-md px-3 py-2" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Tags (pisahkan dengan koma)</label>
                    <input type="text" name="tags_input" value="{{ old('tags_input', $event->tags ? implode(', ', $event->tags) : '') }}" class="w-full text-xs border rounded-md px-3 py-2" placeholder="tanam pohon, edukasi, gratis">
                </div>

                <div class="flex flex-wrap gap-4 pt-2">
                    <label class="inline-flex items-center gap-2 text-xs text-gray-700">
                        <input type="checkbox" name="is_featured" value="1" class="rounded border-gray-300" @checked(old('is_featured', $event->is_featured))>
                        Featured
                    </label>
                    <label class="inline-flex items-center gap-2 text-xs text-gray-700">
                        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" @checked(old('is_active', $event->is_active))>
                        Aktif
                    </label>
                    <label class="inline-flex items-center gap-2 text-xs text-gray-700">
                        <input type="checkbox" name="show_in_navbar" value="1" class="rounded border-gray-300" @checked(old('show_in_navbar', $event->show_in_navbar ?? false))>
                        Tampilkan di Navbar
                    </label>
                </div>

                <div class="card-admin mt-6" x-data="{ hasPopup: {{ old('has_popup', $event->has_popup ?? false) ? 'true' : 'false' }} }">
                    <h3 class="font-semibold text-forest text-base mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#7ecb5f]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 
                                     9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 
                                     3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 
                                     0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 
                                     0a8.969 8.969 0 0 1 2.168 4.5" />
                        </svg>
                        Popup Informasi Event
                    </h3>

                    <div class="flex items-start gap-4 p-4 bg-[#f5f0e8] rounded-xl border border-[#b8e994]/50">
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Tampilkan sebagai Popup</label>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Jika diaktifkan, popup akan muncul otomatis 3 detik setelah pengunjung
                                membuka website. Hanya 1 popup aktif yang ditampilkan (event terdekat).
                            </p>
                        </div>
                        <div class="flex-shrink-0 mt-1">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="has_popup" value="0">
                                <input
                                    type="checkbox"
                                    name="has_popup"
                                    value="1"
                                    x-model="hasPopup"
                                    {{ old('has_popup', $event->has_popup ?? false) ? 'checked' : '' }}
                                    class="sr-only peer"
                                >
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer 
                                            peer-checked:bg-[#7ecb5f] peer-focus:ring-2 
                                            peer-focus:ring-[#7ecb5f]/30 transition-colors
                                            after:content-[''] after:absolute after:top-[2px] 
                                            after:left-[2px] after:bg-white after:rounded-full 
                                            after:h-5 after:w-5 after:transition-all 
                                            peer-checked:after:translate-x-full"></div>
                            </label>
                        </div>
                    </div>

                    <div x-show="hasPopup" x-transition class="mt-4 space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1" for="popup_redirect_url">
                                URL Redirect Popup (opsional)
                            </label>
                            <p class="text-xs text-gray-500 mb-2">
                                Jika diisi, tombol utama pada popup akan mengarah ke URL ini
                                (misalnya form pendaftaran atau link Instagram).
                            </p>
                            <input
                                type="url"
                                name="popup_redirect_url"
                                id="popup_redirect_url"
                                value="{{ old('popup_redirect_url', $event->popup_redirect_url ?? '') }}"
                                placeholder="https://contoh.com/form-pendaftaran"
                                class="input-field flex-1 text-xs border rounded-md px-3 py-2"
                            >
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Poster Event</label>
                <div x-data="{ previewUrl: '{{ $event->poster ? asset('storage/'.$event->poster) : '' }}' }" class="border border-dashed border-gray-300 rounded-2xl p-3 flex flex-col items-center justify-center gap-2 text-xs text-gray-500">
                    <template x-if="previewUrl">
                        <img :src="previewUrl" alt="Preview" class="w-full h-40 object-cover rounded-xl mb-2">
                    </template>
                    <input
                        type="file"
                        name="poster"
                        accept="image/*"
                        class="block w-full text-xs"
                        @change="const file = $event.target.files[0]; if(file){ previewUrl = URL.createObjectURL(file); }"
                    >
                    <p class="mt-1 text-[11px] text-gray-500">Opsional, format JPG/PNG/WebP, maksimal 2MB.</p>
                </div>
            </div>
        </div>

        <div class="pt-2 flex justify-end gap-2">
            <a href="{{ route('admin.events.index') }}" class="px-3 py-2 rounded-lg border border-gray-200 text-xs">Batal</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-forest text-cream text-xs font-semibold">
                Simpan Perubahan
            </button>
        </div>
    </form>
@endsection

