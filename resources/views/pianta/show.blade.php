@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">info</div>
                <div class="card-body">
                    
                    @if(auth()->id() == $serra->id)
                    <div style="padding:10px">
                        <a href="{{ URL::action('SerraController@index') }}" class="btn btn-secondary">Indietro</a>
                    </div>
                    @else
                    <div style="padding:10px">
                        <a href="{{URL::action('SerraController@indexserrashare', $pianta->codice_serra)  }}" class="btn btn-secondary">Indietro</a>
                    </div>
                    @endif
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <?php
                                echo '<img class="card-img" src="data:image/jpeg;base64,'.base64_encode($pianta->foto).'"/>';
                            ?>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$pianta->nome}}</h5>
                                <p class="card-text">{{$pianta->luogo}}</p>
                                <p class="card-text"><small class="text-muted"></small></p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                
                    @foreach($eventi as $evento)
                    <div class="row justify-content-center">
                        @foreach($bisogni as $bisogno)
                            @if($evento->codice_bisogno == $bisogno->codice_bisogno)
                                <div class="progress w-75">
                                    <div class="progress-bar" role="progressbar" style="width: 100%; background:linear-gradient(to right, #111111 {{(((strtotime('now')-strtotime($evento->data))/86400)*100)/(($bisogno->cadenza/86400)*1.5)}}%, #FF4136 0% {{(($bisogno->cadenza/86400)*80)/(($bisogno->cadenza/86400)*1.5)}}%, #FFDC00 {{(($bisogno->cadenza/86400)*95)/(($bisogno->cadenza/86400)*1.5)}}%, #2ECC40 {{(($bisogno->cadenza/86400)*100)/(($bisogno->cadenza/86400)*1.5)}}%, #FFDC00 {{(($bisogno->cadenza/86400)*130)/(($bisogno->cadenza/86400)*1.5)}}%, #FF4136 {{(($bisogno->cadenza/86400)*150)/(($bisogno->cadenza/86400)*1.5)}}%);" ></div>
                                </div>
                                <div class="w-75">
                                    <p>Ultima volta: {{$evento->data}}</p>
                                    <p>Prossima volta prevista: {{ date("Y-m-d H:i:s",(strtotime('now')+ $bisogno->cadenza)) }}</p>
                                    <a data-toggle="modal" data-target="#staticBackdrop{{$evento->codice_evento}}"class=" col-md-2 btn btn-primary ">{{$evento->nome}}</a>
                                </div>
                            @endif
                        @endforeach

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop{{$evento->codice_evento}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">{{$evento->nome}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Sei sicuro di aver dato cio di cui la pianta ha bisogno?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <form action="{{ URL::action('EventoController@store', $evento->codice_evento) }}" method="POST" class="col-md-2">
                                                {{ csrf_field() }}
                                                @method('PUT')
                                                <input type="hidden" name="nome" value="{{$evento->nome}}">
                                                <button class="btn btn-primary" type="submit">Si</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--endmodal-->
                            
                            <br>

                            <!-- explode -->
                            <div class="col-md-12 accordion" id="accordionExample{{$evento->nome}}">
                            <br>
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#{{$evento->nome}}" aria-expanded="false" aria-controls="{{$evento->nome}}">
                                            visualizza grafico
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="{{$evento->nome}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample{{$evento->nome}}">
                                        <div class="card-body">
                                            <!-- plot -->
                                            <div id="myPlot{{$evento->codice_bisogno}}" style="width:100%;max-width:700px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--endexplode-->                                  
                        </div>  
                        <br>
                    @endforeach
                        
                    @foreach($diario as $i)
                        @include('diario.diariopost')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($bis as $y)
<script>

    var xArray = [];
    var yArray = [];
    @foreach($ev as $e)
        @if($y->codice_bisogno==$e->codice_bisogno) 
            xArray.push({{$e->month}});
            yArray.push({{$e->volte}});
        @endif
    @endforeach

    var data = [{
    x:xArray,
    y:yArray,
    type:"bar"
    }];

    var layout = {title:"azioni per mese"};

    Plotly.newPlot("myPlot{{$y->codice_bisogno}}", data, layout);
</script>
@endforeach

<script>
new Chart("myChart", {
  type: "scatter",
  data: {
    datasets: [{
      pointRadius: 4,
      pointBackgroundColor: "rgb(0,0,255)",
      data: xyValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      xAxes: [{ticks: {min: 40, max:160}}],
      yAxes: [{ticks: {min: 6, max:16}}],
    }
  }
});
</script>
@endsection