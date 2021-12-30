
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tutte le piante') }}</div>
                    <div style="padding: 10px;"> 
                        <a href="{{ URL::action('BisognoController@create', $codice_pianta) }}" class="btn btn-success"> Crea bisogno</a>
                    </div>
                <div class="card-body">

                    <table>
                        <thead>
                            <tr>
                                <th>Codice Pianta</th>
                                <th>Nome</th>
                                <th>Cadenza</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bisogni as $i)
                                <tr>
                                    <td>{{ $i->codice_pianta }}</td>
                                    <td>{{ $i->nome }}</td>
                                    <td>{{ $i->cadenza }}</td>
                                    <td>
                                        <a href="{{ URL::action('BisognoController@edit', $i->codice_bisogno) }}" class="btn btn-primary" > Modifica </a>
                                        <a href="{{ URL::action('BisognoController@index', $i->codice_pianta) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{$i->codice_bisogno}}').submit();" class="btn btn-danger"> Elimina </a>
                                    </td>
                                    <form id="delete-form-{{$i->codice_bisogno}}" action="{{ URL::action('BisognoController@destroy', $i->codice_bisogno) }}" method="POST">
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
