<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\ListaUzytkownika;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListaController extends Controller
{
    public function index()
    {
        $lista = ListaUzytkownika::with('film.gatunki')
            ->where('uzytkownik_id', Auth::id())
            ->get()
            ->groupBy('status');

        return view('lista.index', compact('lista'));
    }

    public function store(Request $request, Film $film)
    {
        $request->validate([
            'status' => 'required|in:chce_obejrzec,oglądam,obejrzane,porzucone',
        ]);

        ListaUzytkownika::updateOrCreate(
            ['uzytkownik_id' => Auth::id(), 'film_id' => $film->id],
            [
                'status'      => $request->status,
                'data_dodania' => now()->toDateString(),
            ]
        );

        return back()->with('sukces', 'Dodano do listy!');
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'status' => 'required|in:chce_obejrzec,oglądam,obejrzane,porzucone',
        ]);

        $wpis = ListaUzytkownika::where('uzytkownik_id', Auth::id())
            ->where('film_id', $film->id)
            ->firstOrFail();

        $wpis->update([
            'status'          => $request->status,
            'data_obejrzenia' => $request->status === 'obejrzane' ? now()->toDateString() : null,
        ]);

        return back()->with('sukces', 'Lista zaktualizowana!');
    }

    public function destroy(Film $film)
    {
        ListaUzytkownika::where('uzytkownik_id', Auth::id())
            ->where('film_id', $film->id)
            ->delete();

        return back()->with('sukces', 'Usunięto z listy!');
    }
}