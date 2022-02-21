@extends('layouts.app')

@section('content')

<div class="container">
                <div class="card-body">

                    <nav class="navbar navbar-light shadow-sm rounded-lg p-3 mb-3" style="background-color: #95e59f86;" >
                        <div class="container">
                            <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                                <a class="navbar-brand" >
                                    Opzioni
                                </a>
                            </button>
                            <br>
                            <br>
                            <div class="collapse navbar-collapse" id="navbar" > -->
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav mr-auto">
                                    <!--back button -->
                                    <li class="nav-item" style="display: flex; justify-content: space-between; align-items: center;">
                                        <div style="margin-right: 20px;">
                                            @if(auth()->id() == $serra->id)
                                                <a href="{{ URL::action('SerraController@index') }}"><img src="{{ asset('immagini/back.png') }}" class="iconaBack"></a>
                                            @else
                                                <a href="{{URL::action('SerraController@indexserrashare', $pianta->codice_serra)  }}"><img src="{{ asset('immagini/back.png') }}" class="iconaBack"></a>
                                            @endif
                                        </div>
                                            <button data-toggle="modal" data-target="#DeletePlant{{$pianta->codice_pianta}}" style="background: none; border: none;"><img src="{{ asset('immagini/delete.png') }}"  class="icone"></button>
                                            <a href = "{{ URL::action('PiantaController@edit', $pianta->codice_pianta)}}"><img src="{{ asset('immagini/modifica.png') }}"  class="icone"></a>
                                    </li>
                                    <!--<br>-->
                                    <!--back button end -->




                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ml-auto">

                                    <!-- inizio stato -->
                                    <li class="nav-item" style="display: flex;  align-items: center;">
                                        @if($pianta->stato == 1)
                                            <button class="btn btn-light" style="pointer-events: none;" >pubblica</button>
                                        @elseif($pianta->stato == 0)
                                            <button class="btn btn-secondary" style="pointer-events: none;" >privata</button>
                                        @endif


                                    </li>
                                    <!-- fine stato -->

                                </ul>
                            <!--</div>-->
                        </div>
                    </nav>
                    <br>
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
                                        " class="jumbotron jumbotron-fluid rounded-lg p-3 mb-3">

                                        <div class="container">
                                            <li  style="display: flex; justify-content: space-between; align-items: center;">
                                                <h1 class="display-4 m_title card-text col-15 text-truncate">{{$evento->nome}}</h1>
                                                <div style="display: flex; justify-content: space-between; align-items: center;">

                                                    <a href="{{ URL::action('BisognoController@edit', $evento->codice_bisogno) }}"> <img src="{{ asset('immagini/modifica.png') }}"  class="icone"> </a>
                                                    <button data-toggle="modal" data-target="#Delete{{$evento->codice_bisogno}}" style="background: none; border: none;"><img src="{{ asset('immagini/delete.png') }}"  class="icone"></button>


                                                </div>
                                            </li>
                                            <div class="progress" style="width: 100%;">
                                                <div class="progress-bar" role="progressbar" style="width: 100%; background:linear-gradient(to right, #111111 {{(((strtotime('now')-strtotime($evento->data))/86400)*100)/(($bisogno->cadenza/86400)*1.5)}}%, #FF4136 0% {{(($bisogno->cadenza/86400)*80)/(($bisogno->cadenza/86400)*1.5)}}%, #FFDC00 {{(($bisogno->cadenza/86400)*95)/(($bisogno->cadenza/86400)*1.5)}}%, #2ECC40 {{(($bisogno->cadenza/86400)*100)/(($bisogno->cadenza/86400)*1.5)}}%, #FFDC00 {{(($bisogno->cadenza/86400)*130)/(($bisogno->cadenza/86400)*1.5)}}%, #FF4136 {{(($bisogno->cadenza/86400)*150)/(($bisogno->cadenza/86400)*1.5)}}%);" ></div>
                                            </div>
                                            <div>
                                                <div style="display: flex; justify-content: space-between;">
                                                    <p>Ultima volta: {{$evento->data}}</p>
                                                    <p>Prossima volta prevista: {{ date("Y-m-d H:i:s",(strtotime($evento->data)+ $bisogno->cadenza)) }}</p>
                                                </div>


                                                <a data-toggle="modal" data-target="#Bisogno{{$evento->codice_evento}}"class=" col-md-2 btn btn-primary ">{{$evento->nome}}</a>

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

                                    <!-- Modal elimina bisogno -->
                                    <div class="modal fade" id="Delete{{$bisogno->codice_bisogno}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title card-text col-9 text-truncate" id="staticBackdropLabel">{{$bisogno->nome}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Sei sicuro di voler eliminare il bisogno {{$bisogno->nome}}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

                                                    <form id="delete-form-{{$bisogno->codice_bisogno}}" action="{{ URL::action('BisognoController@destroy', $bisogno->codice_bisogno) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')

                                                        <button class="btn btn-primary" type="submit">Si</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--endmodal-->

                                @endif
                            @endforeach

                            <!-- Modal -->
                            <div class="modal fade" id="Bisogno{{$evento->codice_evento}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

                    <div class="jumbotron jumbotron-fluid rounded-lg p-3 mb-3" style="background-color: rgba(73, 197, 73, 0.418)">
                        <div class="container">
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <a href="{{ URL::action('BisognoController@create', $pianta->codice_pianta) }}" > <img src="{{ asset('immagini/addbisogno.png') }}" style="height: 150px; width:150px;" /></a>
                            </div>
                        </div>
                    </div>
</div>


<!-- Modal elimina pianta -->
<div class="modal fade" id="DeletePlant{{$pianta->codice_pianta}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title card-text col-9 text-truncate" id="staticBackdropLabel"> Elimina, {{$pianta->nome}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare: {{$pianta->nome}} dal tuo green-space?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

                <form action="{{ URL::action('PiantaController@destroy', $pianta->codice_pianta)}}" method="POST" class="col-md-2">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button class="btn btn-primary" type="submit">Si</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--endmodal-->


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
