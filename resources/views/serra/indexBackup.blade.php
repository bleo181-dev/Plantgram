@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('la mia serra') }}
                </div>

                    <div class="card-body">
                        <div style="padding: 10px;">
                            <a href="{{ URL::action('PiantaController@create') }}" class="btn btn-success"> Nuova pianta</a>
                        </div>
                        <p>Sono le ore {{date('H:i:s', $forecast_data->dt)}}</p>
                        <p>Ci sono {{$forecast_data->temp}}°C di cui percepiti {{$forecast_data->feels_like}}°C </p>
                        <p>Il sole sorge alle {{date('H:i:s', $forecast_data->sunrise)}}</p>
                        <p>Il sole cala alle {{date('H:i:s', $forecast_data->sunset)}}</p>

                        @foreach($forecast as $f)
                            <p>Stato meteo (in inglese): {{$f->main}}</p>
                            <p>Descrizione meteo (in italiano): {{$f->description}}</p>
                            Icona: <img width=100px src=" http://openweathermap.org/img/wn/{{$f->icon}}.png">
                        @endforeach

                        
                        <div class="row">
                            @foreach($piante as $pianta)
                                @include('piantapost')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
