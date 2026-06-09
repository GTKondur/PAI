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

        $akcja    = Gatunek::where('nazwa', 'Akcja')->first();
        $scifi    = Gatunek::where('nazwa', 'Sci-Fi')->first();
        $dramat   = Gatunek::where('nazwa', 'Dramat')->first();
        $thriller = Gatunek::where('nazwa', 'Thriller')->first();
        $fantasy  = Gatunek::where('nazwa', 'Fantasy')->first();
        $komedia  = Gatunek::where('nazwa', 'Komedia')->first();
        $horror   = Gatunek::where('nazwa', 'Horror')->first();
        $animacja = Gatunek::where('nazwa', 'Animacja')->first();
        $romans   = Gatunek::where('nazwa', 'Romans')->first();
        $dokument = Gatunek::where('nazwa', 'Dokumentalny')->first();

        $filmy = [
            ['tytul' => 'Inception', 'tytul_oryginalny' => 'Inception', 'rok_produkcji' => 2010, 'opis' => 'Złodziej wkradający się do snów ludzi zostaje poproszony o zaszczepienie idei.', 'czas_trwania_min' => 148, 'rezyser' => 'Christopher Nolan', 'typ' => 'film', 'dodane_przez' => $admin->id, 'gatunki' => [$akcja->id, $scifi->id, $thriller->id]],
            ['tytul' => 'Skazani na Shawshank', 'tytul_oryginalny' => 'The Shawshank Redemption', 'rok_produkcji' => 1994, 'opis' => 'Niesłusznie skazany bankier nawiązuje przyjaźń w więzieniu i szuka wolności.', 'czas_trwania_min' => 142, 'rezyser' => 'Frank Darabont', 'typ' => 'film', 'dodane_przez' => $admin->id, 'gatunki' => [$dramat->id]],
            ['tytul' => 'Interstellar', 'tytul_oryginalny' => 'Interstellar', 'rok_produkcji' => 2014, 'opis' => 'Astronauci podróżują przez tunel czasoprzestrzenny w poszukiwaniu nowego domu dla ludzkości.', 'czas_trwania_min' => 169, 'rezyser' => 'Christopher Nolan', 'typ' => 'film', 'dodane_przez' => $jan->id, 'gatunki' => [$scifi->id, $dramat->id]],
            ['tytul' => 'Władca Pierścieni: Drużyna Pierścienia', 'tytul_oryginalny' => 'The Lord of the Rings: The Fellowship of the Ring', 'rok_produkcji' => 2001, 'opis' => 'Hobbit wyrusza w epicką podróż by zniszczyć potężny pierścień.', 'czas_trwania_min' => 178, 'rezyser' => 'Peter Jackson', 'typ' => 'film', 'dodane_przez' => $anna->id, 'gatunki' => [$fantasy->id, $akcja->id]],
            ['tytul' => 'Mroczny Rycerz', 'tytul_oryginalny' => 'The Dark Knight', 'rok_produkcji' => 2008, 'opis' => 'Batman mierzy się z Jokerem, który sieje chaos w Gotham City.', 'czas_trwania_min' => 152, 'rezyser' => 'Christopher Nolan', 'typ' => 'film', 'dodane_przez' => $admin->id, 'gatunki' => [$akcja->id, $thriller->id]],
            ['tytul' => 'Pulp Fiction', 'tytul_oryginalny' => 'Pulp Fiction', 'rok_produkcji' => 1994, 'opis' => 'Przeplatające się historie przestępców, bokserów i gangsterów w Los Angeles.', 'czas_trwania_min' => 154, 'rezyser' => 'Quentin Tarantino', 'typ' => 'film', 'dodane_przez' => $admin->id, 'gatunki' => [$thriller->id, $dramat->id]],
            ['tytul' => 'Forrest Gump', 'tytul_oryginalny' => 'Forrest Gump', 'rok_produkcji' => 1994, 'opis' => 'Historia życia prostodusznego mężczyzny, który nieświadomie wpływa na losy Ameryki.', 'czas_trwania_min' => 142, 'rezyser' => 'Robert Zemeckis', 'typ' => 'film', 'dodane_przez' => $jan->id, 'gatunki' => [$dramat->id, $romans->id]],
            ['tytul' => 'Matrix', 'tytul_oryginalny' => 'The Matrix', 'rok_produkcji' => 1999, 'opis' => 'Haker odkrywa że rzeczywistość jest symulacją kontrolowaną przez maszyny.', 'czas_trwania_min' => 136, 'rezyser' => 'Lana Wachowski', 'typ' => 'film', 'dodane_przez' => $anna->id, 'gatunki' => [$scifi->id, $akcja->id]],
            ['tytul' => 'Ojciec Chrzestny', 'tytul_oryginalny' => 'The Godfather', 'rok_produkcji' => 1972, 'opis' => 'Starzejący się patriarcha mafijnej dynastii przekazuje władzę synowi.', 'czas_trwania_min' => 175, 'rezyser' => 'Francis Ford Coppola', 'typ' => 'film', 'dodane_przez' => $admin->id, 'gatunki' => [$dramat->id, $thriller->id]],
            ['tytul' => 'Gladiator', 'tytul_oryginalny' => 'Gladiator', 'rok_produkcji' => 2000, 'opis' => 'Zdradzone przez cesarza generał walczy o wolność na arenie gladiatorów.', 'czas_trwania_min' => 155, 'rezyser' => 'Ridley Scott', 'typ' => 'film', 'dodane_przez' => $jan->id, 'gatunki' => [$akcja->id, $dramat->id]],
            ['tytul' => 'Schiндlеrowa lista', 'tytul_oryginalny' => "Schindler's List", 'rok_produkcji' => 1993, 'opis' => 'Prawdziwa historia przemysłowca który ratuje tysiące Żydów podczas Holokaustu.', 'czas_trwania_min' => 195, 'rezyser' => 'Steven Spielberg', 'typ' => 'film', 'dodane_przez' => $admin->id, 'gatunki' => [$dramat->id]],
            ['tytul' => 'Lot nad kukułczym gniazdem', 'tytul_oryginalny' => 'One Flew Over the Cuckoo\'s Nest', 'rok_produkcji' => 1975, 'opis' => 'Przestępca symuluje chorobę psychiczną by trafić do szpitala zamiast więzienia.', 'czas_trwania_min' => 133, 'rezyser' => 'Miloš Forman', 'typ' => 'film', 'dodane_przez' => $anna->id, 'gatunki' => [$dramat->id]],
            ['tytul' => 'Gwiezdne Wojny: Nowa Nadzieja', 'tytul_oryginalny' => 'Star Wars: A New Hope', 'rok_produkcji' => 1977, 'opis' => 'Młody farmер dołącza do rebelii walczącej z Imperium Galaktycznym.', 'czas_trwania_min' => 121, 'rezyser' => 'George Lucas', 'typ' => 'film', 'dodane_przez' => $jan->id, 'gatunki' => [$scifi->id, $akcja->id, $fantasy->id]],
            ['tytul' => 'Skok', 'tytul_oryginalny' => 'The Departed', 'rok_produkcji' => 2006, 'opis' => 'Policjant infiltruje mafię, podczas gdy gangster infiltruje policję.', 'czas_trwania_min' => 151, 'rezyser' => 'Martin Scorsese', 'typ' => 'film', 'dodane_przez' => $admin->id, 'gatunki' => [$thriller->id, $dramat->id]],
            ['tytul' => 'Whiplash', 'tytul_oryginalny' => 'Whiplash', 'rok_produkcji' => 2014, 'opis' => 'Młody perkusista poddaje się brutalnemu treningowi wymagającego instruktora.', 'czas_trwania_min' => 107, 'rezyser' => 'Damien Chazelle', 'typ' => 'film', 'dodane_przez' => $anna->id, 'gatunki' => [$dramat->id]],
            ['tytul' => 'Parasite', 'tytul_oryginalny' => 'Parasite', 'rok_produkcji' => 2019, 'opis' => 'Biedna rodzina stopniowo wkracza w życie bogatej rodziny z Seulu.', 'czas_trwania_min' => 132, 'rezyser' => 'Bong Joon-ho', 'typ' => 'film', 'dodane_przez' => $jan->id, 'gatunki' => [$thriller->id, $dramat->id]],
            ['tytul' => 'Spirited Away', 'tytul_oryginalny' => 'Sen to Chihiro no Kamikakushi', 'rok_produkcji' => 2001, 'opis' => 'Dziewczynka trafia do świata duchów i musi pracować by uratować rodziców.', 'czas_trwania_min' => 125, 'rezyser' => 'Hayao Miyazaki', 'typ' => 'film', 'dodane_przez' => $anna->id, 'gatunki' => [$animacja->id, $fantasy->id]],
            ['tytul' => 'Joker', 'tytul_oryginalny' => 'Joker', 'rok_produkcji' => 2019, 'opis' => 'Historia powstania Jokera — komika który zamienia się w przestępcę.', 'czas_trwania_min' => 122, 'rezyser' => 'Todd Phillips', 'typ' => 'film', 'dodane_przez' => $admin->id, 'gatunki' => [$dramat->id, $thriller->id]],
            ['tytul' => 'Avengers: Koniec gry', 'tytul_oryginalny' => 'Avengers: Endgame', 'rok_produkcji' => 2019, 'opis' => 'Ocalali bohaterowie Marvela próbują odwrócić skutki działań Thanosa.', 'czas_trwania_min' => 181, 'rezyser' => 'Anthony i Joe Russo', 'typ' => 'film', 'dodane_przez' => $jan->id, 'gatunki' => [$akcja->id, $scifi->id]],
            ['tytul' => 'The Witcher', 'tytul_oryginalny' => 'The Witcher', 'rok_produkcji' => 2019, 'opis' => 'Wiedźmin Geralt z Rivii wędruje po kontynencie szukając swego przeznaczenia.', 'czas_trwania_min' => 60, 'rezyser' => 'Lauren Schmidt Hissrich', 'typ' => 'serial', 'dodane_przez' => $admin->id, 'gatunki' => [$fantasy->id, $akcja->id]],
            ['tytul' => 'Breaking Bad', 'tytul_oryginalny' => 'Breaking Bad', 'rok_produkcji' => 2008, 'opis' => 'Nauczyciel chemii chory na raka zaczyna produkować metamfetaminę.', 'czas_trwania_min' => 47, 'rezyser' => 'Vince Gilligan', 'typ' => 'serial', 'dodane_przez' => $anna->id, 'gatunki' => [$thriller->id, $dramat->id]],
            ['tytul' => 'Chernobyl', 'tytul_oryginalny' => 'Chernobyl', 'rok_produkcji' => 2019, 'opis' => 'Miniserial o katastrofie nuklearnej w Czarnobylu i jej konsekwencjach.', 'czas_trwania_min' => 60, 'rezyser' => 'Johan Renck', 'typ' => 'serial', 'dodane_przez' => $jan->id, 'gatunki' => [$dramat->id, $dokument->id]],
            ['tytul' => 'Stranger Things', 'tytul_oryginalny' => 'Stranger Things', 'rok_produkcji' => 2016, 'opis' => 'Grupa dzieci odkrywa nadprzyrodzone tajemnice w swoim miasteczku.', 'czas_trwania_min' => 50, 'rezyser' => 'Bracia Duffer', 'typ' => 'serial', 'dodane_przez' => $admin->id, 'gatunki' => [$scifi->id, $horror->id]],
            ['tytul' => 'Seinfeld', 'tytul_oryginalny' => 'Seinfeld', 'rok_produkcji' => 1989, 'opis' => 'Komediowy serial o perypetiach komika Jerry Seinfelda i jego przyjaciół.', 'czas_trwania_min' => 22, 'rezyser' => 'Jerry Seinfeld', 'typ' => 'serial', 'dodane_przez' => $anna->id, 'gatunki' => [$komedia->id]],
            ['tytul' => 'Bohemian Rhapsody', 'tytul_oryginalny' => 'Bohemian Rhapsody', 'rok_produkcji' => 2018, 'opis' => 'Biografia Freddiego Mercury i historii zespołu Queen.', 'czas_trwania_min' => 134, 'rezyser' => 'Bryan Singer', 'typ' => 'film', 'dodane_przez' => $jan->id, 'gatunki' => [$dramat->id]],
            ['tytul' => 'Django', 'tytul_oryginalny' => 'Django Unchained', 'rok_produkcji' => 2012, 'opis' => 'Wyzwolony niewolnik wyrusza by uratować żonę z rąk okrutnego plantatora.', 'czas_trwania_min' => 165, 'rezyser' => 'Quentin Tarantino', 'typ' => 'film', 'dodane_przez' => $admin->id, 'gatunki' => [$akcja->id, $dramat->id]],
            ['tytul' => 'Leon Zawodowiec', 'tytul_oryginalny' => 'Léon: The Professional', 'rok_produkcji' => 1994, 'opis' => 'Zawodowy zabójca zaprzyjaźnia się z małą dziewczynką której rodzina została zamordowana.', 'czas_trwania_min' => 110, 'rezyser' => 'Luc Besson', 'typ' => 'film', 'dodane_przez' => $anna->id, 'gatunki' => [$akcja->id, $thriller->id]],
            ['tytul' => 'Piękny umysł', 'tytul_oryginalny' => 'A Beautiful Mind', 'rok_produkcji' => 2001, 'opis' => 'Biografia matematyka Johna Nasha zmagającego się ze schizofrenią.', 'czas_trwania_min' => 135, 'rezyser' => 'Ron Howard', 'typ' => 'film', 'dodane_przez' => $jan->id, 'gatunki' => [$dramat->id]],
            ['tytul' => 'Titanik', 'tytul_oryginalny' => 'Titanic', 'rok_produkcji' => 1997, 'opis' => 'Historia miłosna rozgrywająca się podczas katastrofy statku Titanic.', 'czas_trwania_min' => 194, 'rezyser' => 'James Cameron', 'typ' => 'film', 'dodane_przez' => $admin->id, 'gatunki' => [$romans->id, $dramat->id]],
            ['tytul' => 'Siedem', 'tytul_oryginalny' => 'Se7en', 'rok_produkcji' => 1995, 'opis' => 'Dwóch detektywów ściga seryjnego mordercę inspirowanego siedmioma grzechami głównymi.', 'czas_trwania_min' => 127, 'rezyser' => 'David Fincher', 'typ' => 'film', 'dodane_przez' => $anna->id, 'gatunki' => [$thriller->id, $dramat->id]],
            ['tytul' => 'Sieć kłamstw', 'tytul_oryginalny' => 'Catch Me If You Can', 'rok_produkcji' => 2002, 'opis' => 'Prawdziwa historia Franka Abagnale — mistrza oszustw ściganego przez FBI.', 'czas_trwania_min' => 141, 'rezyser' => 'Steven Spielberg', 'typ' => 'film', 'dodane_przez' => $jan->id, 'gatunki' => [$thriller->id, $komedia->id]],
            ['tytul' => 'Up', 'tytul_oryginalny' => 'Up', 'rok_produkcji' => 2009, 'opis' => 'Starszy pan przywiązuje do domu tysiące balonów i wyrusza w podróż do Ameryki Południowej.', 'czas_trwania_min' => 96, 'rezyser' => 'Pete Docter', 'typ' => 'film', 'dodane_przez' => $anna->id, 'gatunki' => [$animacja->id, $romans->id]],
            ['tytul' => 'Incepcja strachu', 'tytul_oryginalny' => 'The Silence of the Lambs', 'rok_produkcji' => 1991, 'opis' => 'Agentka FBI musi wydobyć informacje od kanibalskiego psychiatry by złapać seryjnego mordercę.', 'czas_trwania_min' => 118, 'rezyser' => 'Jonathan Demme', 'typ' => 'film', 'dodane_przez' => $admin->id, 'gatunki' => [$thriller->id, $horror->id]],
            ['tytul' => 'Oppenheimer', 'tytul_oryginalny' => 'Oppenheimer', 'rok_produkcji' => 2023, 'opis' => 'Historia twórcy bomby atomowej J. Roberta Oppenheimera.', 'czas_trwania_min' => 180, 'rezyser' => 'Christopher Nolan', 'typ' => 'film', 'dodane_przez' => $jan->id, 'gatunki' => [$dramat->id, $thriller->id]],
            ['tytul' => 'Barbie', 'tytul_oryginalny' => 'Barbie', 'rok_produkcji' => 2023, 'opis' => 'Barbie i Ken wyruszają z Barbieland do prawdziwego świata.', 'czas_trwania_min' => 114, 'rezyser' => 'Greta Gerwig', 'typ' => 'film', 'dodane_przez' => $anna->id, 'gatunki' => [$komedia->id, $fantasy->id]],
            ['tytul' => 'Dune', 'tytul_oryginalny' => 'Dune: Part One', 'rok_produkcji' => 2021, 'opis' => 'Młody arystokrata przybywa na pustynną planetę będącą źródłem cennej przyprawy.', 'czas_trwania_min' => 155, 'rezyser' => 'Denis Villeneuve', 'typ' => 'film', 'dodane_przez' => $admin->id, 'gatunki' => [$scifi->id, $akcja->id]],
            ['tytul' => 'Squid Game', 'tytul_oryginalny' => 'Squid Game', 'rok_produkcji' => 2021, 'opis' => 'Zadłużeni ludzie biorą udział w śmiertelnie niebezpiecznych grach dziecięcych.', 'czas_trwania_min' => 60, 'rezyser' => 'Hwang Dong-hyuk', 'typ' => 'serial', 'dodane_przez' => $jan->id, 'gatunki' => [$thriller->id, $dramat->id]],
        ];

        foreach ($filmy as $dane) {
            $gatunkiIds = $dane['gatunki'];
            unset($dane['gatunki']);
            $film = Film::create($dane);
            $film->gatunki()->attach($gatunkiIds);
        }

        // Oceny
        $oceny = [
            [$jan->id, 1, 9], [$anna->id, 1, 8], [$jan->id, 2, 10],
            [$anna->id, 3, 9], [$jan->id, 4, 10], [$anna->id, 5, 9],
            [$jan->id, 6, 8], [$anna->id, 7, 9], [$jan->id, 8, 10],
            [$anna->id, 9, 9], [$jan->id, 10, 8], [$anna->id, 11, 10],
        ];

        foreach ($oceny as [$uid, $fid, $val]) {
            Ocena::create(['uzytkownik_id' => $uid, 'film_id' => $fid, 'wartosc' => $val]);
        }

        // Recenzje
        Recenzja::create(['uzytkownik_id' => $jan->id, 'film_id' => 1, 'tresc' => 'Niesamowity film! Nolan po raz kolejny zaskakuje pomysłowością.', 'ukryta' => false]);
        Recenzja::create(['uzytkownik_id' => $anna->id, 'film_id' => 2, 'tresc' => 'Jeden z najlepszych dramatów wszech czasów. Obowiązkowy seans.', 'ukryta' => false]);
        Recenzja::create(['uzytkownik_id' => $anna->id, 'film_id' => 5, 'tresc' => 'Heath Ledger jako Joker to rola życia. Absolutne arcydzieło.', 'ukryta' => false]);
    }
}