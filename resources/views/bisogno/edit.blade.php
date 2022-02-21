@extends('layouts.app')

@section('content')
<link href="{{ asset('css/style_bisogni.css') }}" rel="stylesheet"> <!-- css per pulsante custom -->
<div style="width: fill; background-color: #2ECC40; margin-bottom: 0rem;">
    <br>
    <div id="cont" class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ URL::action('BisognoController@update', $bisogno->codice_bisogno) }}" method="POST" >
            {{ csrf_field() }}
            @method('PATCH')
            <h1> Modifica i dati del bisogno </h1>

            <input type="hidden" name="codice_pianta" value="{{ $bisogno->codice_pianta }}"/>
            <br>
        </div>
    </div>
    <br>
    <div class="container">
            <h3>Seleziona una tipologia</h3>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-custom-acqua {{ $bisogno->nome == 'acqua' ? '' : 'disabled'}} ">
                    <input type="radio" name="nome" id="s1" autocomplete="off" value="acqua" {{ $bisogno->nome == 'acqua' ? 'checked' : 'disabled'}}> Acqua
                </label>
            </div>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-custom-concime {{ $bisogno->nome == 'concime' ? '' : 'disabled'}}">
                        <input type="radio" name="nome" id="s2" autocomplete="off" value="concime" {{ $bisogno->nome == 'concime' ? 'checked' : 'disabled'}}> Concime
                    </label>
                </div>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-custom-svasatura {{ $bisogno->nome == 'svasatura' ? '' : 'disabled'}}">
                        <input type="radio" name="nome" id="s3" autocomplete="off" value="svasatura" {{ $bisogno->nome == 'svasatura' ? 'checked' : 'disabled'}}> Svasatura
                    </label>
                </div>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-custom-raccolto {{ $bisogno->nome == 'raccolto' ? '' : 'disabled'}}">
                        <input type="radio" name="nome" id="s4" autocomplete="off" value="raccolto" {{ $bisogno->nome == 'raccolto' ? 'checked' : 'disabled'}}> Raccolto
                    </label>
                </div>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-custom-potatura {{ $bisogno->nome == 'potatura' ? '' : 'disabled'}}">
                        <input type="radio" name="nome" id="s5" autocomplete="off" value="potatura" {{ $bisogno->nome == 'potatura' ? 'checked' : 'disabled'}}> Potatura
                    </label>
                </div>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-custom-custom {{ ($bisogno->nome != 'acqua') && ($bisogno->nome != 'concime') && ($bisogno->nome != 'svasatura') && ($bisogno->nome != 'raccolto') && ($bisogno->nome != 'potatura') ? '' : 'disabled'}}" >
                        <input type="radio"  id="s6" autocomplete="off" {{ ($bisogno->nome != 'acqua') && ($bisogno->nome != 'concime') && ($bisogno->nome != 'svasatura') && ($bisogno->nome != 'raccolto') && ($bisogno->nome != 'potatura') ? 'checked' : ''}}> Custom
                    </label>
                </div>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <input type="text" name="custom" value="{{ $bisogno->nome }}" placeholder="Inserisci tipologia qui" id="popup" class="{{ ($bisogno->nome != 'acqua') && ($bisogno->nome != 'concime') && ($bisogno->nome != 'svasatura') && ($bisogno->nome != 'raccolto') && ($bisogno->nome != 'potatura') ? '' : 'hide'}}"
                {{ ($bisogno->nome != 'acqua') && ($bisogno->nome != 'concime') && ($bisogno->nome != 'svasatura') && ($bisogno->nome != 'raccolto') && ($bisogno->nome != 'potatura') ? 'readonly' : ''}} >
            </div>
            <br>
            <br>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Ogni quanti giorni?</span>
                </div>
                <input type="number" name="cadenza" placeholder="" value="{{ ($bisogno->cadenza)/86400}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <br>
            <br>
            <input type="submit" style="background: url({{ asset('immagini/modificaBisogno.png') }});display: block;
            height: 150px;
            width:150px;
            border: none;
            margin-right:auto;
            margin-left:auto;" value=""/>
        </form>
    </div>

<script>
    function clickMe() {
        var text = document.getElementById("popup");
        text.classList.toggle("hide");
        text.classList.toggle("show");
    }
</script>
@endsection

