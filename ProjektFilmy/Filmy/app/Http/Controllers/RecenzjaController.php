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

    public function update(Request $request, Recenzja $recenzja)
    {
        if (Auth::id() !== $recenzja->uzytkownik_id) {
            abort(403);
        }

        $request->validate([
            'tresc' => 'required|string|min:10|max:2000',
        ]);

        $recenzja->update(['tresc' => $request->tresc]);
        return back()->with('sukces', 'Recenzja została zaktualizowana!');
    }

    public function destroy(Recenzja $recenzja)
    {
        $user = Auth::user();
        $mozeUsunac = $user->id === $recenzja->uzytkownik_id
            || in_array($user->rola, ['admin', 'moderator']);

        if (!$mozeUsunac) {
            abort(403);
        }

        $recenzja->delete();
        return back()->with('sukces', 'Recenzja została usunięta!');
    }

    public function ukryj(Recenzja $recenzja)
    {
        $user = Auth::user();
        if (!in_array($user->rola, ['admin', 'moderator'])) {
            abort(403);
        }

        $recenzja->update([
            'ukryta'       => !$recenzja->ukryta,
            'ukryta_przez' => Auth::id(),
        ]);

        return back()->with('sukces', 'Status recenzji zmieniony!');
    }
}