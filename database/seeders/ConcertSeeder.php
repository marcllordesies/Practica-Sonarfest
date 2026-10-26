<?php

namespace Database\Seeders;

use App\Enums\TipusConcert;
use App\Models\Artista;
use App\Models\Concert;
use App\Models\Escenari;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ConcertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Busquem només els artistes (i escenaris) actius a la base de dades
        $artistesActius = Artista::where('actiu', true)->get();
        $escenarisActius = Escenari::where('cobert', true)->get();

        // Si no hi hagués cap artista actiu, ens assegurem que el seeder no falli
        if ($artistesActius->isEmpty()) {
            $this->command->warn('No hi ha artistes actius a la base de dades per assignar concerts.');
            return;
        }

        if ($escenarisActius->isEmpty()) {
            $this->command->warn('No hi ha escenaris actius a la base de dades per assignar concerts.');
            return;
        }

        // Llista amb els 4 tipus de l'Enum per anar-los repartint
        $tipusDisponibles = [
            TipusConcert::CONCERT,
            TipusConcert::DJ_SET,
            TipusConcert::SHOWCASE,
            TipusConcert::ACUSTIC
        ];

        // Llista de noms de gires/concerts de prova per fer-ho realista
        $nomsConcerts = [
            'Gira de l\'Estiu', 'Acústic a la Fresca', 'Live Session Tour', 'Presentació Nou Disc',
            'Grand Finale Event', 'Dj Set Non-Stop', 'Concert de Benvinguda', 'Showcase Exclusiu',
            'Midnight Festival', 'Sunset Melodies', 'Gira Mundial 2027', 'Concert Acústic Especial',
            'Electronic Night', 'Rock & Roll Star Gira', 'Acoustic Dreams'
        ];

        // 2. Creem un mínim de 15 concerts
        for ($i = 0; $i < 15; $i++) {
            // Agafem un artista actiu a l'atzar
            $artista = $artistesActius->random();
            $escenari = $escenarisActius->random();

            // Generem una data aleatòria per a l'estiu vinent (entre juliol i agost de 2027)
            $diaAleatori = rand(1, 31);
            $mesAleatori = rand(7, 8); // 7 = Juliol, 8 = Agost
            $horaAleatoria = rand(18, 23); // Concerts de tarda/nit

            $dataHora = Carbon::create(2027, $mesAleatori, $diaAleatori, $horaAleatoria, 0, 0);

            // Guardem el concert a la base de dades
            Concert::create([
                'artista_id' => $artista->id,
                'escenari_id' => $escenari->id,
                'nom' => $nomsConcerts[$i],
                'data_hora' => $dataHora,
                'durada_minuts' => rand(45, 120), // Durada entre 45 minuts i 2 hores
                'tipus' => $tipusDisponibles[$i % 4], // Reparteix els 4 tipus de forma equitativa (0, 1, 2, 3...)
            ]);
        }
    }
}
