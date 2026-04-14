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
                    <input id="id_kwota" type="text" name="kwota" value="{{ $kwota ?? '' }}">

                    <label for="id_lata">Lata:</label>
                    <input id="id_lata" type="text" name="lata" value="{{ $lata ?? '' }}">

                    <label for="id_oprocentowanie">Oprocentowanie (%):</label>
                    <input id="id_oprocentowanie" type="text" name="oprocentowanie" value="{{ $oprocentowanie ?? '' }}">

                    <br>
                    <button type="submit">Oblicz ratę</button>
                </fieldset>
            </form>
        </div>

        <div style="margin-top: 2em;">
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