@extends('layouts.app')

@section('content')
@if(Auth::user()->admin)

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('tutte le pubblciità') }}</div>

                <div class="card-body">
                    <div style="padding: 10px;">
                        <a href="{{ URL::action('PubblicitaController@create') }}" class="btn btn-success"> Nuova pubblcita</a>
                    </div>

                    <table class = "col-md-12">
                        <thead>
                            <tr>
                                <th>Codice pubblcita</th>
                                <th>produttore</th>
                                <th>priorita</th>
                                <th>Foto</th>
                                <th>Url</th>
                                <th>azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($annunci as $i)
                                <tr>
                                    <td>{{ $i->codice_pubblicita }}</td>
                                    <td>{{ $i->produttore }}</td>
                                    <td>{{ $i->priorita }}</td>
                                    <td>
                                        <div style="height: 30px; width: 30px;">
                                            <?php

                                            echo '<img src="data:image/jpeg;base64,'.base64_encode($i->foto).'" class="card-img-top"/>';

                                            ?>
                                        </div>
                                    </td>
                                    <td>{{ $i->url }}</td>
                                    <td>
                                        <a href="{{ URL::action('PubblicitaController@edit', $i->codice_pubblicita) }}" class="btn btn-primary" > Modifica </a>
                                        <a href="{{ route('pianta.index') }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{$i->codice_pubblicita}}').submit();" class="btn btn-danger"> Elimina </a>
                                    </td>
                                    <form id="delete-form-{{$i->codice_pubblicita}}" action="{{ URL::action('PubblicitaController@destroy', $i->codice_pubblicita) }}" method="POST">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection