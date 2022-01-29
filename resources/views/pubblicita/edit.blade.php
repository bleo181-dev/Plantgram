@extends('layouts.app')

@section('content')
    @if(Auth::user())
        @if(Auth::user()->admin)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Modifica pubblicita') }}</div>

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
                            <form action="{{ URL::action('PubblicitaController@update', $pubblicita->codice_pubblicita)}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @method('PUT')
                                <h1> Modifica i dati della pubblicita </h1>

                                <div class="form-group row">
                                    <label for="produttore" class="col-md-4 col-form-label text-md-right">{{ __('Produttore') }}</label>

                                    <div class="col-md-6">
                                        <input id="produttore" type="text" class="form-control @error('produttore') is-invalid @enderror" name="produttore" value="{{$pubblicita->produttore}}" required autocomplete="produttore">

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

                                <div class="form-group row">
                                    <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('Url') }}</label>

                                    <div class="col-md-6">
                                        <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{$pubblicita->url}}" required autocomplete="url" autofocus>

                                        @error('url')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="priorita" class="col-md-4 col-form-label text-md-right">{{ __('Priorita') }}</label>

                                    <div class="col-md-6">
                                        <input id="priorita" type="number" class="form-control @error('priorita') is-invalid @enderror" name="priorita" value="{{$pubblicita->priorita}}" required autocomplete="priorita">

                                        @error('priorita')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Modifica') }}
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