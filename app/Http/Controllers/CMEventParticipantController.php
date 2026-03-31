<?php

namespace App\Http\Controllers;

use App\Models\CMEvent;
use App\Models\CMEventParticipant;
use Illuminate\Http\Request;

class CMEventParticipantController
{
    public function index(CMEvent $cmevent)
    {
        $participants = $cmevent->participants()->latest()->get();

        return view('CMEvent.participants', compact('cmevent', 'participants'));
    }

    public function destroy(CMEvent $cmevent, CMEventParticipant $participant)
    {
        if ($participant->cm_event_id !== $cmevent->id) {
            abort(404);
        }

        $participant->delete();

        return redirect()->route('cmevents.participants.index', $cmevent)
            ->with('success', 'Participant deleted successfully.');
    }

    public function store(Request $request, CMEvent $cmevent)
    {
        $validated = $request->validate([
            'full_name'    => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255'],
            'phone_number' => ['required', 'string', 'max:30'],
        ]);

        $cmevent->participants()->create($validated);

        return redirect()
            ->back()
            ->with('inscription_cm_event_success', true);
    }

    /**
     * Public registration from the welcome page.
     * No auth required — the CM event is resolved from the posted cm_event_id.
     */
    public function publicStore(Request $request)
    {
        $validated = $request->validate([
            'full_name'    => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255'],
            'phone_number' => ['required', 'string', 'max:30'],
            'cm_event_id'  => ['required', 'integer', 'exists:cm_events,id'],
        ]);

        CMEventParticipant::create($validated);

        return redirect()
            ->to(url('/') . '#inscription')
            ->with('inscription_cm_event_success', true);
    }
}
