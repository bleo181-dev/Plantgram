<div class="col mb-4">

    <div class="card">


        <a href="{{ URL::action('PiantaController@show', $pianta->codice_pianta) }}" >

            <?php
                echo '<img src="data:image/jpeg;base64,'.base64_encode($pianta->foto).'" class="card-img-top" style="height: 250px;"/>';
            ?>

        </a>

      <div class="card-body">
        <div class="row">
            <div class="col-10 text-truncate">
                <h5 class="card-title">{{$pianta->nome}}</h5>
            </div>
          </div>

        <p>Luogo: {{$pianta->luogo}}</p>
        <p>
            <!-- bisogni arrettrati -->
            @foreach($bisogni as $b)
                @foreach($eventi as $d)
                    @if($b['codice_pianta'] == $pianta->codice_pianta)
                        @if($d['codice_pianta'] == $pianta->codice_pianta)
                            @if($d['nome'] == $b['nome'])
                                @if($dataoggi - strtotime($d['data']) > $b['cadenza'])
                                    <p style="color:rgb(145, 0, 0)">{{ $b['nome'] }}</p>
                                @endif
                            @endif
                        @endif
                    @endif
                @endforeach
            @endforeach
            <!-- fine bisogni arrettrati -->
        </p>
        <p class="card-text">

        </p>


                <form  action = "{{ URL::action('PiantaController@destroy', $pianta->codice_pianta)}}" method = "POST">

                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                        <button type = "submit" style="background: none; border: none;"><img src="{{ asset('immagini/delete.png') }}"  class="icone"></button>
                        <a href = "{{ URL::action('PiantaController@edit', $pianta->codice_pianta)}}"><img src="{{ asset('immagini/modifica.png') }}"  class="icone"></a>


                    <br>
                    <br>
                </form>

            <a href="{{ URL::action('DiarioController@index', $pianta->codice_pianta)}}"><img src="{{ asset('immagini/diario.png') }}" class="icone"></a>

            <a href="{{ URL::action('BisognoController@index', $pianta->codice_pianta) }}"> <img src="{{ asset('immagini/bisogni.png') }}" class="icone"> </a>

            <a href="{{ URL::action('EventoController@index', $pianta->codice_pianta) }}"> <img src="{{ asset('immagini/eventi.png') }}" class="icone"> </a>

            <a href="{{ URL::action('PiantaController@show', $pianta->codice_pianta) }}" > <img src="{{ asset('immagini/visualizza.png') }}" class="icone"> </a>
      </div>
    </div>
</div>


