
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

                    <form action="{{ URL::action('PiantaController@update', $pianta->codice_pianta) }}" method="POST" >
                        {{ csrf_field() }}
                        @method('PATCH')
                        <h1> Modifica i dati della pianta </h1>

                        <input type="number" name="codice_serra" placeholder="1111" value="{{ $pianta->codice_serra }}"/> <label> Codice serra </label>
                        <br>
                        <br>

                        <input type="text" name="nome" placeholder="Basilico" value="{{ $pianta->nome }}" /> <label> Nome pianta </label>
                        <br>
                        <br>

                        <input type="text" name="luogo" placeholder="Giardino" value="{{ $pianta->luogo }}"/> <label> Dove si trova </label>
                        <br>
                        <br>

                        <input type="file" name="foto" value="{{ $pianta->foto }}"> <label> Carica una foto (non funzionante, placeholder) </label>
                        <br>
                        <br>

                        Visibilità
                        <br>
                        <input id="s1" type="radio" name="stato" value="0" onclick="SetStatus()"/> privata
                        <br>
                        <input id="s2" type="radio" name="stato" value="1" onclick="SetStatus()"/> pubblica
                        <br>
                        <br>
                        <input type="hidden" name="SetStatus" id="status" value="">

                        <input type="submit" value="Modifica pianta" />


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var stato = {{ $pianta->stato }};
    if(stato == 1){
        document.getElementById("s1").checked = false;
        document.getElementById('s2').checked = true;
    }else{
        document.getElementById("s1").checked = true;
        document.getElementById('s2').checked = false;
    }

    SetStatus();

    function SetStatus() {
        if(document.getElementById("s1").checked == true){
            document.getElementById("status").value = 0
        }else{
            document.getElementById("status").value = 1;
        }
    }
</script>
@endsection
