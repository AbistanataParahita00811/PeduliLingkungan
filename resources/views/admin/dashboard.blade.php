@extends('admin.layouts.dashboard')

@section('page_title', 'Dashboard')

@section('content')
    <div class="grid md:grid-cols-4 gap-4 mb-8">
        <div class="rounded-2xl bg-white p-4 shadow-sm">
            <p class="text-[11px] uppercase tracking-[0.18em] text-gray-500 mb-2">Total Event</p>
            <p class="font-heading text-2xl text-forest">{{ $totalEvents }}</p>
        </div>
        <div class="rounded-2xl bg-white p-4 shadow-sm">
            <p class="text-[11px] uppercase tracking-[0.18em] text-gray-500 mb-2">Event Mendatang</p>
            <p class="font-heading text-2xl text-forest">{{ $upcomingEvents }}</p>
        </div>
        <div class="rounded-2xl bg-white p-4 shadow-sm">
            <p class="text-[11px] uppercase tracking-[0.18em] text-gray-500 mb-2">Total Foto</p>
            <p class="font-heading text-2xl text-forest">{{ $totalPhotos }}</p>
        </div>
        <div class="rounded-2xl bg-white p-4 shadow-sm">
            <p class="text-[11px] uppercase tracking-[0.18em] text-gray-500 mb-2">Total Artikel</p>
            <p class="font-heading text-2xl text-forest">{{ $totalArticles }}</p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl p-4 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-sm font-semibold text-forest">Event Terdekat</h2>
                <a href="{{ route('admin.events.index') }}" class="text-[11px] text-leaf">Lihat semua</a>
            </div>
            <table class="w-full text-xs">
                <thead>
                <tr class="text-gray-500 text-[11px] border-b">
                    <th class="py-2 text-left">Tanggal</th>
                    <th class="py-2 text-left">Judul</th>
                    <th class="py-2 text-left">Lokasi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($nextEvents as $event)
                    <tr class="border-b last:border-0">
                        <td class="py-2 text-gray-700">
                            {{ $event->event_date?->format('d/m') }}
                        </td>
                        <td class="py-2 text-forest">
                            {{ $event->title }}
                        </td>
                        <td class="py-2 text-gray-600">
                            {{ $event->location }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-3 text-center text-gray-500">
                            Belum ada event mendatang.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-sm font-semibold text-forest">Artikel Terbaru</h2>
                <a href="{{ route('admin.articles.index') }}" class="text-[11px] text-leaf">Lihat semua</a>
            </div>
            <table class="w-full text-xs">
                <thead>
                <tr class="text-gray-500 text-[11px] border-b">
                    <th class="py-2 text-left">Judul</th>
                    <th class="py-2 text-left">Kategori</th>
                    <th class="py-2 text-left">Tanggal</th>
                </tr>
                </thead>
                <tbody>
                @forelse($latestArticles as $article)
                    <tr class="border-b last:border-0">
                        <td class="py-2 text-forest">
                            {{ $article->title }}
                        </td>
                        <td class="py-2 text-gray-600">
                            {{ $article->category ?? '-' }}
                        </td>
                        <td class="py-2 text-gray-700">
                            {{ $article->published_at?->format('d/m/Y') ?? 'Draft' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-3 text-center text-gray-500">
                            Belum ada artikel.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

