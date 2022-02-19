@extends('layouts.app')

@section('content')
<div style="width: fill; background-color: #1e90ff; margin-bottom: 0rem;">
    <br>
    <div id="cont" class="container">
        <h1>Diario di {{ $pianta->nome }}</div>
        <br>
        <hr>
    </div>
    <div class="row justify-content-center">
        @foreach($diario as $i)
            @include('diario.diariopost')
        @endforeach
    </div>
    </div>
    <div class="row justify-content-center">
        <div class="jumbotron jumbotron-fluid col-md-8">
            <div class="container">
                <div style="display: flex; justify-content: center; align-items: center;">
                    <a href="{{ URL::action('DiarioController@create', $id) }}" > <img src="{{ asset('immagini/addSerra.png') }}" style="height: 80px; width:80px;" /></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection