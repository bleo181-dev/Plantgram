@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Crea ricordo') }}</div>

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

                    <form action="{{ URL::action('DiarioController@store', $id) }}" method="POST" >
                        {{ csrf_field() }}
                        <h1> Inserisci i dati del ricordo </h1>
                        
                        <input type="text" name="testo" placeholder="testo" value="{{ old('testo') }}"/> <label> Descrizione </label>
                        <br>
                        <br>
                        
                        <input type="file" name="foto" placeholder="" value="{{ old('foto') }}" /> <label> foto </label>
                        <br>
                        <br>
                        
                        <input type="submit" class="btn btn-primary" value="Crea ricordo"/>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection