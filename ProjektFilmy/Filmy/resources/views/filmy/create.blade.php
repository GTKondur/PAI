@extends('layouts.app')

@section('title', 'Dodaj film')

@section('content')

<div class="mb-4">
    <a href="{{ route('filmy.index') }}" class="text-yellow-400 hover:text-yellow-300 text-sm transition">
        ← Wróć do listy
    </a>
</div>

<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-yellow-400 mb-6">🎬 Dodaj nowy film</h1>

    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
        <form method="POST" action="{{ route('filmy.store') }}">
            @csrf

           
            <div class="mb-4">
                <label class="block text-gray-300 text-sm mb-1">Tytuł <span class="text-red-400">*</span></label>
                <input type="text" name="tytul" value="{{ old('tytul') }}" required
                    class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-yellow-400">
                @error('tytul')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            
            <div class="mb-4">
                <label class="block text-gray-300 text-sm mb-1">Tytuł oryginalny</label>
                <input type="text" name="tytul_oryginalny" value="{{ old('tytul_oryginalny') }}"
                    class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-yellow-400">
            </div>

        
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-300 text-sm mb-1">Rok produkcji</label>
                    <input type="number" name="rok_produkcji" value="{{ old('rok_produkcji') }}"
                        min="1888" max="2100"
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-yellow-400">
                    @error('rok_produkcji')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-300 text-sm mb-1">Czas trwania (min)</label>
                    <input type="number" name="czas_trwania_min" value="{{ old('czas_trwania_min') }}"
                        min="1"
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-yellow-400">
                </div>
            </div>

            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-300 text-sm mb-1">Reżyser</label>
                    <input type="text" name="rezyser" value="{{ old('rezyser') }}"
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-yellow-400">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm mb-1">Typ <span class="text-red-400">*</span></label>
                    <select name="typ" required
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-yellow-400">
                        <option value="film" {{ old('typ') === 'film' ? 'selected' : '' }}>Film</option>
                        <option value="serial" {{ old('typ') === 'serial' ? 'selected' : '' }}>Serial</option>
                    </select>
                </div>
            </div>

            
            <div class="mb-4">
                <label class="block text-gray-300 text-sm mb-1">URL plakatu</label>
                <input type="url" name="plakat_url" value="{{ old('plakat_url') }}"
                    placeholder="https://..."
                    class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-yellow-400">
                @error('plakat_url')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            
            <div class="mb-4">
                <label class="block text-gray-300 text-sm mb-1">Opis</label>
                <textarea name="opis" rows="4"
                    class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded px-3 py-2 focus:outline-none focus:border-yellow-400 resize-none">{{ old('opis') }}</textarea>
            </div>

            
            <div class="mb-6">
                <label class="block text-gray-300 text-sm mb-2">Gatunki</label>
                <div class="grid grid-cols-3 gap-2">
                    @foreach($gatunki as $gatunek)
                        <label class="flex items-center gap-2 text-gray-300 text-sm cursor-pointer">
                            <input type="checkbox" name="gatunki[]" value="{{ $gatunek->id }}"
                                {{ in_array($gatunek->id, old('gatunki', [])) ? 'checked' : '' }}
                                class="rounded border-gray-600 bg-gray-700 text-yellow-400 focus:ring-yellow-400">
                            {{ $gatunek->nazwa }}
                        </label>
                    @endforeach
                </div>
            </div>

    
            <div class="flex gap-3">
                <button type="submit"
                    class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold px-6 py-2 rounded transition">
                    Dodaj film
                </button>
                <a href="{{ route('filmy.index') }}"
                    class="bg-gray-700 hover:bg-gray-600 text-gray-300 font-semibold px-6 py-2 rounded transition">
                    Anuluj
                </a>
            </div>

        </form>
    </div>
</div>

@endsection