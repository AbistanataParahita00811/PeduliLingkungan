@extends('layouts.app_public')

@section('title', 'Event — Peduli Lingkungan')

@section('content')
<section class="pt-28 pb-16 min-h-screen">
    <div class="max-w-6xl mx-auto px-4">
        <span class="section-eyebrow text-leaf">Event</span>
        <h1 class="font-heading text-3xl md:text-4xl mt-2 text-forest">Daftar Event</h1>

        <form method="GET" class="mt-6 flex gap-2">
            <select name="category" class="text-sm border rounded-lg px-3 py-2" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach(\App\Models\Event::where('is_active', true)->distinct()->pluck('category') as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </form>

        <div class="grid md:grid-cols-3 gap-6 mt-8">
            @forelse($events as $event)
                <a href="{{ route('events.show', $event->slug) }}" class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                    @if($event->poster)
                        <img src="{{ asset('storage/'.$event->poster) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover group-hover:scale-[1.03] transition">
                    @endif
                    <div class="p-4">
                        <span class="text-xs text-leaf">{{ $event->category }}</span>
                        <h2 class="font-semibold text-forest mt-1">{{ $event->title }}</h2>
                        <p class="text-xs text-moss/80 mt-1">{{ $event->event_date?->translatedFormat('d F Y') }} · {{ $event->location }}</p>
                    </div>
                </a>
            @empty
                <p class="col-span-3 text-moss/80">Belum ada event.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $events->withQueryString()->links() }}</div>
    </div>
</section>
@endsection
