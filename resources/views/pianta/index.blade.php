
@extends('layouts.app')

@section('content')
@if(Auth::user()->admin==='AD')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Tutte le piante') }}</div>

                <div class="card-body">
                    <table style="padding: 1rem; word-break: break-word; width: 100%;">
                        <thead>
                            <tr>
                                <th>Codice Pianta</th>
                                <th>Codice Serra</th>
                                <th>Nome</th>
                                <th>Foto</th>
                                <th>Luogo</th>
                                <th>Stato</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($piante as $i)
                                <tr>
                                    <td>{{ $i->codice_pianta }}</td>
                                    <td>{{ $i->codice_serra }}</td>
                                    <td>{{ $i->nome }}</td>
                                    <td>
                                        <div style="height: 30px; width: 30px;">
                                            <?php

                                            echo '<img src="data:image/jpeg;base64,'.base64_encode($i->foto).'" class="imageHomePianta"/>';

                                            ?>
                                        </div>


                                    </td>
                                    <td>{{ $i->luogo }}</td>
                                    <td>
                                        @if ($i->stato == 0)
                                            Privato
                                            @elseif ($i->stato == 1)
                                                Pubblico
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ URL::action('PiantaController@show', $i->codice_pianta) }}" class="btn btn-info" > Mostra </a>
                                        <a href="{{ URL::action('PiantaController@edit', $i->codice_pianta) }}" class="btn btn-primary" > Modifica </a>
                                        <a href="{{ route('pianta.index') }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{$i->codice_pianta}}').submit();" class="btn btn-danger"> Elimina </a>
                                    </td>
                                    <form id="delete-form-{{$i->codice_pianta}}" action="{{ URL::action('PiantaController@destroy', $i->codice_pianta) }}" method="POST">
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
