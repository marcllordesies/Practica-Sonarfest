<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entrada;
use App\Models\User;
use App\Models\Concert;

class EntradaSeeder extends Seeder
{
    public function run(): void
    {

        if (User::count() === 0) {
            User::factory(5)->create();
        }

        $usuaris = User::all();
        $concerts = Concert::with('escenari')->get();

        if ($concerts->isEmpty()) {
            return;
        }


        $entradesCreades = 0;
        $intentos = 0;

        while ($entradesCreades < 30 && $intentos < 200) {
            $intentos++;
            $concert = $concerts->random();
            $usuari = $usuaris->random();


            $entradesVenudes = Entrada::where('concert_id', $concert->id)->count();
            $aforamentMaxim = $concert->escenari->aforament_maxim ?? 100;


            if ($entradesVenudes < $aforamentMaxim) {

                Entrada::create([
                    'user_id' => $usuari->id,
                    'concert_id' => $concert->id,
                    'preu_pagat' => fake()->randomFloat(2, 10, 50),
                ]);

                $entradesCreades++;
            }
        }
    }
}
