<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entrada extends Model
{
    use HasFactory;

    protected $table = 'entrades';

    protected $fillable = [
        'concert_id',
        'codi',
        'preu_pagat',
        'nom_complet',
        'email',
    ];

    public function concert(): BelongsTo
    {
        return $this->belongsTo(Concert::class);
    }
}
