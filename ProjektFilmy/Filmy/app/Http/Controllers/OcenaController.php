<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Ocena;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OcenaController extends Controller
{
    public function store(Request $request, Film $film)
    {
        $request->validate([
            'wartosc' => 'required|integer|min:1|max:10',
        ]);

        Ocena::updateOrCreate(
            ['uzytkownik_id' => Auth::id(), 'film_id' => $film->id],
            ['wartosc' => $request->wartosc]
        );

        return back()->with('sukces', 'Ocena została zapisana!');
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'wartosc' => 'required|integer|min:1|max:10',
        ]);

        Ocena::where('uzytkownik_id', Auth::id())
            ->where('film_id', $film->id)
            ->update(['wartosc' => $request->wartosc]);

        return back()->with('sukces', 'Ocena została zaktualizowana!');
    }
}