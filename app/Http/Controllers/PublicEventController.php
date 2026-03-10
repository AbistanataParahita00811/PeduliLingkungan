<?php

namespace App\Http\Controllers;

use App\Models\Event;

class PublicEventController extends Controller
{
    public function index()
    {
        $query = Event::query()
            ->where('is_active', true)
            ->orderBy('event_date');

        if (request()->filled('category')) {
            $query->where('category', request('category'));
        }

        $events = $query->paginate(9)->withQueryString();

        return view('events.index', compact('events'));
    }

    public function show(string $slug)
    {
        $event = Event::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $related = Event::query()
            ->where('is_active', true)
            ->where('id', '!=', $event->id)
            ->when($event->category, fn ($q) => $q->where('category', $event->category))
            ->orderBy('event_date')
            ->take(3)
            ->get();

        return view('events.show', compact('event', 'related'));
    }
}
