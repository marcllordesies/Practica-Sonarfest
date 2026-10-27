<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artista;
use App\Models\Genere;
class ArtistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1. Rosalia (Actiu)
        Artista::create([
            'nom'=>'Rosalia',
            'pais'=> 'Espanya',
            'bio' => 'Cantant i compositora catalana de fama internacional',
            'imatge_url' => null,
            'actiu' => true,

        ]);
        // 2. Bad Bunny (Actiu)
        Artista::create([
            'nom' => 'Bad Bunny',
            'pais' => 'Puerto Rico',
            'bio' => 'Cantant de trap i reggaeton, icona de la música llatina.',
            'imatge_url' => null,
            'actiu' => true,
        ]);
        // 3. Michael Jackson (Inactiu)
        Artista::create([
            'nom' => 'Michael Jackson',
            'pais' => 'Estats Units',
            'bio' => 'Conegut com el Rei del Pop, un dels artistes més influents de la història.',
            'imatge_url' => null,
            'actiu' => false,
        ]);
        // 4. Billie Eilish (Actiu)
        Artista::create([
            'nom' => 'Billie Eilish',
            'pais' => 'Estats Units',
            'bio' => 'Jove cantautora guanyadora de múltiples premis Grammy i Oscars.',
            'imatge_url' => null,
            'actiu' => true,
        ]);
        // 5. Tupac (Inactiu)
        Artista::create([
            'nom' => 'Tupac Shakur',
            'pais' => 'Estats Units',
            'bio' => 'Llegendari raper i actor, considerat un dels grans referents del hip-hop.',
            'imatge_url' => null,
            'actiu' => false,
        ]);
        // 6. Shakira (Actiu)
        Artista::create([
            'nom' => 'Shakira',
            'pais' => 'Colòmbia',
            'bio' => 'Cantant, compositora i ballarina, coneguda com la Reina del pop llatí.',
            'imatge_url' => null,
            'actiu' => true,
        ]);
        // 7. Stromae (Actiu)
        Artista::create([
            'nom' => 'Stromae',
            'pais' => 'Bèlgica',
            'bio' => 'Cantant i compositor belga que barreja el hip-hop amb electrònica.',
            'imatge_url' => null,
            'actiu' => true,
        ]);
        // 8. Figa Flawas (Actiu)
        Artista::create([
            'nom' => 'Figa Flawas',
            'pais' => 'Espanya',
            'bio' => 'Grup de música urbana i pop originari de Valls, coneguts pel seu estil festiu.',
            'imatge_url' => null,
            'actiu' => true,
        ]);


        $pop = Genere::where ('nom','Pop')->first();
        $rock = Genere::where ('nom','Rock')->first();
        $electro = Genere::where ('nom','Electrònica')->first();
        $jazz = Genere::where ('nom','Jazz')->first();
        $hiphop = Genere::where ('nom','Hip-hop')->first();
        $indie = Genere::where ('nom','Indie')->first();

        $rosalia = Artista::where('nom','Rosalia')->first();
        if ($rosalia){
            $rosalia->generes()->attach([$pop->id, $electro->id]);
        }

        $badBunny = Artista::where('nom','Bad Bunny')->first();
        if ($badBunny){
            $badBunny->generes()->attach([$hiphop->id, $pop->id]);
        }

        $michaelJackson = Artista::where('nom','Michael Jackson')->first();
        if ($michaelJackson){
            $michaelJackson->generes()->attach([$pop->id, $rock->id]);
        }

        $billieEilish = Artista::where('nom','Billie Eilish')->first();
        if ($billieEilish){
            $billieEilish->generes()->attach([$pop->id, $indie->id]);
        }

        $stromae = Artista::where('nom','Stromae')->first();
        if ($stromae){
            $stromae->generes()->attach([$electro->id]);
        }

        $figaflawas = Artista::where('nom','Figa Flawas')->first();
        if ($figaflawas){
            $figaflawas->generes()->attach([$pop->id, $electro->id]);
        }


    }
}
