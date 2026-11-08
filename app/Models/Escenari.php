<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Escenari extends Model
{
    use HasFactory;

    protected $table = 'escenaris';

    protected $fillable = [
        'nom',
        'aforament_maxim',
        'ubicacio',
        'cobert'
    ];

    public function concerts(): HasMany
    {
        return $this->hasMany(Concert::class);
    }

    public function entrades(): HasManyThrough
    {
        return $this->hasManyThrough(Entrada::class, Concert::class);
    }
}
