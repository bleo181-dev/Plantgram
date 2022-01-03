@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crea un bisogno per {{ $pianta->nome }} </div>

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

                    <form action="{{ URL::action('BisognoController@store', $codice_pianta) }}" method="POST" >
                        {{ csrf_field() }}
                        <h1> Inserisci i dati del bisogno </h1>
                        
                        <input type="hidden" name="codice_pianta" value="{{ $codice_pianta }}"/>
                        <br>

                        <h3>Tipologia</h3>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-custom-acqua {{ in_array('acqua', $bisogni) ? 'disabled' : ''}}" >
                                <input type="radio" name="nome" id="option1" autocomplete="off" value="acqua"> Acqua
                            </label>
                            <label class="btn btn-custom-concime {{ in_array('concime', $bisogni) ? 'disabled' : ''}}" >
                                <input type="radio" name="nome" id="option2" autocomplete="off" value="concime"> Concime
                            </label>
                            <label class="btn btn-custom-svasatura {{ in_array('svasatura', $bisogni) ? 'disabled' : ''}}" >
                                <input type="radio" name="nome" id="option3" autocomplete="off" value="svasatura"> Svasatura
                            </label>
                            <label class="btn btn-custom-raccolto {{ in_array('raccolto', $bisogni) ? 'disabled' : ''}}" >
                                <input type="radio" name="nome" id="option3" autocomplete="off" value="raccolto"> Raccolto
                            </label>
                            <label class="btn btn-custom-potatura {{ in_array('potatura', $bisogni) ? 'disabled' : ''}}" >
                                <input type="radio" name="nome" id="option3" autocomplete="off" value="potatura"> Potatura
                            </label>
                        </div>
                        
                        <br>
                        <br>
                        <input type="number" name="cadenza" placeholder="" value="{{ old('cadenza') }}" /> <label> Ogni quanti giorni? </label>

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
