
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tutte le piante') }}</div>

                <div class="card-body">
                    <a href="{{ URL::action('PiantaController@create') }}"> Nuova pianta</a>

                    <table>
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
                                    <td>{{ $i->Codice_pianta }}</td>
                                    <td>{{ $i->Codice_serra }}</td>
                                    <td>{{ $i->Nome }}</td>
                                    <td>{{ $i->Foto }}</td>
                                    <td>{{ $i->Luogo }}</td>
                                    <td>{{ $i->Stato }}</td>
                                    <td>
                                        <a href="{{ URL::action('PiantaController@edit', $i->Codice_pianta) }}" > Modifica </a>
                                        <a href="{{ route('pianta.index') }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{$i->Codice_pianta}}').submit();"> Elimina </a>
                                    </td>
                                    <form id="delete-form-{{$i->Codice_pianta}}" action="{{ URL::action('PiantaController@destroy', $i->Codice_pianta) }}" method="POST">
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
@endsection
