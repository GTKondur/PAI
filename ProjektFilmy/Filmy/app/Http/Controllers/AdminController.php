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

    $statystyki = [
        'filmy_total'     => \App\Models\Film::count(),
        'filmy_filmy'     => \App\Models\Film::where('typ', 'film')->count(),
        'filmy_seriale'   => \App\Models\Film::where('typ', 'serial')->count(),
        'uzytkownicy'     => User::count(),
        'aktywni'         => User::where('aktywny', true)->count(),
        'zablokowani'     => User::where('aktywny', false)->count(),
        'recenzje_total'  => Recenzja::count(),
        'recenzje_ukryte' => Recenzja::where('ukryta', true)->count(),
        'oceny_total'     => \App\Models\Ocena::count(),
    ];

    return view('admin.index', compact('uzytkownicy', 'recenzje', 'statystyki'));
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

    if ($user->rola === 'admin') {
        return back()->with('blad', 'Nie możesz zablokować innego admina!');
    }

    $user->update(['aktywny' => !$user->aktywny]);
    return back()->with('sukces', 'Status użytkownika zmieniony!');
}

    public function zmienRole(Request $request, User $user)
{
    if ($user->id === Auth::id()) {
        return back()->with('blad', 'Nie możesz zmienić własnej roli!');
    }

    $request->validate([
        'rola' => 'required|in:user,moderator,admin',
    ]);

    $user->update(['rola' => $request->rola]);
    return back()->with('sukces', 'Rola użytkownika zmieniona!');
}

public function usunUzytkownika(User $user)
{
    if ($user->id === Auth::id()) {
        return back()->with('blad', 'Nie możesz usunąć własnego konta!');
    }

    if ($user->rola === 'admin') {
        return back()->with('blad', 'Nie możesz usunąć konta admina!');
    }

    $user->delete();
    return back()->with('sukces', 'Konto użytkownika zostało usunięte!');
}

}