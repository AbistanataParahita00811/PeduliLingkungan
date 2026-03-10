@extends('admin.layouts.dashboard')

@section('page_title', 'Edit Testimonial')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-base font-semibold text-forest">Edit Testimonial</h1>
    </div>

    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm p-4 space-y-4">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-[1.3fr_1fr] gap-4">
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" class="w-full text-xs border rounded-md px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Peran / Jabatan</label>
                    <input type="text" name="role" value="{{ old('role', $testimonial->role) }}" class="w-full text-xs border rounded-md px-3 py-2">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Quote</label>
                    <textarea name="quote" rows="4" class="w-full text-xs border rounded-md px-3 py-2" required>{{ old('quote', $testimonial->quote) }}</textarea>
                </div>

                <div class="flex items-center gap-2 pt-2">
                    <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" @checked(old('is_active', $testimonial->is_active))>
                    <span class="text-xs text-gray-700">Tampilkan di homepage</span>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Avatar (opsional)</label>
                <div x-data="{ previewUrl: '{{ $testimonial->image_url }}' }" class="border border-dashed border-gray-300 rounded-2xl p-3 flex flex-col items-center justify-center gap-2 text-xs text-gray-500">
                    <template x-if="previewUrl">
                        <img :src="previewUrl" alt="Preview" class="w-20 h-20 object-cover rounded-full mb-2">
                    </template>
                    <input
                        type="file"
                        name="avatar"
                        accept="image/*"
                        class="block w-full text-xs"
                        @change="const file = $event.target.files[0]; if(file){ previewUrl = URL.createObjectURL(file); }"
                    >
                    <p class="mt-1 text-[11px] text-gray-500">Format JPG/PNG/WebP, maksimal 2MB.</p>
                </div>
            </div>
        </div>

        <div class="pt-2 flex justify-end gap-2">
            <a href="{{ route('admin.testimonials.index') }}" class="px-3 py-2 rounded-lg border border-gray-200 text-xs">Batal</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-forest text-cream text-xs font-semibold">
                Simpan Perubahan
            </button>
        </div>
    </form>
@endsection

