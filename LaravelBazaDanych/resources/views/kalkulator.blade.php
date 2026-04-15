<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Kredytowy</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">
    
    <noscript>
        <link rel="stylesheet" href="{{ asset('assets/css/noscript.css') }}">
    </noscript>
</head>
<body>
    @auth
    <div style="background: black; padding: 10px; border-bottom: 1px solid #ccc; text-align: right;">
        Zalogowany jako: <strong>{{ Auth::user()->name }}</strong> (Rola: {{ Auth::user()->role }}) | 
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" style="background:none; border:none; color:blue; cursor:pointer; text-decoration:underline;">Wyloguj się</button>
        </form>
    </div>
@endauth

<header style="text-align: center; margin: 1em; border: 1px solid #ccc; padding: 1em;">
    <h1>Kalkulator kredytowy</h1>
</header>

<div style="margin: 1em; padding: 1em;">
    <h2 class="content-head is-center">Kalkulator kredytowy</h2>

    <div>
        <div>
            <form action="{{ url('/kalkulator') }}" method="post">
                @csrf <fieldset>
                    <label for="id_kwota">Kwota:</label>
                    <input id="id_kwota" type="text" name="kwota" value="{{ old('kwota', $kwota ?? '') }}">

                    <label for="id_lata">Lata:</label>
                    <input id="id_lata" type="text" name="lata" value="{{ old('lata', $lata ?? '') }}">

                    <label for="id_oprocentowanie">Oprocentowanie (%):</label>
                   <input id="id_oprocentowanie" type="text" name="oprocentowanie" value="{{ old('oprocentowanie', $oprocentowanie ?? '') }}">

                    <br>
                    <button type="submit">Oblicz ratę</button>
                </fieldset>
            </form>
        </div>

        <div style="margin-top: 2em;">

    @if(session('messages'))
        <div style="color: white; background-color: #d9534f; border: 1px solid red; padding: 10px; border-radius: 5px;">
            <ol>
                @foreach(session('messages') as $msg)
                    <li>{{ $msg }}</li>
                @endforeach
            </ol>
        </div>
    @endif

    @if(isset($messages) && count($messages) > 0)
        <div style="color: red; border: 1px solid red; padding: 10px;">
            <ol>
                @foreach($messages as $msg)
                    <li>{{ $msg }}</li>
                @endforeach
            </ol>
        </div>
    @endif

            @if(isset($result))
                <div style="color: green; border: 1px solid green; padding: 10px; margin-top: 10px;">
                    <h4>Miesięczna rata:</h4>
                    <p><strong>{{ $result }} PLN</strong></p>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="footer" style="text-align:center; margin-top:3em; border: 1px solid #ccc; padding: 1em;">
    <p>Autor: Konrad Kucharski</p>
</div>

</body>
</html>