<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Gatunek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        $query = Film::with(['gatunki', 'oceny']);

        if ($request->filled('szukaj')) {
            $query->where('tytul', 'like', '%' . $request->szukaj . '%')
                  ->orWhere('rezyser', 'like', '%' . $request->szukaj . '%');
        }

        if ($request->filled('gatunek')) {
            $query->whereHas('gatunki', fn($q) => $q->where('gatunki.id', $request->gatunek));
        }

        if ($request->filled('typ')) {
            $query->where('typ', $request->typ);
        }

        $filmy = $query->latest()->paginate(12);
        $gatunki = Gatunek::orderBy('nazwa')->get();

        if ($request->ajax()) {
            return response()->json([
                'html'          => view('filmy._lista', compact('filmy'))->render(),
                'next_page_url' => $filmy->appends($request->query())->nextPageUrl(),
                'current_page'  => $filmy->currentPage(),
                'last_page'     => $filmy->lastPage(),
        ]);
}

        return view('filmy.index', compact('filmy', 'gatunki'));
    }

    public function show(Film $film)
    {
        $film->load(['gatunki', 'oceny', 'recenzje.uzytkownik', 'dodanyPrzez']);

        $mojOcena = null;
        $mojStatus = null;

        if (Auth::check()) {
            $mojOcena = $film->oceny()->where('uzytkownik_id', Auth::id())->first();
            $mojStatus = $film->listaUzytkownikow()->where('uzytkownik_id', Auth::id())->first();
        }

        return view('filmy.show', compact('film', 'mojOcena', 'mojStatus'));
    }

    public function create()
    {
        $gatunki = Gatunek::orderBy('nazwa')->get();
        return view('filmy.create', compact('gatunki'));
    }

    public function store(Request $request)
    {
        $dane = $request->validate([
            'tytul'            => 'required|string|max:255',
            'tytul_oryginalny' => 'nullable|string|max:255',
            'rok_produkcji'    => 'nullable|integer|min:1888|max:2100',
            'opis'             => 'nullable|string',
            'czas_trwania_min' => 'nullable|integer|min:1',
            'plakat_url'       => 'nullable|url|max:500',
            'rezyser'          => 'nullable|string|max:255',
            'typ'              => 'required|in:film,serial',
            'gatunki'          => 'nullable|array',
            'gatunki.*'        => 'exists:gatunki,id',
        ]);

        $dane['dodane_przez'] = Auth::id();
        $gatunkiIds = $dane['gatunki'] ?? [];
        unset($dane['gatunki']);

        $film = Film::create($dane);
        $film->gatunki()->attach($gatunkiIds);

        return redirect()->route('filmy.show', $film)->with('sukces', 'Film został dodany!');
    }

    public function edit(Film $film)
    {
        $gatunki = Gatunek::orderBy('nazwa')->get();
        $wybrane = $film->gatunki->pluck('id')->toArray();
        return view('filmy.edit', compact('film', 'gatunki', 'wybrane'));
    }

    public function update(Request $request, Film $film)
    {
        $dane = $request->validate([
            'tytul'            => 'required|string|max:255',
            'tytul_oryginalny' => 'nullable|string|max:255',
            'rok_produkcji'    => 'nullable|integer|min:1888|max:2100',
            'opis'             => 'nullable|string',
            'czas_trwania_min' => 'nullable|integer|min:1',
            'plakat_url'       => 'nullable|url|max:500',
            'rezyser'          => 'nullable|string|max:255',
            'typ'              => 'required|in:film,serial',
            'gatunki'          => 'nullable|array',
            'gatunki.*'        => 'exists:gatunki,id',
        ]);

        $gatunkiIds = $dane['gatunki'] ?? [];
        unset($dane['gatunki']);

        $film->update($dane);
        $film->gatunki()->sync($gatunkiIds);

        return redirect()->route('filmy.show', $film)->with('sukces', 'Film został zaktualizowany!');
    }

    public function destroy(Film $film)
    {
        $film->delete();
        return redirect()->route('filmy.index')->with('sukces', 'Film został usunięty!');
    }
}