<?php

namespace App\Http\Controllers;

use App\Models\CMEvent;
use App\Models\CMEventParticipant;

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
}
