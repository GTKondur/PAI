<?php

namespace App\Http\Controllers;

use App\Models\Recenzja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $uzytkownicy = User::withCount(['filmy', 'recenzje', 'oceny'])->get();
        $recenzje = Recenzja::with(['uzytkownik', 'film'])->latest('data_dodania')->get();

        return view('admin.index', compact('uzytkownicy', 'recenzje'));
    }

    public function ukryjRecenzje(Recenzja $recenzja)
    {
        $recenzja->update([
            'ukryta'      => !$recenzja->ukryta,
            'ukryta_przez' => Auth::id(),
        ]);

        return back()->with('sukces', 'Status recenzji zmieniony!');
    }

    public function toggleUser(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('blad', 'Nie możesz dezaktywować własnego konta!');
        }

        $user->update(['aktywny' => !$user->aktywny]);
        return back()->with('sukces', 'Status użytkownika zmieniony!');
    }
}