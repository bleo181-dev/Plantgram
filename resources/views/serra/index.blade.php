@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid" style="background-color: #1e90ff; margin-bottom: 0rem;">

    <div class="container">
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
  </div>
<div class="container">




                    <div class="card-body">
                        <div style="padding: 10px;">
                            <a href="{{ URL::action('PiantaController@create') }}" class="btn btn-success"> Nuova pianta</a>
                        </div>

                        <div class="row row-cols-1 row-cols-md-3">
                            @foreach($piante as $pianta)
                                @include('piantapost')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
