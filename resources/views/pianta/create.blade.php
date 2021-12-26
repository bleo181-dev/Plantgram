
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Creazione pianta') }}</div>

                <div class="card-body">
                    <form action="{{ URL::action('PiantaController@store') }}" method="POST">
                        {{ csrf_field() }}
                        <h1> Inserisci i dati della pianta </h1>
                        <input type="number" name="codice_serra" placeholder="1111" /> Codice serra
                        <br>
                        <br>
                        <input type="text" name="nome" placeholder="Basilico" /> Nome pianta
                        <br>
                        <br>
                        <input type="text" name="luogo" placeholder="Giardino" /> Dove si trova
                        <br>
                        <br>
                        <input type="file" name="foto"> Carica una foto (non funzionante, placeholder)
                        <br>
                        <br>
                        Visibilità
                        <br>
                        <input type="radio" name="stato" value="0" /> privata
                        <br>
                        <input type="radio" name="stato" value="1" /> pubblica
                        <br>
                        <br>
                        <input type="submit" value="Aggiungi pianta" />
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
