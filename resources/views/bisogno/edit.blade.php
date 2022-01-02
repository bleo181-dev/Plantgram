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
                            <label class="btn active btn-custom-acqua ">
                                <input type="radio" name="nome" id="s1" autocomplete="off" value="acqua" {{ $bisogno->nome == 'acqua' ? 'checked' : ''}}> Acqua
                            </label>
                            <label class="btn active btn-custom-concime">
                                <input type="radio" name="nome" id="s2" autocomplete="off" value="concime" {{ $bisogno->nome == 'concime' ? 'checked' : ''}}> Concime
                            </label>
                            <label class="btn active btn-custom-svasatura">
                                <input type="radio" name="nome" id="s3" autocomplete="off" value="svasatura" {{ $bisogno->nome == 'svasatura' ? 'checked' : ''}}> Svasatura
                            </label>
                            <label class="btn active btn-custom-raccolto">
                                <input type="radio" name="nome" id="s4" autocomplete="off" value="raccolto" {{ $bisogno->nome == 'raccolto' ? 'checked' : ''}}> Raccolto
                            </label>
                            <label class="btn active btn-custom-potatura">
                                <input type="radio" name="nome" id="s5" autocomplete="off" value="potatura" {{ $bisogno->nome == 'potatura' ? 'checked' : ''}}> Potatura
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