@extends('layouts.app')

@section('title', 'Moja lista')

@section('content')

    <h1 class="text-3xl font-bold text-yellow-400 mb-6">📋 Moja lista</h1>

    @php
        $statusy = [
            'chce_obejrzec' => ['label' => 'Chcę obejrzeć', 'kolor' => 'blue'],
            'oglądam'       => ['label' => 'Oglądam', 'kolor' => 'yellow'],
            'obejrzane'     => ['label' => 'Obejrzane', 'kolor' => 'green'],
            'porzucone'     => ['label' => 'Porzucone', 'kolor' => 'red'],
        ];
    @endphp

    @if($lista->isEmpty())
        <div class="text-center py-16">
            <p class="text-gray-500 text-lg mb-4">Twoja lista jest pusta.</p>
            <a href="{{ route('filmy.index') }}"
               class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold px-6 py-2 rounded transition">
                Przeglądaj filmy
            </a>
        </div>
    @else
        @foreach($statusy as $klucz => $info)
            @if(isset($lista[$klucz]) && $lista[$klucz]->count() > 0)
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-200 mb-4 border-b border-gray-700 pb-2">
                        {{ $info['label'] }}
                        <span class="text-gray-500 text-sm font-normal ml-2">({{ $lista[$klucz]->count() }})</span>
                    </h2>

                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @foreach($lista[$klucz] as $wpis)
                            <a href="{{ route('filmy.show', $wpis->film) }}"
                               class="bg-gray-800 border border-gray-700 rounded-lg hover:border-yellow-400/50 transition overflow-hidden group">

                                <div class="h-40 bg-gray-700 overflow-hidden">
                                    @if($wpis->film->plakat_url)
                                        <img src="{{ $wpis->film->plakat_url }}" alt="{{ $wpis->film->tytul }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-500 text-3xl">🎬</div>
                                    @endif
                                </div>

                                <div class="p-2">
                                    <p class="text-gray-100 text-xs font-semibold leading-tight">{{ $wpis->film->tytul }}</p>
                                    <p class="text-gray-500 text-xs mt-1">{{ $wpis->film->rok_produkcji }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    @endif

@endsection