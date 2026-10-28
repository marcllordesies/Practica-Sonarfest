<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Escenari extends Model
{
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
}
