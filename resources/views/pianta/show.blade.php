@extends('layouts.app')

@section('content')

<div class="container">
                <div class="card-body">
                    
                    <div style="display: flex; justify-content: space-between;">
                        <!--back button -->
                        @if(auth()->id() == $serra->id)
                            <div style="padding:10px">
                                <a href="{{ URL::action('SerraController@index') }}"><img src="{{ asset('immagini/back.png') }}" class="iconaBack" /></a>
                            </div>
                        @else
                            <div style="padding:10px">
                                <a href="{{URL::action('SerraController@indexserrashare', $pianta->codice_serra)  }}"><img src="{{ asset('immagini/back.png') }}" class="iconaBack" /></a>
                            </div>
                        @endif
                        <!--back button end -->

                        @if($pianta->stato == 1)
                            <div>
                                <p class="btn btn-primary" style="pointer-events: none" >pubblica</p>
                            </div>
                        @elseif($pianta->stato == 0)
                            <div>
                                <p class="btn btn-secondary" style="pointer-events: none" >privata</p>
                            </div>
                        @endif
                    </div>

                    <!-- Plant info -->
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <?php
                                echo '<img class="card-img" src="data:image/jpeg;base64,'.base64_encode($pianta->foto).'"/>';
                            ?>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h1 class="card-title m_title" style="color: white;">{{$pianta->nome}}</h1>
                                <p class="card-text" style="text-transform:uppercase; color: white;">{{$pianta->luogo}}</p>
                                <p class="card-text"><small class="text-muted"></small></p>

                                <!-- diario -->
                                <?php $count=0; ?>
                                    @foreach($diario as $i)
                                        <?php $count ++; ?>
                                    @endforeach

                                @if ($count != 0)

                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators" >
                                            <?php $count=0; ?>
                                            @foreach($diario as $i)

                                                @if ($count == 0)
                                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$count}}" class="active"></li>
                                                @endif
                                                @if ($count != 0)
                                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$count}}"></li>
                                                @endif
                                                <?php $count ++; ?>
                                            @endforeach

                                        </ol>
                                        <div class="carousel-inner" >
                                            <?php $count=0; ?>
                                            @foreach($diario as $i)
                                                @if ($count == 0)
                                                    <div class="carousel-item active">
                                                        <a href="{{ URL::action('DiarioController@index', $pianta->codice_pianta)}}" style="text-decoration: none; color: black;" >
                                                            @include('diario.diariopostPianta')
                                                        </a>
                                                    </div>
                                                @endif

                                                @if ($count != 0)
                                                    <div class="carousel-item">
                                                        <a href="{{ URL::action('DiarioController@index', $pianta->codice_pianta)}}" style="text-decoration: none; color: black;">
                                                            @include('diario.diariopostPianta')
                                                        </a>
                                                    </div>

                                                @endif
                                                <?php $count ++; ?>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                @endif
                                @if ($count == 0)
                                    <a href="{{ URL::action('DiarioController@create', $pianta->codice_pianta)}}"><img src="{{ asset('immagini/diarioMAX.png') }}" class="col-md-3"></a>
                                @endif


                                <!-- fine diario -->

                            </div>
                        </div>
                    </div>
                    <br>
                    <hr style="background-color: white;">
                    <br>
                    <!-- Plant info end-->
                    <h3  style="color: white;"> I bisogni della tua pianta </h3>
                    <br>
                    @foreach($eventi as $evento)
                        <div class="row justify-content-center">
                            @foreach($bisogni as $bisogno)
                                @if($evento->codice_bisogno == $bisogno->codice_bisogno)

                                    <!-- jumbotron -->
                                    <div style="width: 100%;
                                        @if ($evento->nome == "acqua")
                                            background-color: #54aedb;
                                        @endif
                                        @if ($evento->nome == "concime")
                                            background-color: #ff892e;
                                        @endif
                                        @if ($evento->nome == "svasatura")
                                            background-color: #8c5c38;
                                        @endif
                                        @if ($evento->nome == "raccolto")
                                            background-color: #79d547;
                                        @endif
                                        @if ($evento->nome == "potatura")
                                            background-color: #759b9d;
                                        @endif
                                        " class="jumbotron jumbotron-fluid">

                                        <div class="container">
                                            <h1 class="display-4 m_title">{{$evento->nome}}</h1>
                                            <div class="progress" style="width: 100%;">
                                                <div class="progress-bar" role="progressbar" style="width: 100%; background:linear-gradient(to right, #111111 {{(((strtotime('now')-strtotime($evento->data))/86400)*100)/(($bisogno->cadenza/86400)*1.5)}}%, #FF4136 0% {{(($bisogno->cadenza/86400)*80)/(($bisogno->cadenza/86400)*1.5)}}%, #FFDC00 {{(($bisogno->cadenza/86400)*95)/(($bisogno->cadenza/86400)*1.5)}}%, #2ECC40 {{(($bisogno->cadenza/86400)*100)/(($bisogno->cadenza/86400)*1.5)}}%, #FFDC00 {{(($bisogno->cadenza/86400)*130)/(($bisogno->cadenza/86400)*1.5)}}%, #FF4136 {{(($bisogno->cadenza/86400)*150)/(($bisogno->cadenza/86400)*1.5)}}%);" ></div>
                                            </div>
                                            <div>
                                                <div style="display: flex; justify-content: space-between;">
                                                    <p>Ultima volta: {{$evento->data}}</p>
                                                    <p>Prossima volta prevista: {{ date("Y-m-d H:i:s",(strtotime($evento->data)+ $bisogno->cadenza)) }}</p>
                                                </div>


                                                <a data-toggle="modal" data-target="#staticBackdrop{{$evento->codice_evento}}"class=" col-md-2 btn btn-primary ">{{$evento->nome}}</a>

                                                <br>

                                                <!-- explode -->
                                                <div id="accordionExample{{$evento->nome}}">
                                                    <br>
                                                    <div>
                                                        <div id="headingOne">
                                                            <h2 class="mb-0">
                                                                <!--btn grafico -->
                                                                <div style="display: flex; justify-content: center; align-items: center;">
                                                                    <button style="background: none; border: none;" type="button" data-toggle="collapse" data-target="#{{$evento->nome}}" aria-expanded="false" aria-controls="{{$evento->nome}}">
                                                                        <img src="{{ asset('immagini/grafico.png') }}" class="iconaBack" />
                                                                    </button>
                                                                </div>
                                                                <!--btn grafico -->
                                                            </h2>
                                                        </div>

                                                        <div id="{{$evento->nome}}" class="" style="overflow: hidden;" aria-labelledby="headingOne" data-parent="#accordionExample{{$evento->nome}}">

                                                            <div>
                                                                <!-- plot -->
                                                                <div id="myPlot{{$evento->codice_bisogno}}" style="width:100%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--endexplode-->

                                            </div>
                                        </div>
                                    </div>
                                    <!-- jumbotron end-->

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
                                            Sei sicuro di aver dato: {{$evento->nome}} alla tua pianta?
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
                        </div>
                        <br>
                    @endforeach

                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <a href="{{ URL::action('BisognoController@create', $pianta->codice_pianta) }}" > <img src="{{ asset('immagini/addSerra.png') }}" style="height: 80px; width:80px;" /></a>
                            </div>
                        </div>
                    </div>
</div>

@foreach($bis as $y)
<script>

    var xArray = [];
    var yArray = [];
    var mesi = ["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"];
    var num;
    @foreach($ev as $e)
        @if($y->codice_bisogno == $e->codice_bisogno)
            num={{$e->month - 1}};
            xArray.push(mesi[num]);
            @if((strtotime($y->created_at) - strtotime($e->created_at)) == 0)
                yArray.push({{$e->volte -1}});
            @else
                yArray.push({{$e->volte}});
            @endif
        @endif
    @endforeach

    var data = [{
        x:xArray,
        y:yArray,
        type:"bar"
    }];

    var layout = {title:"azioni per mese",
        xaxis: {title: "mesi"},
        yaxis: {title: "numero di azioni", dtick: 1,}
        };

    Plotly.newPlot("myPlot{{$y->codice_bisogno}}", data, layout);
</script>
@endforeach


    <script>
        @foreach($eventi as $evento)
        document.getElementById("{{$evento->nome}}").className = "collapse";
        @endforeach
    </script>

<!--<script>
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
</script>-->
@endsection
