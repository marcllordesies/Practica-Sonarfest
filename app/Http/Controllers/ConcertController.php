<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use App\Models\Concert;
use App\Models\Escenari;
use App\Models\Genere;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ConcertController extends Controller
{
    public function index(Request $request): View
    {
        $query = Concert::with(['artista.generes', 'escenari']);

        if ($request->filled('escenari_id')) {
            $query->where('escenari_id', $request->escenari_id);
        }

        if ($request->filled('genere_id')) {
            $query->whereHas('artista.generes', function ($q) use ($request) {
                $q->where('generes.id', $request->genere_id);
            });
        }

        if ($request->filled('data_inici')) {
            $query->whereDate('data_hora', '>=', $request->data_inici);
        }
        if ($request->filled('data_fi')) {
            $query->whereDate('data_hora', '<=', $request->data_fi);
        }

        $concerts = $query->orderBy('data_hora')->get();
        $escenaris = Escenari::all();
        $generes = Genere::all();

        return view('concerts.index', compact('concerts', 'escenaris', 'generes'));
    }

    public function create(): View
    {
        $escenaris = Escenari::orderBy('nom')->get();
        $artistes = Artista::where('actiu', true)->orderBy('nom')->get();

        return view('concerts.create', compact('escenaris', 'artistes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'artista_id'    => 'required|exists:artistas,id',
            'escenari_id'   => 'required|exists:escenaris,id',
            'nom'           => 'required|string|max:255',
            'data_hora'     => 'required|date',
            'durada_minuts' => 'required|integer|min:15|max:300',
            'tipus'         => 'required|in:CONCERT,DJ_SET,SHOWCASE,ACUSTIC',
        ]);

        Concert::create($validated);

        return redirect()->route('concerts.index')->with('success', 'Concert creat correctament.');
    }

    public function show(Concert $concert): View
    {
        $concert->load(['artista', 'escenari']);

        return view('concerts.show', compact('concert'));
    }

    public function edit(Concert $concert): View
    {
        $escenaris = Escenari::orderBy('nom')->get();
        $artistes = Artista::where('actiu', true)->orderBy('nom')->get();

        return view('concerts.edit', compact('concert', 'escenaris', 'artistes'));
    }

    public function update(Request $request, Concert $concert): RedirectResponse
    {
        $validated = $request->validate([
            'artista_id'    => 'required|exists:artistas,id',
            'escenari_id'   => 'required|exists:escenaris,id',
            'nom'           => 'required|string|max:255',
            'data_hora'     => 'required|date',
            'durada_minuts' => 'required|integer|min:15|max:300',
            'tipus'         => 'required|in:CONCERT,DJ_SET,SHOWCASE,ACUSTIC',
        ]);

        $concert->update($validated);

        return redirect()->route('concerts.index')->with('success', 'Concert actualitzat correctament.');
    }

    public function destroy(Concert $concert): RedirectResponse
    {
        $concert->delete();

        return redirect()->route('concerts.index')->with('success', 'Concert eliminat correctament.');
    }

    public function estadistiques(): View
    {
        $topConcerts = Concert::withCount('entrades')
            ->orderByDesc('entrades_count')
            ->take(5)
            ->get();

        $topArtistes = Artista::withCount('concerts')
            ->orderByDesc('concerts_count')
            ->take(5)
            ->get();

        $recaptacioEscenaris = Escenari::withSum('entrades', 'preu_pagat')->get();

        $generesPopulars = Genere::select('generes.*')
            ->join('artista_genere', 'generes.id', '=', 'artista_genere.genere_id')
            ->join('concerts', 'artista_genere.artista_id', '=', 'concerts.artista_id')
            ->join('entradas', 'concerts.id', '=', 'entradas.concert_id') //
            ->groupBy('generes.id', 'generes.nom')
            ->selectRaw('count(entradas.id) as total_entrades') //
            ->orderByDesc('total_entrades')
            ->get();

        $ocupacioEscenaris = Escenari::withCount('concerts')
            ->withCount('entrades')
            ->get();

        return view('estadistiques.estadistiques', compact(
            'topConcerts',
            'topArtistes',
            'recaptacioEscenaris',
            'generesPopulars',
            'ocupacioEscenaris'
        ));
    }
}
