@extends('layouts.app_public')

@section('title', 'Galeri — Peduli Lingkungan')

@section('content')
<section class="pt-28 pb-16 min-h-screen">
    <div class="max-w-6xl mx-auto px-4">
        <x-back-button href="{{ route('home') }}" label="Kembali ke Beranda" />
        <span class="section-eyebrow text-leaf">Galeri</span>
        <h1 class="font-heading text-3xl md:text-4xl mt-2 text-forest">Momen di Lapangan</h1>

        <form method="GET" class="mt-6 flex gap-2">
            <select name="event" class="text-sm border rounded-lg px-3 py-2" onchange="this.form.submit()">
                <option value="">Semua Event</option>
                @foreach(\App\Models\Event::where('is_active', true)->orderBy('event_date')->get() as $ev)
                    <option value="{{ $ev->id }}" {{ request('event') == $ev->id ? 'selected' : '' }}>{{ $ev->title }}</option>
                @endforeach
            </select>
        </form>

        <div class="grid md:grid-cols-4 gap-4 mt-8">
            @forelse($galleries as $item)
                <div class="rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                    <img
                        src="{{ asset('storage/'.$item->image) }}"
                        alt="{{ $item->title }}"
                        class="w-full h-48 object-cover group-hover:scale-[1.03] transition"
                    >
                    <div class="p-3 bg-white">
                        <p class="text-xs text-moss/80">{{ $item->activity_date?->translatedFormat('d F Y') ?? '-' }}</p>
                        <p class="font-medium text-sm text-forest">{{ $item->title }}</p>
                    </div>
                </div>
            @empty
                <p class="col-span-4 text-moss/80">Belum ada foto galeri.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $galleries->withQueryString()->links() }}</div>
    </div>
</section>
@endsection
