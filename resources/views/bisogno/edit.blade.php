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
                        
                        <h3>Tipologia</h3>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-custom-acqua {{ $bisogno->nome == 'acqua' ? '' : 'disabled'}} ">
                                <input type="radio" name="nome" id="s1" autocomplete="off" value="acqua" {{ $bisogno->nome == 'acqua' ? 'checked' : 'disabled'}}> Acqua
                            </label>
                            <label class="btn btn-custom-concime {{ $bisogno->nome == 'concime' ? '' : 'disabled'}}">
                                <input type="radio" name="nome" id="s2" autocomplete="off" value="concime" {{ $bisogno->nome == 'concime' ? 'checked' : 'disabled'}}> Concime
                            </label>
                            <label class="btn btn-custom-svasatura {{ $bisogno->nome == 'svasatura' ? '' : 'disabled'}}">
                                <input type="radio" name="nome" id="s3" autocomplete="off" value="svasatura" {{ $bisogno->nome == 'svasatura' ? 'checked' : 'disabled'}}> Svasatura
                            </label>
                            <label class="btn btn-custom-raccolto {{ $bisogno->nome == 'raccolto' ? '' : 'disabled'}}">
                                <input type="radio" name="nome" id="s4" autocomplete="off" value="raccolto" {{ $bisogno->nome == 'raccolto' ? 'checked' : 'disabled'}}> Raccolto
                            </label>
                            <label class="btn btn-custom-potatura {{ $bisogno->nome == 'potatura' ? '' : 'disabled'}}">
                                <input type="radio" name="nome" id="s5" autocomplete="off" value="potatura" {{ $bisogno->nome == 'potatura' ? 'checked' : 'disabled'}}> Potatura
                            </label>
                        </div>
                        
                        <br>
                        <br>
                        <input type="number" name="cadenza" placeholder="" value="{{ ($bisogno->cadenza)/86400}}" /> <label> Ogni quanti giorni? </label>
                        
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