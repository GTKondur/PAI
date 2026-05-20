@extends('layouts.app')

@section('title', 'Lista filmów')

@section('content')

    <h1 class="text-3xl font-bold text-yellow-400 mb-6">🎬 Filmy</h1>

    {{-- Filtry --}}
    <form method="GET" action="{{ route('filmy.index') }}"
          class="bg-gray-800 border border-gray-700 rounded-lg p-4 mb-6 flex flex-wrap gap-3 items-end">
        <div>
            <label class="block text-gray-400 text-sm mb-1">Szukaj</label>
            <input type="text" name="szukaj" value="{{ request('szukaj') }}"
                placeholder="Tytuł lub reżyser..."
                class="bg-gray-700 text-gray-100 border border-gray-600 rounded px-3 py-2 text-sm w-56 focus:outline-none focus:border-yellow-400">
        </div>
        <div>
            <label class="block text-gray-400 text-sm mb-1">Gatunek</label>
            <select name="gatunek" class="bg-gray-700 text-gray-100 border border-gray-600 rounded px-3 py-2 text-sm focus:outline-none focus:border-yellow-400">
                <option value="">Wszystkie</option>
                @foreach($gatunki as $gatunek)
                    <option value="{{ $gatunek->id }}" {{ request('gatunek') == $gatunek->id ? 'selected' : '' }}>
                        {{ $gatunek->nazwa }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-gray-400 text-sm mb-1">Typ</label>
            <select name="typ" class="bg-gray-700 text-gray-100 border border-gray-600 rounded px-3 py-2 text-sm focus:outline-none focus:border-yellow-400">
                <option value="">Wszystkie</option>
                <option value="film" {{ request('typ') === 'film' ? 'selected' : '' }}>Film</option>
                <option value="serial" {{ request('typ') === 'serial' ? 'selected' : '' }}>Serial</option>
            </select>
        </div>
        <button type="submit"
            class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-semibold px-4 py-2 rounded transition">
            Szukaj
        </button>
        <a href="{{ route('filmy.index') }}"
            class="text-gray-400 hover:text-gray-200 text-sm py-2 transition">
            Resetuj
        </a>
    </form>

    {{-- Siatka filmów --}}
    @if($filmy->isEmpty())
        <p class="text-gray-500 text-center py-12">Nie znaleziono filmów.</p>
    @else
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($filmy as $film)
                <a href="{{ route('filmy.show', $film) }}"
                   class="bg-gray-800 border border-gray-700 rounded-lg hover:border-yellow-400/50 hover:shadow-lg hover:shadow-yellow-400/10 transition overflow-hidden group">

                    {{-- Plakat --}}
                    <div class="h-64 bg-gray-700 overflow-hidden">
                        @if($film->plakat_url)
                            <img src="{{ $film->plakat_url }}" alt="{{ $film->tytul }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-500 text-5xl">🎬</div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="p-3">
                        <h3 class="font-semibold text-gray-100 text-sm leading-tight">{{ $film->tytul }}</h3>
                        <p class="text-gray-500 text-xs mt-1">{{ $film->rok_produkcji }} • {{ ucfirst($film->typ) }}</p>

                        {{-- Gatunki --}}
                        <div class="flex flex-wrap gap-1 mt-2">
                            @foreach($film->gatunki->take(2) as $gatunek)
                                <span class="bg-yellow-400/10 text-yellow-400 border border-yellow-400/30 text-xs px-2 py-0.5 rounded-full">
                                    {{ $gatunek->nazwa }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Ocena --}}
                        <p class="text-yellow-400 font-bold text-sm mt-2">
                            ⭐ {{ $film->srednia_ocena() }}/10
                            <span class="text-gray-500 font-normal">({{ $film->oceny->count() }})</span>
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Paginacja --}}
        <div class="mt-8">
            {{ $filmy->withQueryString()->links() }}
        </div>
    @endif

@endsection