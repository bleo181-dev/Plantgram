@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifica serra') }}</div>

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

                    <form action="{{ URL::action('SerraController@update', $serra->codice_serra)}}" method="POST" >
                        {{ csrf_field() }}
                        @method('PATCH')
                        <h1> Modifica i dati della serra </h1>

                        <input type="text" name="nome" placeholder="serraname" value="{{ $serra->nome }}"/> <label> Nome serra </label>
                        <br>
                        <br>

                        <input type="hidden" name="latitudine" placeholder="latitudine" value="{{ $serra->latitudine }}" /> <label> Latitudine serra </label>
                        <br>
                        <br>

                        <input type="hidden" name="longitudine" placeholder="longitudine" value="{{ $serra->longitudine }}" /> <label> Longitudine serra </label>
                        <br>
                        <br>

                        <input type="hidden" name="capienza" value="20">

                        <script src="{{ asset('js/posizione.js') }}"></script>
                            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG8E5nHu7nZYmu5B0ONoerF4U5TZ2y2ao&callback=initMap"
                                    type="text/javascript"></script>

                        <input type="submit" class="btn btn-primary" value="Modifica serra"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
