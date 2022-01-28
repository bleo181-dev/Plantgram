@extends('layouts.app')

@section('content')
    @if(Auth::user())
        @if(Auth::user()->admin)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Crea pubblcita') }}</div>

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

                            <form method="POST" action="{{ URL::action('PubblicitaController@store') }}"  enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <label for="prodotto" class="col-md-4 col-form-label text-md-right">{{ __('Prodotto') }}</label>

                                    <div class="col-md-6">
                                        <input id="prodotto" type="text" class="form-control @error('prodotto') is-invalid @enderror" name="prodotto" required autocomplete="prodotto" autofocus>

                                        @error('prodotto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="produttore" class="col-md-4 col-form-label text-md-right">{{ __('Produttore') }}</label>

                                    <div class="col-md-6">
                                        <input id="produttore" type="text" class="form-control @error('produttore') is-invalid @enderror" name="produttore"  required autocomplete="produttore">

                                        @error('produttore')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="foto" class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>
                                    
                                    <div class="col-md-6">
                                        <input type="file" name="foto" class="custom-file-input" id="imgInp" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Carica una foto</label>
                                    </div>
                                    <img class="imagePreviewPianta rounded mx-auto" id="blah" src="#"/>

                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Crea') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif
<script src="{{ asset('js/preview.js') }}"></script>
@endsection