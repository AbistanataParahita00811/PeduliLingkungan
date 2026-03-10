@extends('admin.layouts.dashboard')

@section('page_title', 'Banner')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-base font-semibold text-forest">Banner</h1>
        <a href="{{ route('admin.banners.create') }}" class="px-3 py-2 rounded-lg bg-forest text-cream text-xs font-semibold">
            + Tambah Banner
        </a>
    </div>

    <div
        class="bg-white rounded-2xl shadow-sm p-4 space-y-4"
        x-data
        x-init="
            if (window.Sortable) {
                Sortable.create($refs.bannerList, {
                    animation: 150,
                    handle: '.handle',
                    onEnd: function () {
                        const orders = {};
                        $refs.bannerList.querySelectorAll('[data-id]').forEach((item, index) => {
                            orders[item.dataset.id] = index;
                        });
                        fetch('{{ route('admin.banners.reorder') }}', {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ orders }),
                        });
                    },
                });
            }
        "
    >
        <div class="flex items-center justify-between text-xs text-gray-600">
            <p>
                Maksimal <span class="font-semibold text-forest">4 banner aktif</span>.  
                Banner dapat menggunakan <span class="font-semibold">Mode Default</span> (hero bawaan) atau
                <span class="font-semibold">Mode Custom</span> (judul & CTA sendiri).
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead>
                <tr class="text-gray-500 text-[11px] border-b">
                    <th class="py-2 text-left w-6"></th>
                    <th class="py-2 text-left">Preview</th>
                    <th class="py-2 text-left">Mode</th>
                    <th class="py-2 text-left">Judul / Deskripsi</th>
                    <th class="py-2 text-left">CTA</th>
                    <th class="py-2 text-left">Status</th>
                    <th class="py-2 text-right">Aksi</th>
                </tr>
                </thead>
                <tbody x-ref="bannerList">
                @forelse($banners as $i => $banner)
                    <tr class="border-b last:border-0" data-id="{{ $banner->id }}">
                        <td class="py-2 align-top">
                            <button type="button" class="handle cursor-move text-gray-400 hover:text-gray-600">
                                ⋮⋮
                            </button>
                        </td>
                        <td class="py-2 align-top">
                            @if($banner->image_url)
                                <img src="{{ $banner->image_url }}" alt="Banner" class="w-16 h-16 object-cover rounded-md border border-gray-200">
                            @else
                                <div class="w-16 h-16 rounded-md border border-dashed border-gray-300 flex items-center justify-center text-[10px] text-gray-400">
                                    Tanpa gambar
                                </div>
                            @endif
                            <div class="mt-1 text-[11px] text-gray-500">
                                Urutan: {{ $i + 1 }}
                            </div>
                        </td>
                        <td class="py-2 align-top">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-[10px] {{ $banner->is_default ? 'bg-moss/10 text-moss' : 'bg-leaf/10 text-forest' }}">
                                {{ $banner->is_default ? 'Mode Default (Hero Bawaan)' : 'Mode Custom' }}
                            </span>
                        </td>
                        <td class="py-2 align-top text-forest">
                            @if($banner->is_default)
                                <p class="text-xs text-gray-600">
                                    Menggunakan teks hero bawaan homepage.  
                                    Gambar (jika diisi) hanya sebagai backdrop.
                                </p>
                            @else
                                <div class="space-y-1">
                                    <p class="font-semibold line-clamp-1">
                                        {{ $banner->title ?? 'Tanpa judul' }}
                                    </p>
                                    @if($banner->subtitle)
                                        <p class="text-[11px] text-gray-600 line-clamp-2">
                                            {{ $banner->subtitle }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td class="py-2 align-top">
                            @if($banner->button_text)
                                <div class="space-y-1 text-[11px]">
                                    <p class="font-semibold text-forest">
                                        {{ $banner->button_text }}
                                    </p>
                                    @if($banner->button_url)
                                        <p class="text-gray-500 break-all">
                                            {{ $banner->button_url }}
                                        </p>
                                    @endif
                                </div>
                            @else
                                <span class="text-[11px] text-gray-400">Tidak ada CTA</span>
                            @endif
                        </td>
                        <td class="py-2 align-top">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-[10px] {{ $banner->is_active ? 'bg-leaf/20 text-forest' : 'bg-gray-100 text-gray-500' }}">
                                {{ $banner->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                            <div class="mt-2">
                                <x-admin.toggle-switch
                                    :url="route('admin.banners.toggle', $banner)"
                                    :checked="$banner->is_active"
                                />
                            </div>
                        </td>
                        <td class="py-2 align-top text-right">
                            <div class="inline-flex gap-1">
                                <a href="{{ route('admin.banners.edit', $banner) }}" class="px-2 py-1 rounded-md border border-gray-200 text-[11px]">
                                    Edit
                                </a>
                                <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" onsubmit="return confirm('Hapus banner ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 rounded-md border border-red-200 text-[11px] text-red-600">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 text-center text-gray-500">
                            Belum ada banner. Tambahkan minimal satu banner untuk mengisi hero section di homepage.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

