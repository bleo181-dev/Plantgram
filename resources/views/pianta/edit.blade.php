
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifica pianta') }}</div>

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

                    <form action="{{ URL::action('PiantaController@update', $pianta->Codice_pianta) }}" method="POST" >
                        {{ csrf_field() }}
                        @method('PATCH')
                        <h1> Modifica i dati della pianta </h1>
                        
                        <input type="number" name="codice_serra" placeholder="1111" value="{{ $pianta->Codice_serra }}"/> <label> Codice serra </label>
                        <br>
                        <br>
                        
                        <input type="text" name="nome" placeholder="Basilico" value="{{ $pianta->Nome }}" /> <label> Nome pianta </label>
                        <br>
                        <br>
                        
                        <input type="text" name="luogo" placeholder="Giardino" value="{{ $pianta->Luogo }}"/> <label> Dove si trova </label>
                        <br>
                        <br>

                        <input type="file" name="foto" value="{{ $pianta->Foto }}"> <label> Carica una foto (non funzionante, placeholder) </label>
                        <br>
                        <br>

                        Visibilità
                        <br>
                        <input type="radio" name="stato" value="1"
                            @if($pianta->Stato == 1){
                                checked
                            }
                            @endif
                        /> privata
                        <br>
                        <input type="radio" name="stato" value="1" /> pubblica
                        <br>
                        <br>
                        
                        document.getElementById("stato").checked = true;

                        

                        <input type="submit" value="Modifica pianta" />
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
