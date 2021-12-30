@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Crea bisogno') }}</div>

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

                    <form action="{{ URL::action('BisognoController@store', $id) }}" method="POST" >
                        {{ csrf_field() }}
                        <h1> Inserisci i dati del bisogno </h1>
                        
                        <input type="text" name="nome" placeholder="nome" value="{{ old('nome') }}"/> <label> Nome </label>
                        <br>
                        <br>
                        
                        <input type="number" name="cadenza" placeholder="1" value="{{ old('cadenza') }}" /> <label> Cadenza </label>
                        <br>
                        <br>
                        
                        <input type="submit" class="btn btn-primary" value="Crea bisogno"/>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection