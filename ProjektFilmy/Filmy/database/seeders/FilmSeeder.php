<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Gatunek;
use App\Models\Ocena;
use App\Models\Recenzja;
use App\Models\User;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@movietracker.pl')->first();
        $jan   = User::where('email', 'jan@movietracker.pl')->first();
        $anna  = User::where('email', 'anna@movietracker.pl')->first();

        $akcja   = Gatunek::where('nazwa', 'Akcja')->first();
        $scifi   = Gatunek::where('nazwa', 'Sci-Fi')->first();
        $dramat  = Gatunek::where('nazwa', 'Dramat')->first();
        $thriller = Gatunek::where('nazwa', 'Thriller')->first();
        $fantasy = Gatunek::where('nazwa', 'Fantasy')->first();

        $filmy = [
            [
                'tytul'            => 'Inception',
                'tytul_oryginalny' => 'Inception',
                'rok_produkcji'    => 2010,
                'opis'             => 'Złodziej wkradający się do snów ludzi zostaje poproszony o zaszczepienie idei.',
                'czas_trwania_min' => 148,
                'rezyser'          => 'Christopher Nolan',
                'typ'              => 'film',
                'dodane_przez'     => $admin->id,
                'gatunki'          => [$akcja->id, $scifi->id, $thriller->id],
            ],
            [
                'tytul'            => 'Skazani na Shawshank',
                'tytul_oryginalny' => 'The Shawshank Redemption',
                'rok_produkcji'    => 1994,
                'opis'             => 'Niesłusznie skazany bankier nawiązuje przyjaźń w więzieniu i szuka wolności.',
                'czas_trwania_min' => 142,
                'rezyser'          => 'Frank Darabont',
                'typ'              => 'film',
                'dodane_przez'     => $admin->id,
                'gatunki'          => [$dramat->id],
            ],
            [
                'tytul'            => 'Interstellar',
                'tytul_oryginalny' => 'Interstellar',
                'rok_produkcji'    => 2014,
                'opis'             => 'Astronauci podróżują przez tunel czasoprzestrzenny w poszukiwaniu nowego domu dla ludzkości.',
                'czas_trwania_min' => 169,
                'rezyser'          => 'Christopher Nolan',
                'typ'              => 'film',
                'dodane_przez'     => $jan->id,
                'gatunki'          => [$scifi->id, $dramat->id],
            ],
            [
                'tytul'            => 'Władca Pierścieni: Drużyna Pierścienia',
                'tytul_oryginalny' => 'The Lord of the Rings: The Fellowship of the Ring',
                'rok_produkcji'    => 2001,
                'opis'             => 'Hobbit wyrusza w epicką podróż by zniszczyć potężny pierścień.',
                'czas_trwania_min' => 178,
                'rezyser'          => 'Peter Jackson',
                'typ'              => 'film',
                'dodane_przez'     => $anna->id,
                'gatunki'          => [$fantasy->id, $akcja->id],
            ],
        ];

        foreach ($filmy as $dane) {
            $gatunkiIds = $dane['gatunki'];
            unset($dane['gatunki']);

            $film = Film::create($dane);
            $film->gatunki()->attach($gatunkiIds);
        }

        // Oceny
        Ocena::create(['uzytkownik_id' => $jan->id,  'film_id' => 1, 'wartosc' => 9]);
        Ocena::create(['uzytkownik_id' => $anna->id, 'film_id' => 1, 'wartosc' => 8]);
        Ocena::create(['uzytkownik_id' => $jan->id,  'film_id' => 2, 'wartosc' => 10]);
        Ocena::create(['uzytkownik_id' => $anna->id, 'film_id' => 3, 'wartosc' => 9]);
        Ocena::create(['uzytkownik_id' => $jan->id,  'film_id' => 4, 'wartosc' => 10]);

        // Recenzje
        Recenzja::create([
            'uzytkownik_id' => $jan->id,
            'film_id'       => 1,
            'tresc'         => 'Niesamowity film! Nolan po raz kolejny zaskakuje pomysłowością.',
            'ukryta'        => false,
        ]);
        Recenzja::create([
            'uzytkownik_id' => $anna->id,
            'film_id'       => 2,
            'tresc'         => 'Jeden z najlepszych dramatów wszech czasów. Obowiązkowy seans.',
            'ukryta'        => false,
        ]);
    }
}