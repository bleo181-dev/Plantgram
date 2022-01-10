<div class="col mb-4">

    <div style="width: 200px; display: block;
    margin-left: auto;
    margin-right: auto;">
        <a href="{{ URL::action('PiantaController@show', $pianta->codice_pianta) }}" >
        <?php

        echo '<img src="data:image/jpeg;base64,'.base64_encode($pianta->foto).'" class="card-img-top" style=" width: 120px; height: 120px; display: block;
        margin-left: auto;
        margin-right: auto;"/>';

        ?>
        <img class="card-img-top" src="{{ asset('immagini/vaso.png') }}" border="0" class="icone">
        </a>

    </div>
    <br>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{$pianta->nome}}</h5>
        <p>Luogo: {{$pianta->luogo}}</p>
        <p>
            <!-- bisogni arrettrati -->
            @foreach($bisogni as $b)
                @if($b['codice_pianta'] == $pianta->codice_pianta)
                    @foreach($eventi as $d)
                        @if($d['nome'] == $b['nome'])
                            @if($dataoggi - strtotime($d['data']) > $b['cadenza'])
                                <p style="color:rgb(145, 0, 0)">{{ $b['nome'] }}</p>
                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach
            <!-- fine bisogni arrettrati -->
        </p>
        <p class="card-text">

        </p>


                <form  action = "{{ URL::action('PiantaController@destroy', $pianta->codice_pianta)}}" method = "POST">

                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                        <button type = "submit" style="background: none; border: none;"><img src="{{ asset('immagini/delete.png') }}" border="0" class="icone"></button>
                        <a href = "{{ URL::action('PiantaController@edit', $pianta->codice_pianta)}}"><img src="{{ asset('immagini/modifica.png') }}" border="0" class="icone"></a>


                    <br>
                    <br>
                </form>

            <a href="{{ URL::action('DiarioController@index', $pianta->codice_pianta)}}"><img src="{{ asset('immagini/diario.png') }}" border="0" class="icone"></a>

            <a href="{{ URL::action('BisognoController@index', $pianta->codice_pianta) }}"> <img src="{{ asset('immagini/bisogni.png') }}" border="0" class="icone"> </a>

            <a href="{{ URL::action('EventoController@index', $pianta->codice_pianta) }}"> <img src="{{ asset('immagini/eventi.png') }}" border="0" class="icone"> </a>

            <a href="{{ URL::action('PiantaController@show', $pianta->codice_pianta) }}" > <img src="{{ asset('immagini/visualizza.png') }}" border="0" class="icone"> </a>
      </div>
    </div>
</div>


