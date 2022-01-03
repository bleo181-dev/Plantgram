@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('info') }}
                    <div class="card md-8">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="..." class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{$pianta->nome}}</h5>
                                    <p class="card-text">{{$pianta->luogo}}</p>
                                    <p class="card-text"><small class="text-muted"></small></p>
                                    @foreach($eventi as $evento)
                                    <div class="row">
                                        <div class="progress w-50">
                                            <div class="progress-bar" role="progressbar" style="width: {{((strtotime('now')-strtotime($evento->data))*100)/$evento->cadenza }}%" aria-valuenow="{{strtotime(date('Y-m-d H:i:s'))-strtotime($evento->data) }}" aria-valuemin="0" aria-valuemax="{{$evento->cadenza}}">{{$evento->nome}}</div>
                                        </div>
                                        <form action="{{ URL::action('EventoController@update', $evento->codice_evento) }}" method="POST" class="col-md-2">
                                            {{ csrf_field() }}
                                            @method('PUT')
                                            <input type="hidden" name="nome" value="{{$evento->nome}}">
                                            <button class="btn btn-primary" type="submit">{{$evento->nome}}</button>
                                        </form>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection