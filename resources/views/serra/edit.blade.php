@extends('layouts.app')

@section('content')

<form action="{{ URL::action('SerraController@update', $serra->codice_serra) }}" method="POST" >
    {{ csrf_field() }}
        @method('PUT')

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



            <h1> Come vuoi chiamare la tua serra? </h1>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Nome</span>
                </div>
                <input type="text" name="nome" value="{{$serra->nome}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>


            <input type="hidden" id="lat" name="latitudine" placeholder="xx.xxxxxx" value="{{ $serra->latitudine}}" />


            <input type="hidden" id="lng" name="longitudine" placeholder="yy.yyyyyy" value="{{ $serra->longitudine }}"/>


            <input type="hidden" name="capienza" value="20">
            <p id="lbl"> Per modificare il tuo green-space indica la sua posizione nella mappa</p>
            <div id="pos">
            </div>
            <br>

            <button id="invio" type="submit" class="btn btn-success btn-lg " style="width:80%; font-size:40px; display: block;
            border: none;
            margin-right:auto;
            margin-left:auto;"> Modifica la tua serra </button>
            <br>

            @csrf
        </div>
    </div>

            <div id="map" style="height:400px; width: fill;" ></div>


            </div>
</form>

<script src="{{ asset('js/posizioneEdit.js') }}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG8E5nHu7nZYmu5B0ONoerF4U5TZ2y2ao&callback=initMap" type="text/javascript"></script>



@endsection
