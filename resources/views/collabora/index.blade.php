
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Serre a cui stai collaborando</div>

                <div class="card-body">

                    <table>
                        <thead>
                            <tr>
                                <th>Codice Serra</th>
                                <th>Nome Serra</th>
                                <th>Proprietario</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($serre_condivise as $i)
                                <tr>
                                    <td>{{ $i->codice_serra }}</td>
                                    <td>{{ $i->nome }}</td>
                                    <td>{{ $i->nickname }}</td>
                                    <td>

                                    </td>
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
