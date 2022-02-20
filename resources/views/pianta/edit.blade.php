
@extends('layouts.app')

@section('content')
<div style="width: fill; background-color: #2ECC40; margin-bottom: 0rem;">
    <br>
    <div id="cont" class="container">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ URL::action('PiantaController@update', $pianta->codice_pianta) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PATCH')
        <h1 style="color: white"> Modifica i dati della pianta </h1>
        <input type="hidden" value="{{ $pianta->codice_serra }}" name="codice_serra" />
        <br>
    </div>
</div>
<br>
<div class="container" style="color: white;">
    <div class="custom-file">
        <input type="file" name="foto" class="custom-file-input" id="imgInp">
        <label class="custom-file-label" for="inputGroupFile01">Modifica una foto</label>
        <br>
        <br>
        @if(Auth::user()->admin == "pro")
            <div style="display: flex; align-items: center;">
                Non sai come si chiama la tua pianta? Carica la sua foto clicca l'icona dell'occhio e ci penso io!
                <button  style="background: none; border: none; margin-left: 10px" id="cerca" type="button"><img style="width: 50px;"src="{{ asset('immagini/find.png') }}"/></button>
            </div>
        @else
            <div style="display: flex; align-items: center;">
                Non sai come si chiama la tua pianta? Passa a pro e ci penso io
                <a style="margin-left: 10px" href="{{ URL::action('UserController@upgrade', Auth::user()->id) }}" class="btn btn-success">Esegui l'upgrade a PRO</a>
            </div>
            <br>
        @endif
    </div>
    <br>
    <br>
    <div class="display: block; margin-left: auto; margin-right: auto;">
        <?php
            echo '<img id="blah" style="display: block; margin-left: auto; margin-right: auto;" class="imagePreviewPianta rounded mx-auto" src="data:image/jpeg;base64,'.base64_encode($pianta->foto).'"/>';
        ?>
    </div>
    <br>
    <br>

            <div class="input-group input-group-sm mb-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Nome pianta</span>
                    </div>
                    <input id="namePlant" type="text" name="nome" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{ $pianta->nome }}">
                </div>
                <br>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default2">Dove si trova?</span>
                    </div>
                    <input id="namePlant" type="text" name="luogo" value="{{ $pianta->luogo }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default2">
                </div>
            </div>


            <!-- pianta simile -->

            <div id="mostraSimile" class="card mb-3" style="width: fill; display: none">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img id = "similarIm" src="{{ asset('immagini/add.png') }}" class="card-img">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 style= "color: rgb(0, 0, 65)" id="titlePrew" class="card-title"> </h5>
                      <p id="description" style= "color: rgb(24, 24, 105)" class="card-text"> </p>
                    </div>
                  </div>
                </div>
              </div>
            <br>



        <!--
            Visibilità
            <br>
            <input type="radio" name="stato" value="0" /> privata
            <br>
            <input type="radio" name="stato" value="1" /> pubblica
            <br>
            <br>
        -->

            <select name="stato" class="custom-select" size="3">
                <option selected>Seleziona la visibilità della pianta</option>
                <option name="stato" value="0">Privata</option>
                <option name="stato" value="1">Pubblica</option>
            </select>

            <br>
            <br>
            <br>
            <input type="submit" class="btn btn-primary" value="Modifica pianta" />

            <!--<input type="submit" style="background: url({{ asset('immagini/addPianta.png') }});display: block;
            height: 150px;
            width:150px;
            border: none;
            margin-right:auto;
            margin-left:auto;" value=""/>-->
        </form>

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
<script src="{{ asset('js/previewEdit.js') }}"></script>
@endsection
