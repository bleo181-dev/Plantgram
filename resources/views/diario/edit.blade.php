@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifica ricordo') }}</div>

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

                    <form action="{{ URL::action('DiarioController@update', $diario->codice_diario )}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PUT')
                        <h1> Modifica i dati del ricordo </h1>
                        <textarea name="testo" value="ciao" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $diario->testo }}</textarea>
                        <br>
                        <br>

                        <div class="card col-md-7">
                            <p>Carica una foto</p>
                            <input type="file" name="foto" id="imgInp"> <br>
                            <?php
                                echo '<img id="blah" class="imagePreviewPianta" src="data:image/jpeg;base64,'.base64_encode($diario->foto).'"/>';
                            ?>

                        </div>
                        <br>
                        <br>

                        <input type="submit" class="btn btn-primary" value="Modifica ricordo"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/previewEdit.js') }}"></script>
@endsection
