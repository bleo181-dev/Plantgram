@extends('layouts.app')

@section('content')
<div style="width: fill; background-color: #2ECC40; margin-bottom: 0rem;">
    <div id="cont" class="container">
        <br>
        <h1 style="color: white;" > Crea un ricordo </h1>
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
    <form action="{{ URL::action('DiarioController@store', $id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <h3 style="color: white"> Scrivi un ricordo </h3>
        <textarea name="testo" value="ciao" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('testo') }}</textarea>
        <br>
        @include('foto') <!-- Serve per includere il capo foto e la sua preview -->
        <br>
        <br>
        <input type="submit" style="background: url({{ asset('immagini/creaPagina.png') }}); display: block;
            height: 150px;
            width: 150px;
            border: none;
            margin-right:auto;
            margin-left:auto;" value=""/>
        <br>
    </form>
</div>

<script src="{{ asset('js/preview.js') }}"></script>
@endsection
