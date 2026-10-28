<?php

namespace App\Http\Controllers;

use App\Models\Genere;
use App\Models\Artista;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ArtistaController extends Controller
{
    public function index(): View
    {
        $artistes = Artista::with('generes')->orderBy('nom')->get();

        return view('artistes.index', compact('artistes'));
    }

    public function create(): View
    {
        $generes = Genere::all();
        return view('artistes.form', compact('generes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom'        => 'required|string|max:255',
            'pais'       => 'required|string|max:255',
            'bio'        => 'nullable|string',
            'imatge_url' => 'nullable|url',
            'actiu'      => 'sometimes|boolean',
        ]);

        $artista = Artista::create($validated);
        $artista->generes()->sync($request->input('generes'));

        return redirect()->route('artistes.index')->with('success', 'Artista creat correctament.');
    }
    public function show(Artista $artista): View
    {
        $artista->load([
            'generes',
            'concerts' => function ($query) {
                $query->orderBy('data_hora');
            }
        ]);

        return view('artistes.show', compact('artista'));
    }

    public function edit(Artista $artista): View
    {
        $generes = Genere::all();
        return view('artistes.form', compact('artista', 'generes'));
    }

    public function update(Request $request, Artista $artista): RedirectResponse
    {
        $validated = $request->validate([
            'nom'        => 'required|string|max:255',
            'pais'       => 'required|string|max:255',
            'bio'        => 'nullable|string',
            'imatge_url' => 'nullable|url',
            'actiu'      => 'sometimes|boolean',
        ]);

        $artista->update($validated);

        $artista->generes()->sync($request->input('generes', []));

        return redirect()->route('artistes.index')->with('success', 'Artista actualitzat correctament.');
    }
}

