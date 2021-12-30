@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifica bisogno') }}</div>

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

                    <form action="{{ URL::action('BisognoController@update', $bisogno->codice_bisogno) }}" method="POST" >
                        {{ csrf_field() }}
                        @method('PATCH')
                        <h1> Modifica i dati del bisogno </h1>
                        
                        <input type="hidden" name="codice_pianta" value="{{ $bisogno->codice_pianta }}"/>
                        <br>
                        <br>

                        <input type="text" name="nome" placeholder="nome" value="{{ $bisogno->nome }}"/> <label> Nome </label>
                        <br>
                        <br>
                        
                        <input type="number" name="cadenza" placeholder="111" value="{{ $bisogno->cadenza }}" /> <label> Cadenza </label>
                        <br>
                        <br>
                        
                        <input type="submit" class="btn btn-primary" value="Modifica bisogno"/>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection