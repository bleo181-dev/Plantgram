@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Crea ricordo') }}</div>

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

                    <form action="{{ URL::action('DiarioController@store', $id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <h1> Scrivi un ricordo </h1>
                        <textarea name="testo" value="ciao" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('testo') }}</textarea>
                        
                        <br>
                        <br>
                        @include('foto') <!-- Serve per includere il capo foto e la sua preview -->
                        <br>
                        <br>

                        <input type="submit" class="btn btn-primary" value="Crea ricordo"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/preview.js') }}"></script>
@endsection
