<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Recenzja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecenzjaController extends Controller
{
    public function store(Request $request, Film $film)
    {
        $request->validate([
            'tresc' => 'required|string|min:10|max:2000',
        ]);

        Recenzja::create([
            'uzytkownik_id' => Auth::id(),
            'film_id'       => $film->id,
            'tresc'         => $request->tresc,
        ]);

        return back()->with('sukces', 'Recenzja została dodana!');
    }

    public function destroy(Recenzja $recenzja)
    {
        if (Auth::id() !== $recenzja->uzytkownik_id && Auth::user()->rola !== 'admin') {
            abort(403);
        }

        $recenzja->delete();
        return back()->with('sukces', 'Recenzja została usunięta!');
    }
}