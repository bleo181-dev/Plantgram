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
        <form action="{{ URL::action('BisognoController@store', $codice_pianta) }}" method="POST" >
            {{ csrf_field() }}
            <h1> Inserisci i dati del bisogno </h1>

            <input type="hidden" name="codice_pianta" value="{{ $codice_pianta }}"/>
            <br>
        </div>
    </div>
    <br>
    <div class="container">
            <h3>Seleziona una tipologia</h3>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-custom-acqua {{ in_array('acqua', $bisogni) ? 'disabled' : ''}}" >
                    <input type="radio" name="tipologia" id="option1" autocomplete="off" value="acqua"> Acqua
                </label>
            </div>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-custom-concime {{ in_array('concime', $bisogni) ? 'disabled' : ''}}" >
                    <input type="radio" name="tipologia" id="option2" autocomplete="off" value="concime"> Concime
                </label>
            </div>

            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-custom-svasatura {{ in_array('svasatura', $bisogni) ? 'disabled' : ''}}" >
                    <input type="radio" name="tipologia" id="option3" autocomplete="off" value="svasatura"> Svasatura
                </label>
            </div>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-custom-raccolto {{ in_array('raccolto', $bisogni) ? 'disabled' : ''}}" >
                    <input type="radio" name="tipologia" id="option4" autocomplete="off" value="raccolto"> Raccolto
                </label>
            </div>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-custom-potatura {{ in_array('potatura', $bisogni) ? 'disabled' : ''}}" >
                    <input type="radio" name="tipologia" id="option5" autocomplete="off" value="potatura"> Potatura
                </label>
            </div>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-custom-custom" >
                    <input type="radio"  id="option6" autocomplete="off" onclick="clickMe()"> Custom
                </label>
            </div>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <input type="text" name="custom" placeholder="Inserisci tipologia qui" id="popup" class="hide">
            </div>
            <br>
            <br>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Ogni quanti giorni?</span>
                </div>
                <input type="number" name="cadenza" placeholder="" value="{{ old('cadenza') }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <br>
            <br>
            <input type="submit" style="background: url({{ asset('immagini/creaBisogno.png') }});display: block;
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
