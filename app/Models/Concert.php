<?php

namespace App\Models;

use App\Enums\TipusConcert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // OBLIGATORI

class Concert extends Model
{
    use HasFactory;

    protected $fillable = [
        'artista_id',
        'escenari_id',
        'nom',
        'data_hora',
        'durada_minuts',
        'tipus',
    ];

    protected $casts = [
        'data_hora' => 'datetime',
        'tipus' => TipusConcert::class,
    ];

    /**
     * Un concert pertany a un artista.
     */
    public function artista(): BelongsTo
    {
        return $this->belongsTo(Artista::class);
    }

    public function escenari(): BelongsTo
    {
        return $this->belongsTo(Escenari::class);
    }

}
