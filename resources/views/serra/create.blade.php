@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Creazione serra') }}</div>

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

                    <form action="{{ URL::action('SerraController@store') }}" method="POST" >
                        {{ csrf_field() }}
                        <h1> Inserisci i dati della serra </h1>

                        <input type="text" name="nome" placeholder="disneyland" value="{{ old('codice_serra') }}"/> <label> Nome </label>
                        <br>
                        <br>

                        <input type="hidden" id="lat" name="latitudine" placeholder="xx.xxxxxx" value="{{ old('latitudine') }}" />
                        <br>
                        <br>

                        <input type="hidden" id="lng" name="longitudine" placeholder="yy.yyyyyy" value="{{ old('longitudine') }}"/>
                        <br>
                        <br>

                        <input type="hidden" name="capienza" value="20">

                        @csrf
                        <div>


                            <div id="map" style="height:300px; width: 600px;" class="my-3"></div>

                            <script src="{{ asset('js/posizione.js') }}"></script>
                            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG8E5nHu7nZYmu5B0ONoerF4U5TZ2y2ao&callback=initMap"
                                    type="text/javascript"></script>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Crea serra"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
