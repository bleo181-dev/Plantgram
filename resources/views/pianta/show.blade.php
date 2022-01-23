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
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="progress" style="background:none; height:10px">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: 45%; " aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <br>
                    <br>
                    <br>
                    
                    @foreach($eventi as $evento)
                        <div class="row justify-content-center">
                            <div class="progress w-75">
                                <div class="progress-bar" role="progressbar" style="width: {{((strtotime('now')-strtotime($evento->data))*100)/$evento->cadenza }}%" aria-valuenow="{{strtotime(date('Y-m-d H:i:s'))-strtotime($evento->data) }}" aria-valuemin="0" aria-valuemax="{{$evento->cadenza}}">{{$evento->nome}}</div>
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

                            </form>
                        </div>
                        <br>
                       <!-- <canvas id="myChart" style="width:100%;max-width:700px; height: 300px;"></canvas>-->
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
var xyValues = [
  {x:50, y:7},
  {x:60, y:8},
  {x:70, y:8},
  {x:80, y:9},
  {x:90, y:9},
  {x:100, y:9},
  {x:110, y:10},
  {x:120, y:11},
  {x:130, y:14},
  {x:140, y:14},
  {x:150, y:15}
];

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