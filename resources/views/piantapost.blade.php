<div class="card w-50">
    <img src="/immagini/pianta.jpg" class="card-img-top">
    <div class="card-body">
        <h5 class="card-title">{{$pianta->nome}}</h5>
        <p>Luogo: {{$pianta->luogo}}</p>
    </div>
    <div class="card-body">
        <div class="row">
            <a href = "{{ URL::action('PiantaController@edit', $pianta->codice_pianta)}}"><button class="btn btn-primary">Modifica</button></a>
                                            
            <form action = "{{ URL::action('PiantaController@destroy', $pianta->codice_pianta)}}" method = "POST">

                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button type = "submit" class = "btn btn-danger">Elimina</button>
            </form>
            <a href="{{ URL::action('DiarioController@index', $pianta->codice_pianta)}}"><button class="btn btn-secondary">Diario</button></a>
            <a href="{{ URL::action('BisognoController@index', $pianta->codice_pianta) }}" class="btn btn-light" > Bisogni </a>
            <a href="{{ URL::action('EventoController@index', $pianta->codice_pianta) }}" class="btn btn-info" > Eventi </a>
        </div>
    </div>
    <div class="card-footer">
        <small class="text-muted"></small>
    </div>
  </div>
