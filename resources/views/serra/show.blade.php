@extends('layouts.app')

@section('content')
<div style="width: fill; background-color: #2ECC40; margin-bottom: 1rem;">
    <div class="container">
        <br>
        <h1 style="color: white" class="display-4">
            {{$nome_serra}}
        </h1>
        <p class="lead text-right" style="color: white" >
            <br> Serra di {{$nickname_utente}} <br>
        </p>
    </div>
    <br>
</div>

<div class="container">
    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                <!-- ___________________________________________ -->

                <!-- pianta post -->
                <div class="row row-cols-1 row-cols-md-3">
                    @foreach($piante as $pianta)
                        <div class="col mb-4">
                            <div class="card">
                                <a href="{{ URL::action('PiantaController@view', $pianta->codice_pianta) }}" >
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
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- __________________________________________ -->

            </div>
        </div>

        <input type="hidden" name="_token" id="_token" value="{{ csrf_token()}}">
    </div>
</div>

<!-- Modal -->
<div id="modal">

</div>
<!-- Modal2 -->
<div id="modal2">

</div>
<!--endmodal-->


@if(auth()->id() == $serra->id)
    @include('ajax_serra_index')
@endif
@endsection
