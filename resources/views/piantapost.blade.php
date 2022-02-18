<div class="col mb-4">
    <div class="card">
        <a href="{{ URL::action('PiantaController@show', $pianta->codice_pianta) }}" >
            <?php
                echo '<img src="data:image/jpeg;base64,'.base64_encode($pianta->foto).'" class="card-img-top" style="height: 350px;"/>';
            ?>
        </a>
    <div class="card-body">
        <div class="row">
            <div class="col-10 text-truncate">
                <h5 class="card-title">{{$pianta->nome}}</h5>
            </div>
        </div>
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
      </div>
    </div>
</div>


