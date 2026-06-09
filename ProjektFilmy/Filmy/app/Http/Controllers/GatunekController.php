<?php

namespace App\Http\Controllers;

use App\Models\Gatunek;
use Illuminate\Http\Request;

class GatunekController extends Controller
{
    public function index()
    {
        $gatunki = Gatunek::withCount('filmy')->orderBy('nazwa')->get();
        return view('gatunki.index', compact('gatunki'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nazwa' => 'required|string|max:100|unique:gatunki,nazwa',
        ]);

        Gatunek::create(['nazwa' => $request->nazwa]);
        return back()->with('sukces', 'Gatunek został dodany!');
    }

    public function destroy(Gatunek $gatunek)
    {
        if ($gatunek->filmy()->count() > 0) {
            return back()->with('blad', 'Nie można usunąć gatunku przypisanego do filmów!');
        }

        $gatunek->delete();
        return back()->with('sukces', 'Gatunek został usunięty!');
    }
}