
@if($filmy->isEmpty())
    <p class="text-gray-500 text-center py-12">Nie znaleziono filmów.</p>
@else
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($filmy as $film)
            <a href="{{ route('filmy.show', $film) }}"
               class="bg-gray-800 border border-gray-700 rounded-lg hover:border-yellow-400/50 hover:shadow-lg hover:shadow-yellow-400/10 transition overflow-hidden group">

                <div class="h-64 bg-gray-700 overflow-hidden">
                    @if($film->plakat_url)
                        <img src="{{ $film->plakat_url }}" alt="{{ $film->tytul }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-500 text-5xl">🎬</div>
                    @endif
                </div>

                <div class="p-3">
                    <h3 class="font-semibold text-gray-100 text-sm leading-tight">{{ $film->tytul }}</h3>
                    <p class="text-gray-500 text-xs mt-1">{{ $film->rok_produkcji }} • {{ ucfirst($film->typ) }}</p>

                    <div class="flex flex-wrap gap-1 mt-2">
                        @foreach($film->gatunki->take(2) as $gatunek)
                            <span class="bg-yellow-400/10 text-yellow-400 border border-yellow-400/30 text-xs px-2 py-0.5 rounded-full">
                                {{ $gatunek->nazwa }}
                            </span>
                        @endforeach
                    </div>

                    <p class="text-yellow-400 font-bold text-sm mt-2">
                        ⭐ {{ $film->srednia_ocena() }}/10
                        <span class="text-gray-500 font-normal">({{ $film->oceny->count() }})</span>
                    </p>
                </div>
            </a>
        @endforeach
    </div>
@endif