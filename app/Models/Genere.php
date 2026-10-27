<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genere extends Model
{
    public $timestamps = false;

    protected $fillable = ['nom'];

    public function  artistes(): BelongsToMany
    {
        return $this-> belongsToMany(Artista::class, 'artista_genere');
    }
}
