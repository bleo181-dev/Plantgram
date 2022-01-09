@extends('layouts.app')

@section('content')

<form action="{{ URL::action('SerraController@store') }}" method="POST" >

    <div class="jumbotron jumbotron-fluid" style="height: 385px; background-color: #1e90ff; margin-bottom: 0rem;">

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


            {{ csrf_field() }}
            <h1> Come vuoi chiamare il tuo green-space? </h1>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Nome</span>
                </div>
                <input type="text" name="nome" value="{{ old('codice_serra') }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
              </div>


            <input type="hidden" id="lat" name="latitudine" placeholder="xx.xxxxxx" value="{{ old('latitudine') }}" />


            <input type="hidden" id="lng" name="longitudine" placeholder="yy.yyyyyy" value="{{ old('longitudine') }}"/>


            <input type="hidden" name="capienza" value="20">
            <p id="lbl"> Per creare il tuo green-space indica la sua posizione nella mappa o clicca su [trova la tua posizione]</p>
            <div id="pos">
            </div>
            <br>

            <input id="invio" type="submit" style="background: url(/immagini/addSerra.png);display: block;
            height: 80px;
            width:80px;
            border: none;
            margin-right:auto;
            margin-left:auto;" value=""/>

            @csrf
        </div>
    </div>


    <div id="map" style="height:400px; width: fill;" ></div>

        <script src="{{ asset('js/posizione.js') }}"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG8E5nHu7nZYmu5B0ONoerF4U5TZ2y2ao&callback=initMap" type="text/javascript"></script>
    </div>


</form>

@endsection
