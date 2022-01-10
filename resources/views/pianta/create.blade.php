
@extends('layouts.app')

@section('content')
<div style="width: fill; background-color: #1e90ff; margin-bottom: 0rem;">
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

        <form action="{{ URL::action('PiantaController@store') }}" method="POST" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <h1> Inserisci i dati della pianta </h1>
            <div class="input-group input-group-sm mb-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Nome pianta</span>
                    </div>
                    <input id="namePlant" type="text" name="nome" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{ old('nome') }}">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Dove si trova?</span>
                    </div>
                    <input id="namePlant" type="text" name="luogo" placeholder="Giardino" value="{{ old('luogo') }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
            </div>
            <br>
            <br>
            @include('foto') <!-- Serve per includere il capo foto e la sua preview -->
            <br>
            <br>
            <h10> Usa AI per riconoscere la pianta </h1> <br>

            <img id = "similarIm" src = "" class="imagePreviewPianta">
            <br>


            <button id="cerca" type="button"><img src="{{ asset('immagini/occhio.png') }}" class="card-img-top" /></button><br>

            Visibilità
            <br>
            <input type="radio" name="stato" value="0" /> privata
            <br>
            <input type="radio" name="stato" value="1" /> pubblica
            <br>
            <br>

            <input type="submit" value="Aggiungi pianta" />

            <br>

            <h10 id="description">  </h1> <br>


        </form>
    </div>
</div>

<script src="{{ asset('js/preview.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/AItrovapianta.js') }}"></script>
@endsection
