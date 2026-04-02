<?php

namespace App\Http\Controllers;

use App\Mail\ParticipantRegistered;
use App\Models\CMEvent;
use App\Models\CMEventParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

        DB::transaction(function () use ($cmevent, $participant) {
            $lockedEvent = CMEvent::query()->lockForUpdate()->findOrFail($cmevent->id);

            $participant->delete();

            // Registration decrements capacity (spots remaining); restore one slot on delete.
            if ($lockedEvent->capacity !== null) {
                $lockedEvent->increment('capacity');
            }
        });

        return redirect()->route('cmevents.participants.index', $cmevent)
            ->with('success', 'Participant deleted successfully.');
    }

    public function store(Request $request, CMEvent $cmevent)
    {
        $validated = $request->validate([
            'full_name'    => ['required', 'string', 'max:255'],
            'email'        => [
                'required',
                'email',
                'max:255',
                Rule::unique('cm_event_participants', 'email')->where(
                    fn ($q) => $q->where('cm_event_id', $cmevent->id)
                ),
            ],
            'phone_number' => ['required', 'string', 'max:30'],
        ], [
            'email.unique' => 'This email is already registered for this event.',
        ]);

        $validated['email'] = strtolower($validated['email']);

        $participant = DB::transaction(function () use ($cmevent, $validated) {
            $lockedEvent = CMEvent::query()->lockForUpdate()->find($cmevent->id);

            if (!$lockedEvent) {
                abort(404);
            }

            // If capacity is set, enforce it and decrement by 1 on successful registration.
            if ($lockedEvent->capacity !== null) {
                if ($lockedEvent->capacity <= 0) {
                    return null;
                }
            }

            $participant = $lockedEvent->participants()->create($validated);

            if ($lockedEvent->capacity !== null) {
                $lockedEvent->decrement('capacity');
            }

            return $participant;
        });

        if (!$participant) {
            return redirect()
                ->back()
                ->withErrors(['cm_event_id' => 'This event is full (capacity reached).']);
        }

        $this->sendQrConfirmationEmail($participant);

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
            'email'        => [
                'required',
                'email',
                'max:255',
                Rule::unique('cm_event_participants', 'email')->where(
                    fn ($q) => $q->where('cm_event_id', (int) $request->input('cm_event_id'))
                ),
            ],
            'phone_number' => ['required', 'string', 'max:30'],
            'cm_event_id'  => ['required', 'integer', 'exists:cm_events,id'],
        ], [
            'email.unique' => 'This email is already registered for this event.',
        ]);

        $validated['email'] = strtolower($validated['email']);

        $participant = DB::transaction(function () use ($validated) {
            $lockedEvent = CMEvent::query()
                ->whereKey($validated['cm_event_id'])
                ->lockForUpdate()
                ->first();

            if (!$lockedEvent) {
                return null;
            }

            // If capacity is set, enforce it and decrement by 1 on successful registration.
            if ($lockedEvent->capacity !== null) {
                if ($lockedEvent->capacity <= 0) {
                    return null;
                }
            }

            $participant = CMEventParticipant::create($validated);

            if ($lockedEvent->capacity !== null) {
                $lockedEvent->decrement('capacity');
            }

            return $participant;
        });

        if (!$participant) {
            return redirect()
                ->to(url('/') . '#inscription')
                ->withErrors(['cm_event_id' => 'This event is full (capacity reached).']);
        }

        $this->sendQrConfirmationEmail($participant);

        return redirect()
            ->to(url('/') . '#inscription')
            ->with('inscription_cm_event_success', true);
    }

    /**
     * Builds a signed QR code payload and dispatches the confirmation email.
     * Wrapped in try/catch so email failure never breaks the registration flow.
     */
    private function sendQrConfirmationEmail(CMEventParticipant $participant): void
    {
        try {
            $payload = [
                'participant_id' => $participant->id,
                'name'           => $participant->full_name,
                'email'          => $participant->email,
                'registered_at'  => $participant->created_at->toISOString(),
            ];

            // HMAC signature prevents payload tampering
            $payload['sig'] = hash_hmac('sha256', json_encode($payload), config('app.key'));

            // SVG requires no PHP image extensions (Imagick/GD) — safe on all environments.
            // Use a larger size for sharper rendering in email clients and easier scanning.
            $qrSvg = (string) QrCode::format('svg')->size(600)->generate(json_encode($payload));
            $qrBase64 = base64_encode($qrSvg);

            Mail::to($participant->email)->send(
                new ParticipantRegistered($participant, $qrBase64)
            );
        } catch (\Exception $e) {
            Log::error('QR confirmation email failed for participant #' . $participant->id . ': ' . $e->getMessage());
        }
    }
}
