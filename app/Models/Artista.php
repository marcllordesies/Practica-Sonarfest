<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artista extends Model
{
    use HasFactory;

    protected $table = 'artistas';


    protected $fillable = [
        'nom',
        'pais',
        'bio',
        'imatge_url',
        'actiu',
    ];

    protected $casts = [
        'actiu' => 'boolean',
    ];


    public function concerts(): HasMany
    {
        return $this->hasMany(Concert::class);
    }

    public function generes(): BelongsToMany{
        return $this->belongsToMany(Genere::class, 'artista_genere');
    }
}
