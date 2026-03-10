@extends('admin.layouts.dashboard')

@section('page_title', 'Event')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-base font-semibold text-forest">Event</h1>
        <a href="{{ route('admin.events.create') }}" class="px-3 py-2 rounded-lg bg-forest text-cream text-xs font-semibold">
            + Tambah Event
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-4 space-y-3">
        <form method="GET" class="flex flex-wrap gap-3 items-center text-xs mb-2">
            <div>
                <label class="mr-1 text-gray-600">Status:</label>
                <select name="status" class="border rounded-md px-2 py-1">
                    <option value="">Semua</option>
                    <option value="upcoming" @selected(request('status') === 'upcoming')>Mendatang</option>
                    <option value="past" @selected(request('status') === 'past')>Selesai</option>
                </select>
            </div>
            <button type="submit" class="px-2 py-1 rounded-md border border-gray-200">Filter</button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead>
                <tr class="text-gray-500 text-[11px] border-b">
                    <th class="py-2 text-left">Poster</th>
                    <th class="py-2 text-left">Judul</th>
                    <th class="py-2 text-left">Tanggal</th>
                    <th class="py-2 text-left">Lokasi</th>
                    <th class="py-2 text-left">Kategori</th>
                    <th class="py-2 text-left">Featured</th>
                    <th class="py-2 text-left">Popup</th>
                    <th class="py-2 text-left">Status</th>
                    <th class="py-2 text-right">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($events as $event)
                    <tr class="border-b last:border-0">
                        <td class="py-2">
                            @if($event->poster)
                                <img src="{{ asset('storage/'.$event->poster) }}" alt="{{ $event->title }}" class="w-12 h-12 object-cover rounded-md">
                            @endif
                        </td>
                        <td class="py-2 text-forest">
                            {{ $event->title }}
                        </td>
                        <td class="py-2 text-gray-700">
                            {{ $event->event_date?->format('d/m/Y') }}
                        </td>
                        <td class="py-2 text-gray-600">
                            {{ $event->location }}
                        </td>
                        <td class="py-2 text-gray-600">
                            {{ $event->category }}
                        </td>
                        <td class="py-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-[10px] {{ $event->is_featured ? 'bg-lime/20 text-forest' : 'bg-gray-100 text-gray-500' }}">
                                {{ $event->is_featured ? 'Ya' : 'Tidak' }}
                            </span>
                        </td>
                        <td class="py-2 text-center">
                            @if($event->has_popup && $event->popup_image_url)
                                <span class="inline-flex items-center gap-1 bg-[#b8e994] text-[#1a3a2a] text-[10px] font-bold px-2 py-1 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3">
                                        <path d="M4.214 3.227a.75.75 0 0 0-1.156-.956 8.97 8.97 0 0 0-1.856 
                                                   3.826.75.75 0 1 0 1.466.316 7.47 7.47 0 0 1 1.546-3.186ZM16.942 
                                                   2.271a.75.75 0 0 0-1.157.956 7.47 7.47 0 0 1 1.547 3.186.75.75 
                                                   0 1 0 1.466-.316 8.97 8.97 0 0 0-1.856-3.826ZM10 2a6 6 0 0 0-6 
                                                   6v1.372l-.886 1.771A1 1 0 0 0 4 12.5h.105a3.914 3.914 0 0 0 
                                                   -.105.5 3 3 0 1 0 6 0 3.93 3.93 0 0 0-.105-.5H16a1 1 0 0 0 
                                                   .886-1.457L16 9.372V8a6 6 0 0 0-6-6Z"/>
                                    </svg>
                                    Aktif
                                </span>
                            @elseif($event->has_popup)
                                <span class="text-[10px] text-yellow-600 font-medium">No URL</span>
                            @else
                                <span class="text-[10px] text-gray-300">—</span>
                            @endif
                        </td>
                        <td class="py-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-[10px] {{ $event->is_active ? 'bg-leaf/20 text-forest' : 'bg-gray-100 text-gray-500' }}">
                                {{ $event->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="py-2 text-right">
                            <div class="inline-flex gap-1">
                                <a href="{{ route('admin.events.edit', $event) }}" class="px-2 py-1 rounded-md border border-gray-200 text-[11px]">Edit</a>
                                <form action="{{ route('admin.events.toggle-featured', $event) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2 py-1 rounded-md border border-lime/40 text-[11px] text-forest">
                                        {{ $event->is_featured ? 'Unfeatured' : 'Featured' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Hapus event ini?')">
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
                        <td colspan="8" class="py-4 text-center text-gray-500">
                            Belum ada event.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-2">
            {{ $events->links() }}
        </div>
    </div>
@endsection

