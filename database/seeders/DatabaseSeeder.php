<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ArtistaSeeder::class,
            ConcertSeeder::class,
            GenereSeeder::class,
            EscenariSeeder::class,
        ]);
    }
}
