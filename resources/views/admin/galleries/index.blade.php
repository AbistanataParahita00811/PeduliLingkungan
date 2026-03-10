@extends('admin.layouts.dashboard')

@section('page_title', 'Galeri')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-base font-semibold text-forest">Galeri</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.galleries.create') }}" class="px-3 py-2 rounded-lg bg-forest text-cream text-xs font-semibold">
                + Tambah Foto
            </a>
            <a href="{{ route('admin.galleries.create') }}?mode=bulk" class="px-3 py-2 rounded-lg border border-forest/20 text-xs text-forest">
                Upload Massal
            </a>
        </div>
    </div>

    <div
        class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"
        x-data
        x-init="
            if (window.Sortable) {
                Sortable.create($el, {
                    animation: 150,
                    onEnd: function () {
                        const orders = {};
                        $el.querySelectorAll('[data-id]').forEach((item, index) => {
                            orders[item.dataset.id] = index;
                        });
                        fetch('{{ route('admin.galleries.reorder') }}', {
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
        @forelse($galleries as $gallery)
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden group cursor-move" data-id="{{ $gallery->id }}">
                <div class="relative">
                    <img src="{{ asset('storage/'.$gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-40 object-cover group-hover:scale-[1.03] transition">
                    @if($gallery->is_featured)
                        <span class="absolute top-2 left-2 px-2 py-1 rounded-full bg-lime text-[10px] text-forest font-semibold">
                            Featured
                        </span>
                    @endif
                </div>
                <div class="p-3 space-y-1 text-xs">
                    <p class="font-semibold text-forest line-clamp-1">{{ $gallery->title }}</p>
                    <p class="text-gray-500 text-[11px]">
                        {{ $gallery->activity_date?->format('d/m/Y') ?? 'Tanggal tidak diisi' }}
                    </p>
                    <div class="flex justify-between items-center pt-2">
                        <div class="text-[11px] text-gray-500">Urutan: {{ $gallery->order_index }}</div>
                        <div class="flex gap-1">
                            <a href="{{ route('admin.galleries.edit', $gallery) }}" class="px-2 py-1 rounded-md border border-gray-200 text-[11px]">Edit</a>
                            <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 rounded-md border border-red-200 text-[11px] text-red-600">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-500">
                Belum ada foto galeri. Tambahkan minimal satu foto untuk mengisi section galeri di homepage.
            </p>
        @endforelse
    </div>
@endsection

