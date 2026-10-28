<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genere;

class GenereSeeder extends Seeder
{
    public function run(): void
    {
        Genere::create(['nom' => 'Pop']);
        Genere::create(['nom' => 'Rock']);
        Genere::create(['nom' => 'Electrònica']);
        Genere::create(['nom' => 'Jazz']);
        Genere::create(['nom' => 'Hip-hop']);
        Genere::create(['nom' => 'Indie']);
    }
}
