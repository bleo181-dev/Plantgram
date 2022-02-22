@extends('layouts.app')

@section('content')

<div style="width: fill; background-color: #2ECC40; margin-bottom: 1rem;">
    <div class="container">
    <br>
        <div class="row" style="display:in-line; align-items: center;">
            <h1 style="color: white;  vertical-align: middle;" class="display-4">
                {{$nome_serra}}
            </h1>
            <a href="{{ URL::action('SerraController@edit', $serra->codice_serra) }}" style="margin-left: 20px"> <img src="{{ asset('immagini/modifica.png') }}"></a>
        </div>
        <div>
            <p class="lead text-right" style="color: white">
                @foreach($forecast as $f)
                    <img width=50px src=" http://openweathermap.org/img/wn/{{$f->icon}}.png">
                @endforeach
                <br>

                Benvenuto, {{$nickname_utente}} <br>
                Oggi abbiamo
                @foreach($forecast as $f)
                    {{$f->description}}
                @endforeach
                e ci sono {{$forecast_data->temp}}°C <!--di cui percepiti {{$forecast_data->feels_like}}°C-->
                @if ($forecast_data->temp < 2)
                    <p class="lead text-right" style="color:yellow" >
                        Le tue piante potrebbero avere freddo se sono fuori, se necessario mettile al sicuro!
                    </p>
                @endif
        </div>

        <div class="display-4 lead text-right">
            @if(auth()->id() == $serra->id)
                <!-- Aggiungi collaboratore -->
                <a href="{{ URL::action('SerraController@collab') }}" > <img src="{{ asset('immagini/share.png') }}"> </a>

                <!-- collaboratori -->
                <div class="btn-group">
                    <button name="num_collab" type="button" class="btn btn-primary" style="pointer-events: none;">
                        Collaboratori <span id="num_collab" class="badge badge-light"><!-- num collaboratori tramite ajax --></span>
                    </button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div id="collab" class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                        <!-- <a class="dropdown-item" href="#">Action</a> -->
                        <!-- qui verranno aggiunti i collaboratori tramite ajax -->
                    </div>
                </div>
                <!-- _________________ -->
            @endif
        </div>
        </p>
    </div>
    <br>
</div>
<div class="container">
    <div class="card-body">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation" style="display: block; margin-left: auto; margin-right: auto;">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                @if(auth()->id() == $serra->id)
                    Il mio green-space
                @else
                    La serra con cui collabori
                @endif
                </a>
            </li>
            @if(auth()->id() == $serra->id)
                <li class="nav-item" role="presentation" style="display: block; margin-left: auto; margin-right: auto;">
                    <a class="nav-link" id="pills-serra-share" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Serre condivise</a>
                </li>

                <!--<li class="nav-item" role="presentation" style="display: block; margin-left: auto; margin-right: auto;">
                    <a class="nav-link" id="pills-home-piante" data-toggle="pill" href="#pills-home-p" role="tab" aria-controls="pills-home-p" aria-selected="false">Home</a>
                </li>-->

                <li class="nav-item" role="presentation" style="display: block; margin-left: auto; margin-right: auto;">
                    <a class="nav-link" id="pills-pubblicita-piante" data-toggle="pill" href="#pills-pubblicita-p" role="tab" aria-controls="pills-pubblicita-p" aria-selected="false">Prodotti</a>
                </li>
            @endif
        </ul>
        <hr style="background-color: white">
        <br>

        <!-- div opzioni la mia serra, serre condivise ecc ... -->

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                <!-- _________________________________ -->
                @if(auth()->id() == $serra->id)
                    <p class="lead text-left" style="color: white">Numero piante: {{$num_piante}} su {{$serra->capienza}}</p>
                @endif

                <!-- pianta post -->
                <div class="row row-cols-1 row-cols-md-3">
                    @foreach($piante as $pianta)
                        @include('piantapost')
                    @endforeach
                    @if(auth()->id() == $serra->id)
                        <div class="col mb-4">
                            <div class="col mb-4">
                                <div class="card">
                                    @if($num_piante < $serra->capienza )
                                        <a href="{{ URL::action('PiantaController@create') }}" class="btn btn-success"> <img src="{{ asset('immagini/add.png') }}" class="card-img-top" /></a>
                                    @else
                                        @if($utente->admin == "nopro")
                                            <a href="{{ URL::action('UserController@upgrade', $utente->id) }}" class="btn btn-success"><button class="btn btn-success">Esegui l'upgrade a PRO per avere accesso a piante illimitate</button></a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- __________________________________________ -->

            </div>

            <!--<div class="tab-pane fade" id="pills-home-p" role="tabpanel" aria-labelledby="pills-home-piante">

                <h1 style="color: white">Tutte le piante condivise</h1>

            </div>-->

            <!--visualizza pubblicita -->
            <div class="tab-pane fade" id="pills-pubblicita-p" role="tabpanel" aria-labelledby="pills-pubblicita-piante">
                <div class="row row-cols-1 row-cols-md-3">
                    @foreach($pubblicita as $pub)
                        @include('pubblicita.pubblicitapost')
                    @endforeach
                </div>
            </div>

            @if(auth()->id() == $serra->id)
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-serra-share">

                    <!-- serre condivise con ajax -->


                </div>
            @endif
        </div>

        <input type="hidden" name="_token" id="_token" value="{{ csrf_token()}}">
    </div>
</div>

<!-- Modal -->
<div id="modal">

</div>
<!-- Modal2 -->
<div id="modal2">

</div>
<!--endmodal-->

@if(auth()->id() == $serra->id)
    @include('ajax_serra_index')
@endif
@endsection
