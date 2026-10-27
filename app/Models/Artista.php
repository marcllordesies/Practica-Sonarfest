<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artista extends Model
{
    use HasFactory;

    // 1. Vinculem el model amb la teva taula real 'artistas'
    protected $table = 'artistas';

    // 2. Defineix el $fillable amb tots els camps de la migració que es poden omplir de manera massiva
    protected $fillable = [
        'nom',
        'pais',
        'bio',
        'imatge_url',
        'actiu',
    ];

    // 3. Defineix el $casts per al camp actiu tal com demana l'exercici
    protected $casts = [
        'actiu' => 'boolean', // Transforma el 0/1 de la base de dades en un true/false de PHP
    ];

    /**
     * RELACIÓ (Del bloc 4): Un artista té molts concerts.
     */
    public function concerts(): HasMany
    {
        return $this->hasMany(Concert::class);
    }

    public function generes(): BelongsToMany{
        return $this->belongsToMany(Genere::class, 'artista_genere');
    }
}
