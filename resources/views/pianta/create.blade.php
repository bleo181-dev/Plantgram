
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Creazione pianta') }}</div>
                <div class="card-body">

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

                        <!--<input type="number" name="codice_serra" placeholder="1111" value="{{ old('codice_serra') }}"/> <label> Codice serra </label>
                        <br>
                        <br>-->

                        <input id="namePlant" type="text" name="nome" placeholder="Basilico" value="{{ old('nome') }}" /> <label> Nome pianta </label>
                        <br>
                        <br>

                        <input type="text" name="luogo" placeholder="Giardino" value="{{ old('luogo') }}"/> <label> Dove si trova </label>
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
        </div>
    </div>
</div>

<script src="{{ asset('js/preview.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/AItrovapianta.js') }}"></script>
@endsection
