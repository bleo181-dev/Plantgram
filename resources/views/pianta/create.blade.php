
@extends('layouts.app')

@section('content')
<div style="width: fill; background-color: #1e90ff; margin-bottom: 0rem;">
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

        <form action="{{ URL::action('PiantaController@store') }}" method="POST" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <h1> Crea una nuova pianta </h1>
            <br>
            <br>
            <input type="submit" style="background: url({{ asset('immagini/addSerra.png') }});display: block;
            height: 80px;
            width:80px;
            border: none;
            margin-right:auto;
            margin-left:auto;" value=""/>
            <br>
        </div>
    </div>

    <br>
    <br>

    <div class="container">

            <div class="input-group input-group-sm mb-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Nome pianta</span>
                    </div>
                    <input id="namePlant" type="text" name="nome" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{ old('nome') }}">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default2">Dove si trova?</span>
                    </div>
                    <input id="namePlant" type="text" name="luogo" value="{{ old('luogo') }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default2">
                </div>
            </div>
            <h10 style="color: white">
                Non sai come si chiama la tua pianta? Carica la sua foto clicca sull&#8217occhio e ci penso io!
            </h1>
            <br>

            <div class="custom-file">
                <input type="file" name="foto" class="custom-file-input" id="imgInp">
                <label class="custom-file-label" for="inputGroupFile01">Carica una foto</label>


                <button  style="background: none; border: none;
                display: block;
                height: 80px;
                width:80px;
                border: none;
                margin-right:auto;
                margin-left:auto;" id="cerca" type="button"><img style="width: 50px;"src="{{ asset('immagini/find.png') }}"/></button>


            </div>
            <br>
            <br>
            <img class="imagePreviewPianta rounded mx-auto" id="blah" src="#"/>
            <br>

            <br>







            <!-- pianta simile -->

            <div id="mostraSimile" class="card mb-3" style="width: fill;">
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

        </form>
    </div>


<script src="{{ asset('js/preview.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/AItrovapianta.js') }}"></script>
@endsection
