@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">{{ __('la mia serra') }}</div>

                <div class="card-body">
                    <div style="padding: 10px;">
                        <a href="{{ URL::action('PiantaController@create') }}" class="btn btn-success"> Nuova pianta</a>
                    </div>
                    <div class="row" style="width: 400px;">
                        @foreach($piante as $pianta)
                            @include('piantapost')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
