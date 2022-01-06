<div class="col mb-4">
    <div class="card">
        <?php

        echo '<img src="data:image/jpeg;base64,'.base64_encode($pianta->foto).'" class="card-img-top"/>';

        ?>
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
        <p class="card-text">

            <div class="bg-info clearfix">
                <a href = "{{ URL::action('PiantaController@edit', $pianta->codice_pianta)}}"><button class="btn btn-primary float-left">Modifica</button></a>

                <form action = "{{ URL::action('PiantaController@destroy', $pianta->codice_pianta)}}" method = "POST">

                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type = "submit" class = "btn btn-danger btn-secondary float-right">Elimina</button>
                </form>
            </div>
            <br>
            <a href="{{ URL::action('DiarioController@index', $pianta->codice_pianta)}}"><button class="btn btn-info">Diario</button></a>
            <a href="{{ URL::action('BisognoController@index', $pianta->codice_pianta) }}" class="btn btn-light" > Bisogni </a>
            <a href="{{ URL::action('EventoController@index', $pianta->codice_pianta) }}" class="btn btn-info" > Eventi </a>
            <a href="{{ URL::action('PiantaController@show', $pianta->codice_pianta) }}" class="btn btn-secondary" > Mostra </a>
        </p>
      </div>
    </div>
</div>


