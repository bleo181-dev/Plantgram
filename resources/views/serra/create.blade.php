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
                        
                        <input type="number" name="latitudine" placeholder="xx.xxxxxx" value="{{ old('latitudine') }}" /> <label> Latitudine </label>
                        <br>
                        <br>
                        
                        <input type="number" name="longitudine" placeholder="yy.yyyyyy" value="{{ old('longitudine') }}"/> <label> Longitudine </label>
                        <br>
                        <br>

                        <input type="hidden" name="capienza" value="20">
                        
                        <input type="submit" class="btn btn-primary" value="Crea serra"/>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection