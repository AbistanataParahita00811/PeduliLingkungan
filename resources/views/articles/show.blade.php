@extends('layouts.app_public')

@section('title', $article->title . ' — Peduli Lingkungan')

@section('content')
<section class="pt-28 pb-16 min-h-screen">
    <div class="max-w-3xl mx-auto px-4">
        <x-back-button href="{{ route('articles.index') }}" label="Kembali ke Artikel" />

        @if($article->thumbnail)
            <img src="{{ asset('storage/'.$article->thumbnail) }}" alt="{{ $article->title }}" class="w-full rounded-2xl shadow-lg mb-6">
        @endif

        <h1 class="font-heading text-3xl md:text-4xl text-forest">{{ $article->title }}</h1>
        <p class="text-sm text-moss/80 mt-2">{{ $article->author ?? 'Tim Peduli Lingkungan' }} · {{ $article->published_at?->translatedFormat('d F Y') }}</p>

        <div class="prose prose-lg max-w-none mt-6
                    prose-headings:font-heading prose-headings:text-forest
                    prose-a:text-leaf prose-strong:text-forest
                    prose-li:text-muted prose-p:text-muted prose-p:leading-relaxed
                    prose-img:rounded-xl prose-img:shadow-md
                    prose-blockquote:border-leaf prose-blockquote:bg-cream
                    prose-blockquote:rounded-r-xl prose-blockquote:py-1">
            {!! $article->content !!}
        </div>

        @if($related->isNotEmpty())
            <h2 class="font-heading text-xl mt-12 mb-4">Artikel Terkait</h2>
            <div class="grid md:grid-cols-3 gap-4">
                @foreach($related as $r)
                    <a href="{{ route('articles.show', $r->slug) }}" class="block p-3 rounded-xl bg-white shadow-sm hover:shadow transition">{{ $r->title }}</a>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
