<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'MovieTracker') }} - @yield('title', 'Strona główna')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen">

    {{-- Nawigacja --}}
    <nav class="bg-gray-900 border-b border-yellow-500/30 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">

            <a href="{{ route('home') }}" class="text-2xl font-bold text-yellow-400 tracking-wide">
                🎬 MovieTracker
            </a>

            <div class="flex items-center gap-6">
                <a style="padding: 0 0.3rem;" href="{{ route('filmy.index') }}" class="text-gray-300 hover:text-yellow-400 transition font-medium">Filmy  |</a>

                @auth
                    <a style="padding: 0 0.3rem;" href="{{ route('lista.index') }}" class="text-gray-300 hover:text-yellow-400 transition font-medium">Moja lista | </a>
                    <a style="padding: 0 0.3rem;" href="{{ route('filmy.create') }}" class="text-gray-300 hover:text-yellow-400 transition font-medium">Dodaj film</a>

                    @can('admin')
                        <a href="{{ route('admin.index') }}" class="text-red-400 hover:text-red-300 transition font-medium">⚙ Admin</a>
                    @endcan

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-yellow-400 transition text-sm">
                            Wyloguj ({{ Auth::user()->name }})
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-yellow-400 transition font-medium">Logowanie</a>
                @endauth
            </div>

        </div>
    </nav>

    {{-- Komunikaty --}}
    <div class="max-w-7xl mx-auto px-4 mt-4">
        @if(session('sukces'))
            <div class="bg-green-900/50 border border-green-500 text-green-300 px-4 py-3 rounded mb-4">
                ✅ {{ session('sukces') }}
            </div>
        @endif
        @if(session('blad'))
            <div class="bg-red-900/50 border border-red-500 text-red-300 px-4 py-3 rounded mb-4">
                ❌ {{ session('blad') }}
            </div>
        @endif
    </div>

    {{-- Treść --}}
    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <footer class="bg-gray-900 border-t border-yellow-500/20 text-gray-500 text-center py-4 mt-12">
        <p style= "text-align: center;">© {{ date('Y') }} MovieTracker — Konrad Kucharski</p>
    </footer>

</body>
</html>