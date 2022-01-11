@extends('layouts.app')

@section('content')
<div style="width: fill; background-color: #1e90ff; margin-bottom: 1rem;">

    <div class="container">
        <br>
        <h1 style="color: white" class="display-4">
            {{$nome_serra}}
        </h1>

        @if(auth()->id() == $serra->codice_utente)
            <!--bottone dropdown-->
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Serre condivise
            </button>
            <!--dropdown menu-->
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                @foreach($serre_condivise as $s)
                    <a class="dropdown-item" type="button" href="{{URL::action('SerraController@indexserrashare', $s->codice_serra)  }}">{{$s->nome}}</a>
                @endforeach
            </div>

        
            <a href="{{ URL::action('CollaboraController@index') }}" class="btn btn-info" > Mostra serre a cui stai collaborando </a>
            <a href="{{ URL::action('SerraController@collab') }}" class="btn btn-info" > Aggiungi collaboratore a questa serra </a>
            <p>Numero collaboratori attuali: {{$num_collaborazioni}}</p>
            @foreach($collaboratori as $c)
                <p>Nickname:{{$c}}</p>
            @endforeach
        @endif

        <p class="lead text-right" style="color: white" >
            @foreach($forecast as $f)
                <img width=50px src=" http://openweathermap.org/img/wn/{{$f->icon}}.png">
            @endforeach
            <br>

            Benvenuto, {{$nickname_utente}} <br>
            Oggi abbiamo
            @foreach($forecast as $f)
                {{$f->description}}
            @endforeach
            e ci sono {{$forecast_data->temp}}°C di cui percepiti {{$forecast_data->feels_like}}°C
            @if ($forecast_data->temp < 2)
                <p class="lead text-right" style="color:burlywood" >
                    Le tue piante potrebbero avere freddo se sono fuori, rientrale!
                </p>
            @endif
        </p>
    </div>
    <br>
</div>
<div class="container">
    <div class="card-body">
        <div class="row row-cols-1 row-cols-md-4">
            @foreach($piante as $pianta)
                @include('piantapost')
            @endforeach
            @if(auth()->id() == $serra->codice_utente)
                <div class="col mb-4">
                    <div class="col mb-4">
                        <div class="card">
                            <a href="{{ URL::action('PiantaController@create') }}" class="btn btn-success"> <img src="{{ asset('immagini/add.png') }}" class="card-img-top" /></a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
