@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class ="col-md-8">
            <!--back button -->
            <div style="padding:10px">
                <a href="{{URL::action('SerraController@show', $pianta->codice_serra)  }}"><img src="{{ asset('immagini/back.png') }}" class="iconaBack" /></a>
            </div>
            <!--back button end -->
            <div class="card">
                <div class="card-header"> Diario di {{ $pianta->nome }}</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($diario as $i)
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="cropper">
                                            <?php
                                                echo '<img class="card-img" src="data:image/jpeg;base64,'.base64_encode($i->foto).'"/>';
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"></h5>
                                                <p class="card-text">{{ ($i->testo)}}</p>
                                                <p class="card-text">{{$i->updated_at}}<small class="text-muted"></small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection