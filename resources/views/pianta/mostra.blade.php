@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">info</div>
                <div class="card-body">
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
                            <div class="progress w-75">
                                <div class="progress-bar" role="progressbar" style="width: {{((strtotime('now')-strtotime($evento->data))*100)/$evento->cadenza }}%" aria-valuenow="{{strtotime(date('Y-m-d H:i:s'))-strtotime($evento->data) }}" aria-valuemin="0" aria-valuemax="{{$evento->cadenza}}">{{$evento->nome}}</div>
                            </div>
                            <form action="{{ URL::action('EventoController@update', $evento->codice_evento) }}" method="POST" class="col-md-2">
                                {{ csrf_field() }}
                                @method('PUT')
                                <input type="hidden" name="nome" value="{{$evento->nome}}">
                                <button class="btn btn-primary" type="submit">{{$evento->nome}}</button>
                            </form>
                        </div>
                        <br>
                        <canvas id="myChart" style="width:100%;max-width:700px; height: 300px;"></canvas>
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