@extends('layouts.app_public')

@section('title', 'Artikel — Peduli Lingkungan')

@section('content')
<section class="pt-28 pb-16 min-h-screen">
    <div class="max-w-6xl mx-auto px-4">
        <span class="section-eyebrow text-leaf">Artikel</span>
        <h1 class="font-heading text-3xl md:text-4xl mt-2 text-forest">Artikel & Insight</h1>

        <div class="grid md:grid-cols-3 gap-6 mt-8">
            @forelse($articles as $article)
                <a href="{{ route('articles.show', $article->slug) }}" class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                    @if($article->thumbnail)
                        <img src="{{ asset('storage/'.$article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover group-hover:scale-[1.03] transition">
                    @endif
                    <div class="p-4">
                        <h2 class="font-semibold text-forest">{{ $article->title }}</h2>
                        <p class="text-xs text-moss/80 mt-1 line-clamp-2">{{ $article->excerpt }}</p>
                        <p class="text-xs text-moss/60 mt-2">{{ $article->published_at?->translatedFormat('d F Y') }}</p>
                    </div>
                </a>
            @empty
                <p class="col-span-3 text-moss/80">Belum ada artikel.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $articles->links() }}</div>
    </div>
</section>
@endsection
