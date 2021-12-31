@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">{{ __('Eventi') }}</div>

                <div class="card-body">
                    @foreach($eventi as $evento)
                        <div class="row">
                            <div class="progress w-75">
                                <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$evento->nome}}</div>
                            </div>
                            <form action="{{ URL::action('EventoController@update', $evento->codice_evento) }}" method="POST" class="col-md-2">
                                {{ csrf_field() }}
                                @method('PUT')
                                <input type="hidden" id="data" name="nome" value="{{$evento->nome}}">
                                <button class="btn btn-primary" type="submit">{{$evento->nome}}</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection