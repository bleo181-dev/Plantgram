@extends('layouts.app')

@section('content')

            <div style="width: fill; background-color: #1e90ff; margin-bottom: 0rem;">
                <br>
                <div id="cont" class="container">
                    <div style="display: flex; align-items: center;">
                        <!--back button -->
                        <div style="padding:10px">
                            <a href="{{URL::action('PiantaController@view', $pianta->codice_pianta)  }}"><img src="{{ asset('immagini/back.png') }}" class="iconaBack" /></a>
                        </div>
                        <!--back button end -->
                        <h1 style="margin-left:10px">Diario di {{ $pianta->nome }}</h1>
                    </div>
                </div>

                    <br>
                    <hr>
                </div>
                <div class="row justify-content-center">
                            @foreach($diario as $i)
                                <div class="card col-md-8" style="color: none;">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <?php

                                                echo '<img class="card-img" src="data:image/jpeg;base64,'.base64_encode($i->foto).'"/>';
                                            ?>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card-body">
                                                <h5 class="card-title"></h5>
                                                <p class="card-text" style="font-size:20px;">{{ ($i->testo)}}</p>

                                                <p class="card-text">{{$i->updated_at}}<small class="text-muted"></small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
@endsection
