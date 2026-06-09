@extends('layouts.app')

@section('title', 'Lista filmów')

@section('content')

    <h1 class="text-3xl font-bold text-yellow-400 mb-6">🎬 Filmy</h1>

    <form id="filtr-form" method="GET" action="{{ route('filmy.index') }}"
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

    
    <div id="filmy-container"> 
        @include('filmy._lista', ['filmy' => $filmy])
    </div>

    
    <div id="paginacja" class="mt-8 flex justify-center gap-2">
        @if($filmy->lastPage() > 1)
            @for($i = 1; $i <= $filmy->lastPage(); $i++)
                <button
                    data-page="{{ $i }}"
                    class="pagina-btn px-4 py-2 rounded font-semibold transition
                        {{ $filmy->currentPage() === $i
                            ? 'bg-yellow-400 text-gray-900'
                            : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                    {{ $i }}
                </button>
            @endfor
        @endif
    </div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form       = document.getElementById('filtr-form');
    const container  = document.getElementById('filmy-container');
    const paginacja  = document.getElementById('paginacja');

    function pobierzStrone(page) {
        const params = new URLSearchParams(new FormData(form));
        params.set('page', page);

        fetch('{{ route("filmy.index") }}?' + params.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            container.innerHTML = data.html;
            aktualizujPaginacje(data.current_page, data.last_page, params);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    function aktualizujPaginacje(current, last, params) {
        paginacja.innerHTML = '';
        if (last <= 1) return;

        for (let i = 1; i <= last; i++) {
            const btn = document.createElement('button');
            btn.textContent = i;
            btn.dataset.page = i;
            btn.className = 'pagina-btn px-4 py-2 rounded font-semibold transition ' +
                (i === current
                    ? 'bg-yellow-400 text-gray-900'
                    : 'bg-gray-700 text-gray-300 hover:bg-gray-600');
            paginacja.appendChild(btn);
        }
    }

    paginacja.addEventListener('click', function (e) {
        if (e.target.classList.contains('pagina-btn')) {
            pobierzStrone(Number(e.target.dataset.page));
        }
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        pobierzStrone(1);
    });
});
</script>
@endpush