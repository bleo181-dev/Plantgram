<div class="card col-md-4">
    <div>
        <?php

        echo '<img src="data:image/jpeg;base64,'.base64_encode($pianta->foto).'" class="card-img-top"/>';

        ?>
    </div>
    <div class="card-body">
        <h5 class="card-title">{{$pianta->nome}}</h5>
        <p>Luogo: {{$pianta->luogo}}</p>
        <p>
            @foreach($bisogni as $b)
                @if($b['codice_pianta'] == $pianta->codice_pianta)
                    @foreach($eventi as $d)
                        @if($d['nome'] == $b['nome'])
                            @if($dataoggi - strtotime($d['data']) > $b['cadenza'])
                                {{ $b['nome'] }}
                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach
        </p>
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
            <a href="{{ URL::action('PiantaController@show', $pianta->codice_pianta) }}" class="btn btn-secondary" > Mostra </a>
        </div>
    </div>
    <div class="card-footer">
        <small class="text-muted"></small>
    </div>
  </div>
