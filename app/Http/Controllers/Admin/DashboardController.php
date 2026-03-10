<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Event;
use App\Models\Gallery;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEvents = Event::count();
        $upcomingEvents = Event::whereDate('event_date', '>=', now()->toDateString())->count();
        $totalPhotos = Gallery::count();
        $totalArticles = Article::count();

        $nextEvents = Event::whereDate('event_date', '>=', now()->toDateString())
            ->orderBy('event_date')
            ->take(5)
            ->get();

        $latestArticles = Article::orderByDesc('published_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'totalEvents' => $totalEvents,
            'upcomingEvents' => $upcomingEvents,
            'totalPhotos' => $totalPhotos,
            'totalArticles' => $totalArticles,
            'nextEvents' => $nextEvents,
            'latestArticles' => $latestArticles,
        ]);
    }
}

