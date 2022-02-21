@extends('layouts.app')

@section('content')

<div class="container">
                <div class="card-body">
                <!--back button -->
                    <div style="padding:10px">
                        <a href="{{URL::action('SerraController@show', $serra->id)  }}"><img src="{{ asset('immagini/back.png') }}" class="iconaBack" /></a>
                    </div>
                <!--back button end -->

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
                                                        <a href="{{ URL::action('DiarioController@indexPubblica', $pianta->codice_pianta)}}" style="text-decoration: none; color: black;" >
                                                            @include('diario.diariopostPianta')
                                                        </a>
                                                    </div>
                                                @endif

                                                @if ($count != 0)
                                                    <div class="carousel-item">
                                                        <a href="{{ URL::action('DiarioController@indexPubblica', $pianta->codice_pianta)}}" style="text-decoration: none; color: black;">
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
                                    <h4 style="color: white"> Nessun diario disponibile </h4>
                                @endif
                                <!-- fine diario -->

                            </div>
                        </div>
                    </div>
                    <br>
                    <hr style="background-color: white;">
                    <br>
                    <!-- Plant info end-->
                    <h3  style="color: white;"> I bisogni della pianta </h3>
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
                                        " class="jumbotron jumbotron-fluid rounded-lg p-3 mb-3">

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
                        </div>
                        <br>
                    @endforeach

</div>

@foreach($bis as $y)
<script>
    $('document').ready(function(){

    var xArray = [];
    var yArray = [];
    var mesi = ["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"];
    var num;
    @foreach($ev as $e)
        @if($y->codice_bisogno == $e->codice_bisogno)
            num={{$e->month - 1}};
            xArray.push(mesi[num]);
            @if((strtotime($y->created_at) - strtotime($e->created_at)) > -2 || (strtotime($y->created_at) - strtotime($e->created_at) < 2))
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

    });
</script>
@endforeach


    <script>
        $('document').ready(function(){
            @foreach($eventi as $evento)
            document.getElementById("{{$evento->nome}}").className = "collapse";
            @endforeach
        });
    </script>


    <script>
        $('document').ready(function(){
            @foreach($eventi as $evento)
            document.getElementById("{{$evento->nome}}").className = "collapse";
            @endforeach
        });
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
