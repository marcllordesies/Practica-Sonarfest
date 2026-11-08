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
        $artistesActius = Artista::where('actiu', true)->get();
        $escenarisActius = Escenari::where('cobert', true, false)->get();

        if ($artistesActius->isEmpty()) {
            $this->command->warn('No hi ha artistes actius a la base de dades per assignar concerts.');
            return;
        }

        if ($escenarisActius->isEmpty()) {
            $this->command->warn('No hi ha escenaris actius a la base de dades per assignar concerts.');
            return;
        }

        $tipusDisponibles = [
            TipusConcert::CONCERT,
            TipusConcert::DJ_SET,
            TipusConcert::SHOWCASE,
            TipusConcert::ACUSTIC
        ];

        $nomsConcerts = [
            'Gira de l\'Estiu', 'Acústic a la Fresca', 'Live Session Tour', 'Presentació Nou Disc',
            'Grand Finale Event', 'Dj Set Non-Stop', 'Concert de Benvinguda', 'Showcase Exclusiu',
            'Midnight Festival', 'Sunset Melodies', 'Gira Mundial 2027', 'Concert Acústic Especial',
            'Electronic Night', 'Rock & Roll Star Gira', 'Acoustic Dreams'
        ];

        for ($i = 0; $i < 15; $i++) {

            $artista = $artistesActius->random();
            $escenari = $escenarisActius->random();

            $diaAleatori = rand(1, 31);
            $mesAleatori = rand(7, 8); // 7 = Juliol, 8 = Agost
            $horaAleatoria = rand(18, 23); // Concerts de tarda/nit

            $dataHora = Carbon::create(2027, $mesAleatori, $diaAleatori, $horaAleatoria, 0, 0);

            Concert::create([
                'artista_id' => $artista->id,
                'escenari_id' => $escenari->id,
                'nom' => $nomsConcerts[$i],
                'data_hora' => $dataHora,
                'durada_minuts' => rand(45, 120),
                'tipus' => $tipusDisponibles[$i % 4],
            ]);
        }
    }
}
