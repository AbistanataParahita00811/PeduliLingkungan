@extends('admin.layouts.dashboard')

@section('page_title', 'Tambah Foto Galeri')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-base font-semibold text-forest">Tambah Foto Galeri</h1>
    </div>

    <form
        action="{{ request('mode') === 'bulk' ? route('admin.galleries.bulk-upload') : route('admin.galleries.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white rounded-2xl shadow-sm p-4 space-y-4"
        x-data="{ previewUrl: null }"
    >
        @csrf

        @if(request('mode') === 'bulk')
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Upload Banyak Foto</label>
                <input type="file" name="images[]" multiple class="block w-full text-xs" accept="image/*">
                <p class="mt-1 text-[11px] text-gray-500">Maksimal 10 file sekaligus, ukuran maksimal 2MB per file.</p>
            </div>
        @else
            <div class="grid md:grid-cols-[1.3fr_1fr] gap-4">
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Judul</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="w-full text-xs border rounded-md px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Caption (opsional)</label>
                        <textarea name="caption" rows="3" class="w-full text-xs border rounded-md px-3 py-2">{{ old('caption') }}</textarea>
                    </div>
                    <div class="grid md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Terkait Event (opsional)</label>
                            <select name="event_id" class="w-full text-xs border rounded-md px-3 py-2">
                                <option value="">— Pilih Event —</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}" @selected(old('event_id') == $event->id)>
                                        {{ $event->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Tanggal Kegiatan</label>
                            <input
                                type="date"
                                name="activity_date"
                                value="{{ old('activity_date') }}"
                                class="w-full text-xs border rounded-md px-3 py-2"
                            >
                        </div>
                    </div>
                    <div class="grid md:grid-cols-3 gap-3">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_featured" value="1" class="rounded border-gray-300" @checked(old('is_featured'))>
                            <span class="text-xs text-gray-700">Tandai sebagai featured</span>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Urutan (opsional)</label>
                            <input type="number" name="order_index" value="{{ old('order_index', 0) }}" class="w-full text-xs border rounded-md px-3 py-2">
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Gambar</label>
                    <div class="border border-dashed border-gray-300 rounded-2xl p-3 flex flex-col items-center justify-center gap-2 text-xs text-gray-500">
                        <template x-if="previewUrl">
                            <img :src="previewUrl" alt="Preview" class="w-full h-40 object-cover rounded-xl mb-2">
                        </template>
                        <input
                            type="file"
                            name="image"
                            accept="image/*"
                            class="block w-full text-xs"
                            required
                            @change="const file = $event.target.files[0]; if(file){ previewUrl = URL.createObjectURL(file); }"
                        >
                        <p class="mt-1 text-[11px] text-gray-500">Format JPG/PNG/WebP, maksimal 2MB.</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="pt-2 flex justify-end gap-2">
            <a href="{{ route('admin.galleries.index') }}" class="px-3 py-2 rounded-lg border border-gray-200 text-xs">Batal</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-forest text-cream text-xs font-semibold">
                Simpan
            </button>
        </div>
    </form>
@endsection

