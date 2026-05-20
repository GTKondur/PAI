@extends('layouts.app')

@section('title', $film->tytul)

@section('content')

<div class="mb-4">
    <a href="{{ route('filmy.index') }}" class="text-yellow-400 hover:text-yellow-300 text-sm transition">
        ← Wróć do listy
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">

    {{-- Lewa kolumna --}}
    <div class="md:col-span-1">

        {{-- Plakat --}}
        <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700">
            @if($film->plakat_url)
                <img src="{{ $film->plakat_url }}" alt="{{ $film->tytul }}" class="w-full">
            @else
                <div class="h-96 flex items-center justify-center text-gray-500 text-6xl">🎬</div>
            @endif
        </div>

        {{-- Dodaj do listy --}}
        @auth
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 mt-4">
            <h3 class="text-gray-300 font-semibold mb-3">📋 Moja lista</h3>
            <form method="POST" action="{{ $mojStatus ? route('lista.update', $film) : route('lista.store', $film) }}">
                @csrf
                @if($mojStatus)
                    @method('PATCH')
                @endif
                <select name="status" class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded px-3 py-2 mb-3 focus:outline-none focus:border-yellow-400">
                    <option value="chce_obejrzec" {{ $mojStatus?->status === 'chce_obejrzec' ? 'selected' : '' }}>Chcę obejrzeć</option>
                    <option value="oglądam" {{ $mojStatus?->status === 'oglądam' ? 'selected' : '' }}>Oglądam</option>
                    <option value="obejrzane" {{ $mojStatus?->status === 'obejrzane' ? 'selected' : '' }}>Obejrzane</option>
                    <option value="porzucone" {{ $mojStatus?->status === 'porzucone' ? 'selected' : '' }}>Porzucone</option>
                </select>
                <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold py-2 rounded transition">
                    {{ $mojStatus ? 'Zaktualizuj' : 'Dodaj do listy' }}
                </button>
            </form>
            @if($mojStatus)
            <form method="POST" action="{{ route('lista.destroy', $film) }}" class="mt-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-transparent border border-red-500 text-red-400 hover:bg-red-500 hover:text-white font-semibold py-2 rounded transition text-sm">
                    Usuń z listy
                </button>
            </form>
            @endif
        </div>

        {{-- Ocena --}}
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 mt-4">
            <h3 class="text-gray-300 font-semibold mb-3">⭐ Moja ocena</h3>
            <form method="POST" action="{{ $mojOcena ? route('oceny.update', $film) : route('oceny.store', $film) }}">
                @csrf
                @if($mojOcena)
                    @method('PATCH')
                @endif
                <div class="flex items-center gap-2">
                    <input type="number" name="wartosc" min="1" max="10"
                           value="{{ $mojOcena?->wartosc }}"
                           class="w-20 bg-gray-700 text-gray-100 border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-yellow-400">
                    <span class="text-gray-400 text-sm">/ 10</span>
                    <button type="submit" class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold px-4 py-2 rounded transition text-sm">
                        {{ $mojOcena ? 'Zmień' : 'Oceń' }}
                    </button>
                </div>
            </form>
        </div>
        @endauth

    </div>

    {{-- Prawa kolumna --}}
    <div class="md:col-span-2">

        {{-- Nagłówek --}}
        <div class="mb-6">
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-100">{{ $film->tytul }}</h1>
                    @if($film->tytul_oryginalny && $film->tytul_oryginalny !== $film->tytul)
                        <p class="text-gray-500 italic mt-1">{{ $film->tytul_oryginalny }}</p>
                    @endif
                </div>
                @can('admin')
                <div class="flex gap-2 ml-4">
                    <a href="{{ route('filmy.edit', $film) }}" class="bg-gray-700 hover:bg-gray-600 text-gray-300 px-3 py-1 rounded text-sm transition">
                        ✏ Edytuj
                    </a>
                    <form method="POST" action="{{ route('filmy.destroy', $film) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Na pewno usunąć ten film?')"
                            class="bg-red-900 hover:bg-red-700 text-red-300 px-3 py-1 rounded text-sm transition">
                            🗑 Usuń
                        </button>
                    </form>
                </div>
                @endcan
            </div>

            <div class="flex flex-wrap gap-2 mt-3">
                @foreach($film->gatunki as $gatunek)
                    <span class="bg-yellow-400/10 text-yellow-400 border border-yellow-400/30 px-3 py-1 rounded-full text-sm">
                        {{ $gatunek->nazwa }}
                    </span>
                @endforeach
            </div>
        </div>

        {{-- Szczegóły --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-3 text-center">
                <p class="text-gray-500 text-xs mb-1">Rok</p>
                <p class="text-gray-100 font-semibold">{{ $film->rok_produkcji ?? '—' }}</p>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-3 text-center">
                <p class="text-gray-500 text-xs mb-1">Czas trwania</p>
                <p class="text-gray-100 font-semibold">{{ $film->czas_trwania_min ? $film->czas_trwania_min . ' min' : '—' }}</p>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-3 text-center">
                <p class="text-gray-500 text-xs mb-1">Typ</p>
                <p class="text-gray-100 font-semibold">{{ ucfirst($film->typ) }}</p>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-3 text-center">
                <p class="text-gray-500 text-xs mb-1">Średnia ocena</p>
                <p class="text-yellow-400 font-bold">⭐ {{ $film->srednia_ocena() }}/10</p>
                <p class="text-gray-500 text-xs">({{ $film->oceny->count() }} ocen)</p>
            </div>
        </div>

        {{-- Reżyser --}}
        @if($film->rezyser)
        <div class="mb-4">
            <p class="text-gray-500 text-sm">Reżyser</p>
            <p class="text-gray-100 font-semibold">{{ $film->rezyser }}</p>
        </div>
        @endif

        {{-- Opis --}}
        @if($film->opis)
        <div class="mb-6">
            <h2 class="text-gray-300 font-semibold mb-2">Opis</h2>
            <p class="text-gray-400 leading-relaxed">{{ $film->opis }}</p>
        </div>
        @endif

        {{-- Recenzje --}}
        <div>
            <h2 class="text-xl font-bold text-gray-200 mb-4 border-b border-gray-700 pb-2">
                💬 Recenzje
                <span class="text-gray-500 text-sm font-normal ml-2">({{ $film->recenzje->count() }})</span>
            </h2>

            @auth
            <form method="POST" action="{{ route('recenzje.store', $film) }}" class="mb-6">
                @csrf
                <textarea name="tresc" rows="3" placeholder="Napisz recenzję..."
                    class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-yellow-400 resize-none">{{ old('tresc') }}</textarea>
                @error('tresc')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
                <button type="submit" class="mt-2 bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold px-4 py-2 rounded transition">
                    Dodaj recenzję
                </button>
            </form>
            @endauth

            @forelse($film->recenzje as $recenzja)
                @if(!$recenzja->ukryta || auth()->user()?->rola === 'admin')
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 mb-3 {{ $recenzja->ukryta ? 'opacity-50 border-red-500/30' : '' }}">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-yellow-400 font-semibold text-sm">{{ $recenzja->uzytkownik->name }}</span>
                        <div class="flex items-center gap-2">
                            @if($recenzja->ukryta)
                                <span class="text-red-400 text-xs">🚫 Ukryta</span>
                            @endif
                            <span class="text-gray-500 text-xs">
                                {{ \Carbon\Carbon::parse($recenzja->data_dodania)->format('d.m.Y') }}
                            </span>
                            @if(auth()->id() === $recenzja->uzytkownik_id || auth()->user()?->rola === 'admin')
                            <form method="POST" action="{{ route('recenzje.destroy', $recenzja) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 text-xs transition">Usuń</button>
                            </form>
                            @endif
                        </div>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed">{{ $recenzja->tresc }}</p>
                </div>
                @endif
            @empty
                <p class="text-gray-500 text-sm">Brak recenzji. Bądź pierwszy!</p>
            @endforelse
        </div>

    </div>
</div>

@endsection