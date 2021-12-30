@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">{{ __('diario') }}</div>

                <div class="card-body">
                    <div style="padding: 10px;"> 
                        <a href="{{ URL::action('BisognoController@create', $id) }}" class="btn btn-success"> Crea bisogno</a>
                    </div>
                    <div class="row">
                        @foreach($bisogni as $i)
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="/app/immagini/pianta.jpg" alt="" class="card-img" >
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"></h5>
                                        <p class="card-text">{{ ($i->testo)}}</p>
                        
                                        <a href = "{{ URL::action('BisognoController@edit', $i->codice_bisogno)}}"><button class="btn btn-primary">Modifica</button></a>
                                                                    
                                        <form action = "{{ URL::action('BisognoController@destroy', $i->codice_bisogno)}}" method = "POST">
                        
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                        
                                            <button type = "submit" class = "btn btn-danger">Elimina</button>
                                        </form>
                                        <p class="card-text"><small class="text-muted"></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection