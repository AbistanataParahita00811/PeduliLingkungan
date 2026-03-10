<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryRequest;
use App\Http\Requests\Admin\UpdateGalleryRequest;
use App\Models\Event;
use App\Models\Gallery;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('order_index')->orderByDesc('activity_date')->get();

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        $events = Event::orderBy('event_date')->get();

        return view('admin.galleries.create', compact('events'));
    }

    public function store(StoreGalleryRequest $request, ImageUploadService $uploader)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $uploader->upload(
                file: $request->file('image'),
                directory: 'galleries',
                maxWidth: 1400
            );
        }

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery)
    {
        $events = Event::orderBy('event_date')->get();

        return view('admin.galleries.edit', compact('gallery', 'events'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery, ImageUploadService $uploader)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $uploader->upload(
                file: $request->file('image'),
                directory: 'galleries',
                maxWidth: 1400
            );
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => ['required', 'array'],
            'orders.*' => ['integer', 'min:0'],
        ]);

        foreach ($request->input('orders', []) as $id => $order) {
            Gallery::whereKey($id)->update(['order_index' => (int) $order]);
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Urutan galeri diperbarui.');
    }

    public function bulkUpload(Request $request, ImageUploadService $uploader)
    {
        $request->validate([
            'images' => ['required', 'array', 'max:10'],
            'images.*' => ['image', 'max:2048'],
        ]);

        foreach ($request->file('images') as $image) {
            Gallery::create([
                'title' => $image->getClientOriginalName(),
                'image' => $uploader->upload(
                    file: $image,
                    directory: 'galleries',
                    maxWidth: 1400
                ),
            ]);
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil diupload.');
    }

    public function toggleFeatured(Gallery $gallery)
    {
        $gallery->update(['is_featured' => ! $gallery->is_featured]);

        return redirect()->route('admin.galleries.index')->with('success', 'Status featured galeri diperbarui.');
    }
}

