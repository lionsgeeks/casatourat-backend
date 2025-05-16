<?php

namespace App\Http\Controllers;

use App\Models\Formulaire;
use Illuminate\Http\Request;

class FormulaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = Formulaire::all();
        return view('formulaire.admin', [
            'forms' => $forms,
        ]);
    }


    public function user()
    {
        return view('formulaire.user');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'source' => 'required',
            'circuit' => 'required',
            'evaluation' => 'required',
            'appreciation' => 'required',
            'difficulty' => 'required',
            'suggestion' => 'required',
            'interested' => 'required',
            'contact' => 'required',
            'language' => 'required',
        ]);

        Formulaire::create([
            'source' => $request->input('source'),
            'circuit' => $request->circuit,
            'evaluation' => $request->evaluation,
            'appreciation' => $request->input('appreciation'),
            'difficulty' => $request->difficulty,
            'suggestion' => $request->suggestion,
            'interested' => $request->interested,
            'contact' => $request->input('contact'),
            'language' => $request->language,
        ]);

        return redirect()->route('welcome');
    }

    /**
     * Display the specified resource.
     */
    public function show(Formulaire $formulaire)
    {
        return view('formulaire.partials.show_form', [
            'form' => $formulaire,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formulaire $formulaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formulaire $formulaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formulaire $formulaire)
    {
        $formulaire->delete();
        return redirect()->back();
    }
}
