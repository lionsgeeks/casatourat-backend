<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CMEvent;
use App\Models\CMEventParticipant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CMEventApiController extends Controller
{
    public function index(): JsonResponse
    {
        $events = CMEvent::query()
            ->withCount('participants')
            ->withCount([
                'participants as scanned_participants_count' => fn($query) => $query->whereNotNull('scanned_at'),
            ])
            ->orderByDesc('start_date')
            ->get()
            ->map(fn(CMEvent $event) => $this->transformEvent($event));

        return response()->json(['data' => $events]);
    }

    public function show(CMEvent $cmevent): JsonResponse
    {
        $cmevent->loadCount('participants')
            ->loadCount([
                'participants as scanned_participants_count' => fn($query) => $query->whereNotNull('scanned_at'),
            ]);

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

    public function verifyQr(Request $request, CMEvent $cmevent): JsonResponse
    {
        $validated = $request->validate([
            'qr_data' => ['required', 'string'],
        ]);

        $payload = $this->decodeAndValidatePayload($validated['qr_data']);

        if (!$payload) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'QR code invalide.',
            ], 422);
        }

        /** @var CMEventParticipant|null $participant */
        $participant = $cmevent->participants()->whereKey($payload['participant_id'])->first();

        if (!$participant) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Participant introuvable pour cet evenement.',
            ], 404);
        }

        $createdAtIso = optional($participant->created_at)->toISOString();
        if (
            $participant->full_name !== $payload['name']
            || $participant->email !== $payload['email']
            || $createdAtIso !== $payload['registered_at']
        ) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'QR code invalide.',
            ], 422);
        }

        if ($participant->scanned_at) {
            return response()->json([
                'status' => 'already_scanned',
                'message' => 'Participant deja scanne.',
                'data' => [
                    'participant' => $this->transformParticipant($participant, true),
                ],
            ], 409);
        }

        $result = DB::transaction(function () use ($participant) {
            $locked = CMEventParticipant::query()->lockForUpdate()->find($participant->id);

            if (!$locked) {
                return null;
            }

            if ($locked->scanned_at) {
                return [
                    'already_scanned' => true,
                    'participant' => $locked,
                ];
            }

            $locked->update([
                'scanned_at' => now(),
                'validation_method' => 'QR scan',
            ]);

            return [
                'already_scanned' => false,
                'participant' => $locked->fresh(),
            ];
        });

        if (!$result || !isset($result['participant'])) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Participant introuvable.',
            ], 404);
        }

        /** @var CMEventParticipant $updatedParticipant */
        $updatedParticipant = $result['participant'];

        if ($result['already_scanned']) {
            return response()->json([
                'status' => 'already_scanned',
                'message' => 'Participant deja scanne.',
                'data' => [
                    'participant' => $this->transformParticipant($updatedParticipant, true),
                ],
            ], 409);
        }

        return response()->json([
            'status' => 'validated',
            'message' => 'Participant valide avec succes.',
            'data' => [
                'participant' => $this->transformParticipant($updatedParticipant, true),
            ],
        ]);
    }

    public function manualValidate(CMEventParticipant $participant): JsonResponse
    {
        if ($participant->scanned_at) {
            return response()->json([
                'status' => 'already_scanned',
                'message' => 'Participant deja valide.',
                'data' => [
                    'participant' => $this->transformParticipant($participant, true),
                ],
            ], 409);
        }

        $result = DB::transaction(function () use ($participant) {
            $locked = CMEventParticipant::query()->lockForUpdate()->find($participant->id);

            if (!$locked) {
                return null;
            }

            if ($locked->scanned_at) {
                return [
                    'already_scanned' => true,
                    'participant' => $locked,
                ];
            }

            $locked->update([
                'scanned_at' => now(),
                'validation_method' => 'Manuel',
            ]);

            return [
                'already_scanned' => false,
                'participant' => $locked->fresh(),
            ];
        });

        if (!$result || !isset($result['participant'])) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Participant introuvable.',
            ], 404);
        }

        /** @var CMEventParticipant $updatedParticipant */
        $updatedParticipant = $result['participant'];

        if ($result['already_scanned']) {
            return response()->json([
                'status' => 'already_scanned',
                'message' => 'Participant deja valide.',
                'data' => [
                    'participant' => $this->transformParticipant($updatedParticipant, true),
                ],
            ], 409);
        }

        return response()->json([
            'status' => 'validated',
            'message' => 'Participant valide manuellement avec succes.',
            'data' => [
                'participant' => $this->transformParticipant($updatedParticipant, true),
            ],
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
            'scanned_count' => $event->scanned_participants_count ?? 0,
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
            'status' => $participant->scanned_at ? 'validated' : 'pending',
            'validated_at' => optional($participant->scanned_at)->toISOString(),
            'validation_method' => $participant->validation_method,
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

    private function decodeAndValidatePayload(string $rawQrData): ?array
    {
        $decoded = json_decode($rawQrData, true);

        if (!is_array($decoded)) {
            return null;
        }

        $requiredKeys = ['participant_id', 'name', 'email', 'registered_at', 'sig'];
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $decoded)) {
                return null;
            }
        }

        $dataToSign = [
            'participant_id' => $decoded['participant_id'],
            'name' => $decoded['name'],
            'email' => $decoded['email'],
            'registered_at' => $decoded['registered_at'],
        ];

        $expectedSignature = hash_hmac('sha256', json_encode($dataToSign), config('app.key'));
        if (!hash_equals($expectedSignature, (string) $decoded['sig'])) {
            return null;
        }

        return [
            'participant_id' => (int) $decoded['participant_id'],
            'name' => (string) $decoded['name'],
            'email' => (string) $decoded['email'],
            'registered_at' => (string) $decoded['registered_at'],
        ];
    }
}