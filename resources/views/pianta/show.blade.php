
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
                                <tr>
                                    <td>{{ $pianta->codice_pianta }}</td>
                                    <td>{{ $pianta->codice_serra }}</td>
                                    <td>{{ $pianta->nome }}</td>
                                    <td>{{ $pianta->foto }}</td>
                                    <td>{{ $pianta->luogo }}</td>
                                    <td>
                                        <a href="{{ URL::action('DiarioController@index', $pianta->codice_pianta) }}" class="btn btn-info" > Diario </a>
                                        <a href="{{ URL::action('BisognoController@index', $pianta->codice_pianta) }}" class="btn btn-primary" > Bisogni </a>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
