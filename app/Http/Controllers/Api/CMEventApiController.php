<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CMEvent;
use App\Models\CMEventParticipant;
use Illuminate\Http\JsonResponse;

class CMEventApiController extends Controller
{
    public function index(): JsonResponse
    {
        $events = CMEvent::query()
            ->withCount('participants')
            ->orderByDesc('start_date')
            ->get()
            ->map(fn(CMEvent $event) => $this->transformEvent($event));

        return response()->json(['data' => $events]);
    }

    public function show(CMEvent $cmevent): JsonResponse
    {
        $cmevent->loadCount('participants');

        return response()->json([
            'data' => $this->transformEvent($cmevent, true),
        ]);
    }

    public function participants(CMEvent $cmevent): JsonResponse
    {
        $participants = $cmevent->participants()
            ->latest()
            ->get()
            ->map(fn(CMEventParticipant $participant) => $this->transformParticipant($participant));

        return response()->json(['data' => $participants]);
    }

    public function participant(CMEventParticipant $participant): JsonResponse
    {
        return response()->json([
            'data' => $this->transformParticipant($participant, true),
        ]);
    }

    private function transformEvent(CMEvent $event, bool $includeDescription = false): array
    {
        $now = now();
        $status = 'upcoming';
        $statusLabel = 'A venir';

        if ($event->end_date && $event->end_date->lt($now)) {
            $status = 'finished';
            $statusLabel = 'Termine';
        } elseif ($event->start_date && $event->start_date->lte($now) && $event->end_date && $event->end_date->gte($now)) {
            $status = 'ongoing';
            $statusLabel = 'En cours';
        }

        $payload = [
            'id' => (string) $event->id,
            'name' => $event->name,
            'start_date' => optional($event->start_date)->toISOString(),
            'end_date' => optional($event->end_date)->toISOString(),
            'location' => $event->location,
            'participants_count' => $event->participants_count ?? 0,
            'scanned_count' => 0,
            'status' => $status,
            'status_label' => $statusLabel,
        ];

        if ($includeDescription) {
            $payload['description'] = $event->description;
            $payload['capacity'] = $event->capacity;
        }

        return $payload;
    }

    private function transformParticipant(CMEventParticipant $participant, bool $withEvent = false): array
    {
        $payload = [
            'id' => (string) $participant->id,
            'cm_event_id' => (string) $participant->cm_event_id,
            'full_name' => $participant->full_name,
            'email' => $participant->email,
            'phone_number' => $participant->phone_number,
            'status' => 'pending',
            'validated_at' => null,
            'validation_method' => null,
            'code' => sprintf('CM-%s-%05d', $participant->cm_event_id, $participant->id),
            'created_at' => optional($participant->created_at)->toISOString(),
        ];

        if ($withEvent) {
            $payload['event'] = [
                'id' => (string) $participant->cm_event_id,
                'name' => optional($participant->cmevent)->name,
            ];
        }

        return $payload;
    }
}