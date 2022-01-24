@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">info</div>
                <div class="card-body">
                    
                    @if(auth()->id() == $serra->codice_utente)
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
                            
                            <!-- vecchia progressbar
                            <div class="progress w-75">
                                <div class="progress-bar" role="progressbar" style="width: {{((strtotime('now')-strtotime($evento->data))*100)/$evento->cadenza }}%" aria-valuenow="{{strtotime(date('Y-m-d H:i:s'))-strtotime($evento->data) }}" aria-valuemin="0" aria-valuemax="{{$evento->cadenza}}">{{$evento->nome}}</div>
                            </div>
                            vecchia progressbar -->

                            <div class="progress w-75">
                                <div class="progress-bar" role="progressbar" style="width: 100%; background:linear-gradient(to right, black 10%, red 0%, red 20%, yellow 20%, yellow 40%, green 40%, green 60%, yellow 60%, yellow 80%, red 80%, red 100%);" ></div>
                            </div>

                            <a data-toggle="modal" data-target="#staticBackdrop{{$evento->codice_evento}}"class=" col-md-2 btn btn-primary ">{{$evento->nome}}</a>

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
                            <div class="w-75 accordion" id="accordionExample{{$evento->nome}}">
                            <br>
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#{{$evento->nome}}" aria-expanded="true" aria-controls="collapseOne{{$evento->nome}}">
                                            visualizza grafico
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="{{$evento->nome}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample{{$evento->nome}}">
                                        <div class="card-body">
                                            <!-- plot -->
                                            <div id="myPlot" style="width:100%;max-width:700px"></div>
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
<script>
    var xArray = ["Italy", "France", "Spain", "USA", "Argentina"];
    var yArray = [55, 49, 44, 24, 15];

    var data = [{
    x:xArray,
    y:yArray,
    type:"bar"
    }];

    var layout = {title:"World Wide Wine Production"};

    Plotly.newPlot("myPlot", data, layout);
</script>

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