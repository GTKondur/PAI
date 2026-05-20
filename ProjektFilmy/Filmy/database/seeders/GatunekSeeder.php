<?php

namespace Database\Seeders;

use App\Models\Gatunek;
use Illuminate\Database\Seeder;

class GatunekSeeder extends Seeder
{
    public function run(): void
    {
        $gatunki = [
            'Akcja', 'Komedia', 'Dramat', 'Horror', 'Sci-Fi',
            'Romans', 'Thriller', 'Animacja', 'Dokumentalny', 'Fantasy',
        ];

        foreach ($gatunki as $nazwa) {
            Gatunek::create(['nazwa' => $nazwa]);
        }
    }
}