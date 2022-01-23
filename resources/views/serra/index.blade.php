@extends('layouts.app')

@section('content')
<div style="width: fill; background-color: #1e90ff; margin-bottom: 1rem;">

    <div class="container">
        <br>
        <h1 style="color: white" class="display-4">
            {{$nome_serra}}
        </h1>

        

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

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation" style="display: block; margin-left: auto; margin-right: auto;">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                @if(auth()->id() == $serra->codice_utente)
                    Il mio green-space
                @else
                    La serra con cui collabori
                @endif
            
            </a>
            </li>
            @if(auth()->id() == $serra->codice_utente)
                <li class="nav-item" role="presentation" style="display: block; margin-left: auto; margin-right: auto;">
                    <a class="nav-link" id="pills-serra-share" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Serre condivise</a>
                </li>

                <li class="nav-item" role="presentation" style="display: block; margin-left: auto; margin-right: auto;">
                    <a class="nav-link" id="pills-home-piante" data-toggle="pill" href="#pills-home-p" role="tab" aria-controls="pills-home-p" aria-selected="false">Home</a>
                </li>
            @endif
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"> 
                <br>
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
            <div class="tab-pane fade" id="pills-home-p" role="tabpanel" aria-labelledby="pills-home-piante">
                
                <h1 style="color: white">Tutte le piante condivise</h1>

            </div>
            @if(auth()->id() == $serra->codice_utente)
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-serra-share">

                    @if(auth()->id() == $serra->codice_utente)

                        <!-- <a href="{{ URL::action('CollaboraController@index') }}" class="btn btn-info" > Mostra serre a cui stai collaborando </a> -->
                        <a href="{{ URL::action('SerraController@collab') }}" class="btn btn-info" > Aggiungi collaboratore a questa serra </a>
                        <p style="color: white">Numero collaboratori attuali: {{$num_collaborazioni}}</p>
                        @foreach($collaboratori as $c)
                            <p>Nickname:{{$c}}</p>
                        @endforeach

                        <br>

                        @foreach($serre_condivise as $s)
                            <a class="btn btn-secondary btn-lg btn-block" type="button" href="{{URL::action('SerraController@indexserrashare', $s->codice_serra)  }}">{{$s->nome}}</a>
                        @endforeach
                        
                    @endif


                </div>
            @endif

        </div>

    </div>
</div>
@endsection
