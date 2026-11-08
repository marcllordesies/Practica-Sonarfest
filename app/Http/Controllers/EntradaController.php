<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Entrada;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EntradaController extends Controller
{

    public function create(Concert $concert)
    {
        return view('entrades.create', compact('concert'));
    }


    public function store(Request $request, Concert $concert): RedirectResponse
    {
        $entradesVenudes = $concert->entrades()->count();
        if ($entradesVenudes >= $concert->escenari->aforament_maxim) {
            return back()->withErrors(['aforament' => 'Aquest concert està ple.']);
        }

        $validated = $request->validate([
            'preu_pagat' => 'required|numeric|min:0',
        ]);

        Entrada::create([
            'concert_id'  => $concert->id,
            'codi'        => 'SONA-' . strtoupper(Str::random(6)),
            'preu_pagat' => $validated['preu_pagat'],
            'nom_complet' => Auth::user()->name ?? 'Usuari',
            'email'       => Auth::user()->email,
        ]);

        return redirect()->route('entrades.meves')->with('success', 'Entrada comprada correctament.');
    }


    public function mevesentrades()
    {
        $entrades = Entrada::where('email', Auth::user()->email)->get();
        return view('entrades.meves', compact('entrades'));
    }

    public function assistents(Concert $concert)
    {
        $entrades = $concert->entrades;

        return view('entrades.assistents', compact('concert', 'entrades'));
    }

}
