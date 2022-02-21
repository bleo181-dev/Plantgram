
@extends('layouts.app')

@section('content')
@if(Auth::user()->admin==='AD')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('tutti gli utenti') }}</div>

                <div class="card-body">
                    <div style="padding: 10px;">
                            <a href="{{ URL::action('UserController@create') }}" class="btn btn-success"> Nuovo utente</a>
                        </div>
                    <table class = "col-md-12">
                        <thead>
                            <tr>
                                <th>Codice utente</th>
                                <th>Nickname</th>
                                <th>E-mail</th>
                                <th>Foto</th>
                                <th>isAdmin</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $i)
                                <tr>
                                    <td>{{ $i->id }}</td>
                                    <td>{{ $i->nickname }}</td>
                                    <td>{{ $i->email }}</td>
                                    <td>
                                        <div style="height: 30px; width: 30px;">
                                            <?php

                                            echo '<img src="data:image/jpeg;base64,'.base64_encode($i->foto).'" class="card-img-top"/>';

                                            ?>
                                        </div>
                                    </td>
                                    <td>{{ $i->admin }}</td>
                                    <td>
                                        <a href="{{ URL::action('UserController@edit', $i->id) }}" class="btn btn-primary" > Modifica </a>
                                        <a href="{{ route('pianta.index') }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{$i->id}}').submit();" class="btn btn-danger"> Elimina </a>
                                    </td>
                                    <form id="delete-form-{{$i->id}}" action="{{ URL::action('UserController@destroy', $i->id) }}" method="POST">
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
