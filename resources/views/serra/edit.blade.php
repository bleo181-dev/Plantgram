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
                        
                        <input type="number" name="latitudine" placeholder="latitudine" value="{{ $serra->latitudine }}" /> <label> Latitudine serra </label>
                        <br>
                        <br>
                        
                        <input type="number" name="longitudine" placeholder="longitudine" value="{{ $serra->longitudine }}" /> <label> Longitudine serra </label>
                        <br>
                        <br>

                        <input type="hidden" name="capienza" value="20">
                        
                        <input type="submit" class="btn btn-primary" value="Modifica serra"/>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection