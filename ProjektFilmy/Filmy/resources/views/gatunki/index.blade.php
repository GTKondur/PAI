@extends('layouts.app')

@section('title', 'Zarządzanie gatunkami')

@section('content')

<div class="mb-4">
    <a href="{{ route('filmy.index') }}" class="text-yellow-400 hover:text-yellow-300 text-sm transition">
        ← Wróć do filmów
    </a>
</div>

<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-yellow-400 mb-6">🎭 Zarządzanie gatunkami</h1>

    {{-- Komunikaty --}}
    @if(session('sukces'))
        <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-4 py-3 rounded mb-4">
            ✅ {{ session('sukces') }}
        </div>
    @endif
    @if(session('blad'))
        <div class="bg-red-500/20 border border-red-500/50 text-red-400 px-4 py-3 rounded mb-4">
            ❌ {{ session('blad') }}
        </div>
    @endif

    {{-- Formularz dodawania --}}
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-5 mb-6">
        <h2 class="text-lg font-semibold text-gray-200 mb-4">Dodaj nowy gatunek</h2>
        <form method="POST" action="{{ route('gatunki.store') }}" class="flex gap-3">
            @csrf
            <input type="text" name="nazwa" value="{{ old('nazwa') }}"
                placeholder="Nazwa gatunku..."
                class="flex-1 bg-gray-700 text-gray-100 border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-yellow-400">
            <button type="submit"
                class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold px-4 py-2 rounded transition">
                Dodaj
            </button>
        </form>
        @error('nazwa')
            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    {{-- Lista gatunków --}}
    <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-700 text-gray-400">
                <tr>
                    <th class="text-left px-4 py-3">Gatunek</th>
                    <th class="text-center px-4 py-3">Liczba filmów</th>
                    <th class="text-center px-4 py-3">Akcja</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($gatunki as $gatunek)
                    <tr class="text-gray-300 hover:bg-gray-700/50 transition">
                        <td class="px-4 py-3 font-semibold text-gray-100">{{ $gatunek->nazwa }}</td>
                        <td class="text-center px-4 py-3">
                            <span class="bg-yellow-400/10 text-yellow-400 border border-yellow-400/30 text-xs px-2 py-1 rounded-full">
                                {{ $gatunek->filmy_count }}
                            </span>
                        </td>
                        <td class="text-center px-4 py-3">
                            @if($gatunek->filmy_count === 0)
                                <form method="POST" action="{{ route('gatunki.destroy', $gatunek) }}"
                                      onsubmit="return confirm('Na pewno usunąć gatunek {{ addslashes($gatunek->nazwa) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-xs px-3 py-1 rounded font-semibold transition bg-red-900/40 text-red-400 hover:bg-red-900/70 border border-red-500/30">
                                        🗑 Usuń
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-600 text-xs">w użyciu</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-gray-500 py-8">Brak gatunków.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection