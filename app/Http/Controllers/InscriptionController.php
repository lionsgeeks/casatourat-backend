<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Inscription;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255'],
            'phone'     => ['required', 'string', 'max:30'],
            'event_id'  => ['required', 'integer', 'exists:events,id'],
        ]);

        Inscription::create($validated);

        return redirect()
            ->to(route('welcome') . '#inscription')
            ->with('inscription_success', true);
    }
}
