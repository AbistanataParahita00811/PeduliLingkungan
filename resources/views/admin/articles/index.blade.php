@extends('admin.layouts.dashboard')

@section('page_title', 'Artikel')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-base font-semibold text-forest">Artikel</h1>
        <a href="{{ route('admin.articles.create') }}" class="px-3 py-2 rounded-lg bg-forest text-cream text-xs font-semibold">
            + Tambah Artikel
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-4 space-y-3">
        <form method="GET" class="flex flex-wrap gap-3 items-center text-xs mb-2">
            <div>
                <label class="mr-1 text-gray-600">Status:</label>
                <select name="status" class="border rounded-md px-2 py-1">
                    <option value="">Semua</option>
                    <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                    <option value="published" @selected(request('status') === 'published')>Published</option>
                </select>
            </div>
            <button type="submit" class="px-2 py-1 rounded-md border border-gray-200">Filter</button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead>
                <tr class="text-gray-500 text-[11px] border-b">
                    <th class="py-2 text-left">Thumbnail</th>
                    <th class="py-2 text-left">Judul</th>
                    <th class="py-2 text-left">Kategori</th>
                    <th class="py-2 text-left">Status</th>
                    <th class="py-2 text-left">Tanggal Publish</th>
                    <th class="py-2 text-right">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($articles as $article)
                    <tr class="border-b last:border-0">
                        <td class="py-2">
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/'.$article->thumbnail) }}" alt="{{ $article->title }}" class="w-12 h-12 object-cover rounded-md">
                            @endif
                        </td>
                        <td class="py-2 text-forest">
                            {{ $article->title }}
                        </td>
                        <td class="py-2 text-gray-600">
                            {{ $article->category ?? '-' }}
                        </td>
                        <td class="py-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-[10px] {{ $article->is_published ? 'bg-leaf/20 text-forest' : 'bg-gray-100 text-gray-500' }}">
                                {{ $article->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="py-2 text-gray-700">
                            {{ $article->published_at?->format('d/m/Y H:i') ?? '-' }}
                        </td>
                        <td class="py-2 text-right">
                            <div class="inline-flex gap-1">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="px-2 py-1 rounded-md border border-gray-200 text-[11px]">Edit</a>
                                <form action="{{ route('admin.articles.publish', $article) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2 py-1 rounded-md border border-lime/40 text-[11px] text-forest">
                                        {{ $article->is_published ? 'Unpublish' : 'Publish' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')">
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
                        <td colspan="6" class="py-4 text-center text-gray-500">
                            Belum ada artikel.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-2">
            {{ $articles->links() }}
        </div>
    </div>
@endsection

