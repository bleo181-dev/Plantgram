@extends('layouts.app')

@section('content')
<div style="width: fill; background-color: #1e90ff; margin-bottom: 0rem;">
    <div id="cont" class="container">
        <br>
        <h1 class="col-md-4"> Modifica ricordo </h1>
        <br>
        <hr>
    </div>
</div>
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

        <form action="{{ URL::action('DiarioController@update', $diario->codice_diario )}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <h1 style="color: white;" > Modifica i dati del ricordo </h1>
            <textarea name="testo" value="ciao" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $diario->testo }}</textarea>
            <br>
            <br>

            <div class="custom-file">
                <input type="file" name="foto" class="custom-file-input" id="imgInp" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Carica una foto</label>
            </div>
            <?php
                    echo '<img id="blah" class="imagePreviewPianta" src="data:image/jpeg;base64,'.base64_encode($diario->foto).'"/>';
            ?>
            <br>
            <br>

            <input type="submit" style="background: url({{ asset('immagini/addSerra.png') }});display: block;
                height: 80px;
                width:80px;
                border: none;
                margin-right:auto;
                margin-left:auto;" value=""/>
            <br>
        </form>
    </div>
</div>
<script src="{{ asset('js/previewEdit.js') }}"></script>
@endsection
