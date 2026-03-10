<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class PublicGalleryController extends Controller
{
    public function index()
    {
        $query = Gallery::query()
            ->orderByDesc('is_featured')
            ->orderBy('order_index');

        if (request()->filled('event')) {
            $query->where('event_id', request('event'));
        }

        $query->orderByDesc('activity_date');

        $galleries = $query->paginate(12)->withQueryString();

        return view('galleries.index', compact('galleries'));
    }
}
