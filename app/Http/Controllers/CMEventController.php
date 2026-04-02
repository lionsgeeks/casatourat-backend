<?php

namespace App\Http\Controllers;

use App\Models\CMEvent;
use Illuminate\Http\Request;

class CMEventController extends Controller
{
    public function index()
    {
        $cmevents = CMEvent::withCount('participants')->get();
        return view('CMEvent.index', compact('cmevents'));
    }

    public function create()
    {
        return view('CMEvent.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'capacity' => 'nullable|integer',
            'location' => 'nullable|string',
            'is_private' => 'boolean',
        ]);

        $data['is_private'] = $request->has('is_private') ? true : false;

        CMEvent::create($data);

        return redirect()->route('cmevents.index')->with('success', 'Event created successfully.');
    }

    public function edit(CMEvent $cmevent)
    {
        return view('CMEvent.edit', compact('cmevent'));
    }

    public function update(Request $request, CMEvent $cmevent)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'capacity' => 'nullable|integer',
            'location' => 'nullable|string',
            'is_private' => 'boolean',
        ]);

        $data['is_private'] = $request->has('is_private') ? true : false;

        $cmevent->update($data);

        return redirect()->route('cmevents.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(CMEvent $cmevent)
    {
        $cmevent->delete();

        return redirect()->route('cmevents.index')->with('success', 'Event deleted successfully.');
    }
    public function displayEvents()
    {
        $events = \App\Models\Event::query()
            ->orderByDesc('start')
            ->limit(25)
            ->get(['id', 'title', 'start', 'end']);

        $cmevents = \App\Models\CMEvent::query()
            ->where('is_private', false)
            ->where('start_date', '>=', now())
            ->whereNotNull('capacity')
            ->where('capacity', '>', 0)
            ->orderBy('start_date')
            ->get(['id', 'name', 'start_date', 'capacity']);

        return view('welcome', compact('events', 'cmevents'));
    }
}
