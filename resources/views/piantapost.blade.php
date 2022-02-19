<div class="col mb-4">
    <div class="card">
        <a href="{{ URL::action('PiantaController@show', $pianta->codice_pianta) }}" >
            <div class="plant">
                <?php
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($pianta->foto).'" class="card-img-top" />';
                ?>
            </div>
        </a>
        <div class="card-body">
            <div class="row">
                <div class="col-10 text-truncate">
                    <h5 style="display: inline;">{{$pianta->nome}}</h5>
                </div>
            </div>
            <!-- bisogni arrettrati -->
            <div class="card-text col-20 text-truncate">
            @foreach($bisogni as $b)
                @foreach($eventi as $d)
                    @if($b['codice_pianta'] == $pianta->codice_pianta)
                        @if($d['codice_pianta'] == $pianta->codice_pianta)
                            @if($d['nome'] == $b['nome'])
                                @if($dataoggi - strtotime($d['data']) > $b['cadenza'])
                                    <div  style="color:rgb(145, 0, 0); display: inline-block; ">
                                        {{ $b['nome'] }}
                                    </div>
                                @endif
                            @endif
                        @endif
                    @endif
                @endforeach
            @endforeach
            </div>
            <!-- fine bisogni arrettrati -->
        </div>
    </div>
</div>


