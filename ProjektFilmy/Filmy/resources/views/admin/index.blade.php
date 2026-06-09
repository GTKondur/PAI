@extends('layouts.app')

@section('title', 'Panel admina')

@section('content')

<h1 class="text-3xl font-bold text-yellow-400 mb-8">⚙️ Panel admina</h1>

{{-- Komunikaty --}}
@if(session('sukces'))
    <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-4 py-3 rounded mb-6">
        ✅ {{ session('sukces') }}
    </div>
@endif
@if(session('blad'))
    <div class="bg-red-500/20 border border-red-500/50 text-red-400 px-4 py-3 rounded mb-6">
        ❌ {{ session('blad') }}
    </div>
@endif

{{-- STATYSTYKI --}}
<section class="mb-10">
    <h2 class="text-xl font-bold text-gray-100 mb-4">📊 Statystyki systemu</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
            <p class="text-3xl font-bold text-yellow-400">{{ $statystyki['filmy_total'] }}</p>
            <p class="text-gray-400 text-sm mt-1">Wszystkich tytułów</p>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
            <p class="text-3xl font-bold text-blue-400">{{ $statystyki['filmy_filmy'] }}</p>
            <p class="text-gray-400 text-sm mt-1">Filmów</p>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
            <p class="text-3xl font-bold text-purple-400">{{ $statystyki['filmy_seriale'] }}</p>
            <p class="text-gray-400 text-sm mt-1">Seriali</p>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
            <p class="text-3xl font-bold text-green-400">{{ $statystyki['uzytkownicy'] }}</p>
            <p class="text-gray-400 text-sm mt-1">Użytkowników</p>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
            <p class="text-3xl font-bold text-green-400">{{ $statystyki['aktywni'] }}</p>
            <p class="text-gray-400 text-sm mt-1">Aktywnych</p>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
            <p class="text-3xl font-bold text-red-400">{{ $statystyki['zablokowani'] }}</p>
            <p class="text-gray-400 text-sm mt-1">Zablokowanych</p>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
            <p class="text-3xl font-bold text-yellow-400">{{ $statystyki['oceny_total'] }}</p>
            <p class="text-gray-400 text-sm mt-1">Wystawionych ocen</p>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
            <p class="text-3xl font-bold text-orange-400">{{ $statystyki['recenzje_total'] }}</p>
            <p class="text-gray-400 text-sm mt-1">Recenzji
                <span class="text-red-400">({{ $statystyki['recenzje_ukryte'] }} ukrytych)</span>
            </p>
        </div>
    </div>
</section>

{{-- UŻYTKOWNICY --}}
<section class="mb-10">
    <h2 class="text-xl font-bold text-gray-100 mb-4">👥 Użytkownicy</h2>
    <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-700 text-gray-400">
                <tr>
                    <th class="text-left px-4 py-3">Użytkownik</th>
                    <th class="text-center px-4 py-3">Rola</th>
                    <th class="text-center px-4 py-3">Filmy</th>
                    <th class="text-center px-4 py-3">Recenzje</th>
                    <th class="text-center px-4 py-3">Oceny</th>
                    <th class="text-center px-4 py-3">Status</th>
                    <th class="text-center px-4 py-3">Akcje</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @foreach($uzytkownicy as $user)
                    <tr class="text-gray-300 hover:bg-gray-700/50 transition">

                        <td class="px-4 py-3">
                            <p class="font-semibold text-gray-100">{{ $user->name }}</p>
                            <p class="text-gray-500 text-xs">{{ $user->email }}</p>
                        </td>

                        <td class="text-center px-4 py-3">
                            @if($user->rola === 'admin')
                                <span class="bg-red-500/20 text-red-400 border border-red-500/30 text-xs px-2 py-1 rounded-full">Admin</span>
                            @elseif($user->rola === 'moderator')
                                <span class="bg-blue-500/20 text-blue-400 border border-blue-500/30 text-xs px-2 py-1 rounded-full">Moderator</span>
                            @else
                                <span class="bg-gray-500/20 text-gray-400 border border-gray-500/30 text-xs px-2 py-1 rounded-full">Użytkownik</span>
                            @endif
                        </td>

                        <td class="text-center px-4 py-3">{{ $user->filmy_count }}</td>
                        <td class="text-center px-4 py-3">{{ $user->recenzje_count }}</td>
                        <td class="text-center px-4 py-3">{{ $user->oceny_count }}</td>

                        <td class="text-center px-4 py-3">
                            @if($user->aktywny)
                                <span class="bg-green-500/20 text-green-400 border border-green-500/30 text-xs px-2 py-1 rounded-full">Aktywny</span>
                            @else
                                <span class="bg-red-500/20 text-red-400 border border-red-500/30 text-xs px-2 py-1 rounded-full">Zablokowany</span>
                            @endif
                        </td>

                        <td class="text-center px-4 py-3">
                            @if($user->id !== auth()->id())
                                <div class="flex items-center justify-center gap-2 flex-wrap">

                                    {{-- Zablokuj / Odblokuj --}}
                                    @if($user->rola !== 'admin')
                                        <form method="POST" action="{{ route('admin.uzytkownicy.toggle', $user) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="text-xs px-2 py-1 rounded font-semibold transition
                                                    {{ $user->aktywny
                                                        ? 'bg-red-500/20 text-red-400 hover:bg-red-500/40 border border-red-500/30'
                                                        : 'bg-green-500/20 text-green-400 hover:bg-green-500/40 border border-green-500/30' }}">
                                                {{ $user->aktywny ? 'Zablokuj' : 'Odblokuj' }}
                                            </button>
                                        </form>
                                    @endif

                                    {{-- + / - Moderator --}}
                                    @if($user->rola !== 'admin')
                                        <form method="POST" action="{{ route('admin.uzytkownicy.rola', $user) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="rola"
                                                value="{{ $user->rola === 'moderator' ? 'user' : 'moderator' }}">
                                            <button type="submit"
                                                class="text-xs px-2 py-1 rounded font-semibold transition
                                                    {{ $user->rola === 'moderator'
                                                        ? 'bg-gray-500/20 text-gray-400 hover:bg-gray-500/40 border border-gray-500/30'
                                                        : 'bg-blue-500/20 text-blue-400 hover:bg-blue-500/40 border border-blue-500/30' }}">
                                                {{ $user->rola === 'moderator' ? '− Moderator' : '+ Moderator' }}
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Usuń konto --}}
                                    @if($user->rola !== 'admin')
                                        <form method="POST" action="{{ route('admin.uzytkownicy.usun', $user) }}"
                                              onsubmit="return confirm('Na pewno usunąć konto {{ addslashes($user->name) }}? Tej operacji nie można cofnąć!')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-xs px-2 py-1 rounded font-semibold transition bg-red-900/40 text-red-400 hover:bg-red-900/70 border border-red-500/30">
                                                🗑 Usuń
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            @else
                                <span class="text-gray-600 text-xs">to Ty</span>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

{{-- RECENZJE --}}
<section>
    <h2 class="text-xl font-bold text-gray-100 mb-4">💬 Recenzje</h2>
    <div class="space-y-4">
        @forelse($recenzje as $recenzja)
            <div class="bg-gray-800 border {{ $recenzja->ukryta ? 'border-red-500/30 opacity-60' : 'border-gray-700' }} rounded-lg p-4">
                <div class="flex justify-between items-start gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1 flex-wrap">
                            <span class="font-semibold text-gray-100 text-sm">{{ $recenzja->uzytkownik->name }}</span>
                            <span class="text-gray-600 text-xs">•</span>
                            <a href="{{ route('filmy.show', $recenzja->film) }}"
                               class="text-yellow-400 text-xs hover:underline">
                                {{ $recenzja->film->tytul }}
                            </a>
                            <span class="text-gray-600 text-xs">•</span>
                            <span class="text-gray-500 text-xs">
                                {{ \Carbon\Carbon::parse($recenzja->data_dodania)->format('d.m.Y') }}
                            </span>
                            @if($recenzja->ukryta)
                                <span class="bg-red-500/20 text-red-400 border border-red-500/30 text-xs px-2 py-0.5 rounded-full">Ukryta</span>
                            @endif
                        </div>
                        <p class="text-gray-300 text-sm">{{ $recenzja->tresc }}</p>
                    </div>
                    <form method="POST" action="{{ route('admin.recenzje.ukryj', $recenzja) }}" class="shrink-0">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="text-xs px-3 py-1 rounded font-semibold transition
                                {{ $recenzja->ukryta
                                    ? 'bg-green-500/20 text-green-400 hover:bg-green-500/40 border border-green-500/30'
                                    : 'bg-red-500/20 text-red-400 hover:bg-red-500/40 border border-red-500/30' }}">
                            {{ $recenzja->ukryta ? 'Pokaż' : 'Ukryj' }}
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center py-8">Brak recenzji.</p>
        @endforelse
    </div>
</section>

@endsection