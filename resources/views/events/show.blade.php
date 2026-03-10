@extends('layouts.app_public')

@section('title', $event->title . ' — Peduli Lingkungan')

@section('content')
<section class="pt-28 pb-16 min-h-screen">
    <div class="max-w-3xl mx-auto px-4">
        <x-back-button href="{{ route('events.index') }}" label="Kembali ke Event" />

        @if($event->poster)
            <img src="{{ asset('storage/'.$event->poster) }}" alt="{{ $event->title }}" class="w-full rounded-2xl shadow-lg mb-6">
        @endif

        <span class="text-xs text-leaf">{{ $event->category }}</span>
        <h1 class="font-heading text-3xl md:text-4xl text-forest mt-1">{{ $event->title }}</h1>
        <p class="text-sm text-moss/80 mt-2">{{ $event->event_date?->translatedFormat('d F Y') }} · {{ $event->location }}</p>

        <div class="prose prose-lg max-w-none mt-6
                    prose-headings:font-heading prose-headings:text-forest
                    prose-a:text-leaf prose-strong:text-forest
                    prose-li:text-muted prose-p:text-muted prose-p:leading-relaxed">
            {!! $event->content ?: nl2br(e($event->description)) !!}
        </div>

        @if($related->isNotEmpty())
            <h2 class="font-heading text-xl mt-12 mb-4">Event Terkait</h2>
            <div class="grid md:grid-cols-3 gap-4">
                @foreach($related as $r)
                    <a href="{{ route('events.show', $r->slug) }}" class="block p-3 rounded-xl bg-white shadow-sm hover:shadow transition">{{ $r->title }}</a>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
