@extends('admin.layouts.dashboard')

@section('page_title', 'Tambah Artikel')

@push('head')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.flatpickr) {
                flatpickr('[data-publish-date]', {
                    enableTime: true,
                    dateFormat: 'Y-m-d H:i',
                    time_24hr: true,
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
        <h1 class="text-base font-semibold text-forest">Tambah Artikel</h1>
    </div>

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm p-4 space-y-4">
        @csrf

        <div class="grid md:grid-cols-[1.3fr_1fr] gap-4">
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Judul</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="w-full text-xs border rounded-md px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Slug (otomatis)</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" class="w-full text-xs border rounded-md px-3 py-2" data-user-edited="false">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Excerpt (maks 300 karakter)</label>
                    <textarea name="excerpt" rows="3" maxlength="300" class="w-full text-xs border rounded-md px-3 py-2">{{ old('excerpt') }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Konten</label>
                    <textarea name="content" rows="6" class="w-full text-xs border rounded-md px-3 py-2">{{ old('content') }}</textarea>
                </div>

                <div class="grid md:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Kategori</label>
                        <input type="text" name="category" value="{{ old('category') }}" class="w-full text-xs border rounded-md px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Penulis</label>
                        <input type="text" name="author" value="{{ old('author', 'Admin') }}" class="w-full text-xs border rounded-md px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Tanggal Publish</label>
                        <input type="text" name="published_at" value="{{ old('published_at') }}" data-publish-date class="w-full text-xs border rounded-md px-3 py-2">
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-2">
                    <input type="checkbox" name="is_published" value="1" class="rounded border-gray-300" @checked(old('is_published'))>
                    <span class="text-xs text-gray-700">Langsung publish</span>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Thumbnail</label>
                <div x-data="{ previewUrl: null }" class="border border-dashed border-gray-300 rounded-2xl p-3 flex flex-col items-center justify-center gap-2 text-xs text-gray-500">
                    <template x-if="previewUrl">
                        <img :src="previewUrl" alt="Preview" class="w-full h-40 object-cover rounded-xl mb-2">
                    </template>
                    <input
                        type="file"
                        name="thumbnail"
                        accept="image/*"
                        class="block w-full text-xs"
                        @change="const file = $event.target.files[0]; if(file){ previewUrl = URL.createObjectURL(file); }"
                    >
                    <p class="mt-1 text-[11px] text-gray-500">Opsional, format JPG/PNG/WebP, maksimal 2MB.</p>
                </div>
            </div>
        </div>

        <div class="pt-2 flex justify-end gap-2">
            <a href="{{ route('admin.articles.index') }}" class="px-3 py-2 rounded-lg border border-gray-200 text-xs">Batal</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-forest text-cream text-xs font-semibold">
                Simpan Artikel
            </button>
        </div>
    </form>
@endsection

