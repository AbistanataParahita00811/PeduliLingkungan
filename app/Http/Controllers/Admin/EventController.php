<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\ImageUploadService;
use App\Services\SlugService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($status = $request->get('status')) {
            if ($status === 'upcoming') {
                $query->whereDate('event_date', '>=', now()->toDateString());
            } elseif ($status === 'past') {
                $query->whereDate('event_date', '<', now()->toDateString());
            }
        }

        if ($category = $request->get('category')) {
            $query->where('category', $category);
        }

        $events = $query->orderByDesc('event_date')->paginate(10)->withQueryString();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(StoreEventRequest $request, ImageUploadService $uploader, SlugService $slugService)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? $slugService->generate($data['title'], new Event);

        if ($request->hasFile('poster')) {
            $data['poster'] = $uploader->upload($request->file('poster'), 'events', ImageUploadService::EVENTS);
        }

        if ($request->filled('tags_input')) {
            $data['tags'] = array_filter(array_map('trim', explode(',', $request->string('tags_input'))));
        }

        $data['has_popup'] = $request->boolean('has_popup');
        $data['show_in_navbar'] = $request->boolean('show_in_navbar');
        $data['popup_redirect_url'] = $request->input('popup_redirect_url');

        if ($data['show_in_navbar']) {
            Event::query()->update(['show_in_navbar' => false]);
        }

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dibuat.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(UpdateEventRequest $request, Event $event, ImageUploadService $uploader, SlugService $slugService)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? $event->slug ?? $slugService->generate($data['title'], new Event, $event->id);

        if ($request->hasFile('poster')) {
            $data['poster'] = $uploader->upload($request->file('poster'), 'events', ImageUploadService::EVENTS);
        }

        if ($request->filled('tags_input')) {
            $data['tags'] = array_filter(array_map('trim', explode(',', $request->string('tags_input'))));
        }

        $data['has_popup'] = $request->boolean('has_popup');
        $data['show_in_navbar'] = $request->boolean('show_in_navbar');
        $data['popup_redirect_url'] = $request->input('popup_redirect_url');

        if ($data['show_in_navbar']) {
            Event::query()->update(['show_in_navbar' => false]);
        }

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }

    public function toggleFeatured(Event $event)
    {
        $event->update(['is_featured' => ! $event->is_featured]);

        return redirect()->route('admin.events.index')->with('success', 'Status featured event diperbarui.');
    }

    public function toggleActive(Event $event)
    {
        $event->update(['is_active' => ! $event->is_active]);

        return redirect()->route('admin.events.index')->with('success', 'Status aktif event diperbarui.');
    }
}

