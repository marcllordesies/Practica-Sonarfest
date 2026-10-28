<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use App\Models\Concert;
use App\Enums\TipusConcert;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Enum;
use App\Models\Escenari;

class ConcertController extends Controller
{
    /**
     * Llista tots els concerts amb el nom de l'artista.
     */
    public function index(): View
    {
        // Carreguem els concerts amb la relació de l'artista inclosa i ordenats per data i hora
        $concerts = Concert::with(['artista', 'escenari'])->get();
        return view('concerts.index', compact('concerts'));
    }

    /**
     * Formulari amb desplegable d'artistes actius.
     */
    public function create(): View
    {

        $escenaris = Escenari::all();
        $artistes = Artista::all();

        return view('concerts.create', compact('escenaris', 'artistes'));
    }


    /**
     * Valida i guarda un concert.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validem les dades que arriben del formulari amb les regles exactes
        $validated = $request->validate([
            'artista_id'    => 'required|exists:artistas,id',
            'escenari_id' => 'required|exists:escenaris,id', // Opció 1: format text habitual
            'nom'           => 'required|string|max:255',
            'data_hora'     => 'required|date',
            'durada_minuts' => 'required|integer|min:15|max:300', // Mínim 15 minuts, màxim 5 hores (300 minuts)
            'tipus'         => 'required|in:CONCERT,DJ_SET,SHOWCASE,ACUSTIC', // Valida contra els strings de l'enum
        ]);

        // 2. Creem el concert a la base de dades amb els camps ja validats
        Concert::create($validated);

        // 3. Redireccionem a la llista de concerts enviant un missatge d'èxit de sessió
        return redirect()->route('concerts.index')->with('success', 'Concert creat correctament.');
    }

    /**
     * Detall del concert amb info de l'artista.
     */
    public function show(Concert $concert): View
    {
        // Carreguem la relació de l'artista per si de cas no s'ha fet abans
        $concert->load('artista');

        return view('concerts.show', compact('concert'));
    }
}
