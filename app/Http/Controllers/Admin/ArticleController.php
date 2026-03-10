<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Services\ImageUploadService;
use App\Services\SlugService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($status = $request->get('status')) {
            if ($status === 'published') {
                $query->where('is_published', true);
            } elseif ($status === 'draft') {
                $query->where('is_published', false);
            }
        }

        $articles = $query->orderByDesc('created_at')->paginate(10)->withQueryString();

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(StoreArticleRequest $request, ImageUploadService $uploader, SlugService $slugService)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? $slugService->generate($data['title'], new Article);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $uploader->upload($request->file('thumbnail'), 'articles', ImageUploadService::ARTICLES);
        }

        if (! isset($data['published_at']) && ($data['is_published'] ?? false)) {
            $data['published_at'] = now();
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dibuat.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(UpdateArticleRequest $request, Article $article, ImageUploadService $uploader, SlugService $slugService)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? $article->slug ?? $slugService->generate($data['title'], new Article, $article->id);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $uploader->upload($request->file('thumbnail'), 'articles', ImageUploadService::ARTICLES);
        }

        if (! isset($data['published_at']) && ($data['is_published'] ?? $article->is_published)) {
            $data['published_at'] = $article->published_at ?? now();
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function publish(Article $article)
    {
        $article->update([
            'is_published' => true,
            'published_at' => $article->published_at ?? now(),
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dipublikasi.');
    }

    public function unpublish(Article $article)
    {
        $article->update(['is_published' => false]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil di-unpublish.');
    }
}

