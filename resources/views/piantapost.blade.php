<div class="col mb-4">
    <div class="card">

        <a href="{{ URL::action('PiantaController@show', $pianta->codice_pianta) }}" >
        <?php

        echo '<img src="data:image/jpeg;base64,'.base64_encode($pianta->foto).'" class="card-img-top" style="height: 250px;"/>';

        ?>
        </a>
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






        </p>


                <form action = "{{ URL::action('PiantaController@destroy', $pianta->codice_pianta)}}" method = "POST">

                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type = "submit" style="background: none; border: none;"><img src="/immagini/delete.png" border="0" class="icone"></button>
                    <a href = "{{ URL::action('PiantaController@edit', $pianta->codice_pianta)}}"><img src="/immagini/modifica.png" border="0" class="icone"></a>
                    <br>
                    <br>
                </form>
            <a href="{{ URL::action('DiarioController@index', $pianta->codice_pianta)}}"><img src="/immagini/diario.png" border="0" class="icone"></a>

            <a href="{{ URL::action('BisognoController@index', $pianta->codice_pianta) }}"> <img src="/immagini/bisogni.png" border="0" class="icone"> </a>

            <a href="{{ URL::action('EventoController@index', $pianta->codice_pianta) }}"> <img src="/immagini/eventi.png" border="0" class="icone"> </a>

            <a href="{{ URL::action('PiantaController@show', $pianta->codice_pianta) }}" > <img src="/immagini/visualizza.png" border="0" class="icone"> </a>
      </div>
    </div>
</div>


