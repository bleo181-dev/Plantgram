@extends('layouts.app')

@section('content')
<div style="width: fill; background-color: #1e90ff; margin-bottom: 1rem;">

    <div class="container">
        <br>
        <h1 style="color: white" class="display-4">
            {{$nome_serra}}
        </h1>



        <p class="lead text-right" style="color: white" >
            @foreach($forecast as $f)
                <img width=50px src=" http://openweathermap.org/img/wn/{{$f->icon}}.png">
            @endforeach
            <br>

            Benvenuto, {{$nickname_utente}} <br>
            Oggi abbiamo
            @foreach($forecast as $f)
                {{$f->description}}
            @endforeach
            e ci sono {{$forecast_data->temp}}°C di cui percepiti {{$forecast_data->feels_like}}°C
            @if ($forecast_data->temp < 2)
                <p class="lead text-right" style="color:burlywood" >
                    Le tue piante potrebbero avere freddo se sono fuori, rientrale!
                </p>
            @endif

            <div class="display-4 lead text-right">
                @if(auth()->id() == $serra->id)
                        <!-- Aggiungi collaboratore -->
                        <a href="{{ URL::action('SerraController@collab') }}" > <img src="{{ asset('immagini/share.png') }}"> </a>

                        <!-- collaboratori -->

                        <div class="btn-group">
                            <button name="num_collab" type="button" class="btn btn-primary" style="pointer-events: none;">
                                Collaboratori <span id="num_collab" class="badge badge-light"><!-- num collaboratori tramite ajax --></span>
                            </button>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div id="collab" class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                <!-- <a class="dropdown-item" href="#">Action</a> -->
                                <!-- qui verranno aggiunti i collaboratori tramite ajax -->
                            </div>
                        </div>
                        <!-- _________________ -->

                @endif
            </div>
        </p>
    </div>
    <br>
</div>
<div class="container">
    <div class="card-body">

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation" style="display: block; margin-left: auto; margin-right: auto;">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                @if(auth()->id() == $serra->id)
                    Il mio green-space
                @else
                    La serra con cui collabori
                @endif

            </a>
            </li>
            @if(auth()->id() == $serra->id)
                <li class="nav-item" role="presentation" style="display: block; margin-left: auto; margin-right: auto;">
                    <a class="nav-link" id="pills-serra-share" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Serre condivise</a>
                </li>

                <li class="nav-item" role="presentation" style="display: block; margin-left: auto; margin-right: auto;">
                    <a class="nav-link" id="pills-home-piante" data-toggle="pill" href="#pills-home-p" role="tab" aria-controls="pills-home-p" aria-selected="false">Home</a>
                </li>
            @endif
        </ul>
        <hr style="background-color: white">
        <br>

        <!-- div opzioni la mia serra, serre condivise ecc ... -->

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                <!-- _________________________________ -->

                <!-- pianta post -->
                <div class="row row-cols-1 row-cols-md-3">
                    @foreach($piante as $pianta)
                        @include('piantapost')
                    @endforeach
                    @if(auth()->id() == $serra->id)
                        <div class="col mb-4">
                            <div class="col mb-4">
                                <div class="card">
                                    <a href="{{ URL::action('PiantaController@create') }}" class="btn btn-success"> <img src="{{ asset('immagini/add.png') }}" class="card-img-top" /></a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- __________________________________________ -->

            </div>
            <div class="tab-pane fade" id="pills-home-p" role="tabpanel" aria-labelledby="pills-home-piante">

                <h1 style="color: white">Tutte le piante condivise</h1>

            </div>
            @if(auth()->id() == $serra->id)
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-serra-share">

                    <!-- serre condivise con ajax -->


                </div>
            @endif
        </div>

        <input type="hidden" name="_token" id="_token" value="{{ csrf_token()}}">
    </div>
</div>

<!-- Modal -->
<div id="modal">

</div>

<div id="modal2">

</div>
<!--endmodal-->


@if(auth()->id() == $serra->id)
    <script>
            var oldLength_collab = -1; //serve per non refreshare sempre il contenutto, evitando sfarfallii

            function fetch_data_collab(){

                $.ajax({
                    url:"{{ asset("/collabora/fetch_data") }}",
                    dataType:"json",
                    success:function(data){
                        var html = '';
                        var modal = '';

                        for(var count=0; count < data.length; count++){
                                html += '<p class="dropdown-item" style="pointer-events: none;">'+data[count].nickname;
                                html += '<button id="'+count+'" name="btn_a"type = "submit" style="pointer-events: fill; background: none; border: none; width: 10px;" data-toggle="modal" data-target="#staticBackdrop'+data[count].codice_collaborazione+'"><img src="'+'{{ asset("immagini/delete.png") }}'+'"  class="icone"></button>';

                                modal += '<div class="modal fade" id="staticBackdrop'+data[count].codice_collaborazione+'" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">';
                                modal += '<div class="modal-dialog">';
                                modal += '<div class="modal-content">';
                                modal += '<div class="modal-header">';
                                modal += '<h5 class="modal-title" id="staticBackdropLabel"></h5>';
                                modal += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                                modal += '<span aria-hidden="true">&times;</span></button>';
                                modal += '</div>';
                                modal += '<div class="modal-body">';
                                modal += 'Sei sicuro di voler eliminare il collaboratore '+data[count].nickname+'?</div>';
                                modal += '<div class="modal-footer">';
                                modal += '<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>';
                                modal += '<form action="" method="POST" class="col-md-2">';
                                modal += '<input type="hidden" name="nome" value="">';
                                modal += '<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="destroy_collaboratore('+data[count].codice_collaborazione+')">Si</button></form></div></div></div></div>';

                        }
                        if(oldLength_collab != data.length){ //serve per non refreshare sempre il contenutto, evitando sfarfallii
                            document.getElementById("collab").innerHTML = html;
                            document.getElementById("num_collab").innerHTML = data.length;
                            document.getElementById("modal2").innerHTML = modal;
                            console.log('Aggiorno: Elementi variati collaboratori');
                            oldLength_collab = data.length;

                        }

                    }
                });
            }

            var oldLength_serre = -1;
            function fetch_data_serre(){

                $.ajax({
                    url:"{{ asset("/serra/fetch_data_serre") }}",
                    dataType:"json",
                    success:function(data){

                        var html_serre = '';
                        var modal = '';

                        for(var count=0; count < data.length; count++){
                                html_serre += '<div class="btn-group w-100">';
                                html_serre += '<a class="btn btn-primary btn-lg btn-block" type="button" href="{{ asset("serra/share/") }}/'+data[count].codice_serra+'">'+data[count].nome+'</a>';
                                html_serre += '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#staticBackdrop'+data[count].codice_collaborazione+'">';
                                html_serre += '<img src="{{ asset("immagini/delete.png") }}" class="icone"></button></div><br><br>';

                                modal += '<div class="modal fade" id="staticBackdrop'+data[count].codice_collaborazione+'" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">';
                                modal += '<div class="modal-dialog">';
                                modal += '<div class="modal-content">';
                                modal += '<div class="modal-header">';
                                modal += '<h5 class="modal-title" id="staticBackdropLabel"></h5>';
                                modal += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                                modal += '<span aria-hidden="true">&times;</span></button>';
                                modal += '</div>';
                                modal += '<div class="modal-body">';
                                modal += 'Sei sicuro di voler più collaborare con la serra '+data[count].nome+'?</div>';
                                modal += '<div class="modal-footer">';
                                modal += '<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>';
                                modal += '<form action="" method="POST" class="col-md-2">';
                                modal += '<input type="hidden" name="nome" value="">';
                                modal += '<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="destroy_collaboratore('+data[count].codice_collaborazione+')">Si</button></form></div></div></div></div>';
                        }

                        if(oldLength_serre != data.length){ //serve per non refreshare sempre il contenutto, evitando sfarfallii
                            document.getElementById("pills-profile").innerHTML = html_serre;
                            document.getElementById("modal").innerHTML = modal;
                            console.log('Aggiorno: Elementi variati serre');
                            oldLength_serre = data.length;

                        }

                    }
                });
            }

            function destroy_collaboratore(id){
                console.log('Elimino: Codice_collab-'+id);
                var _token = $('#_token').val();
                console.log('token: '+_token);
                if(id != null){
                    $.ajax({
                        url: "{{ asset("/collabora/elimina") }}",
                        type: "POST",
                        dataType: "json",
                        data: {'id' : id, '_token' : _token},
                        success: function(data){
                            console.log(data);
                            if(data.success === 'OK'){
                                fetch_data_collab();
                                fetch_data_serre();
                                console.log("aggiorno dopo elimina");
                            }


                        },
                        error: function(response, stato){
                            console.log(stato);
                        }
                    });
                }

            }

            function destroy_collaborazione(){


            }
        $(document).ready(function(){

            fetch_data_collab();
            fetch_data_serre();
            setInterval(fetch_data_collab, (4 * 1000)); //setta un timer che effettua la chiamata ajax ogni 4 secondi
            setInterval(fetch_data_serre, (4 * 1000)); //setta un timer che effettua la chiamata ajax ogni 4 secondi
            console.log('Intervallo di aggiornamento settato!');

        });

    </script>
@endif
@endsection
