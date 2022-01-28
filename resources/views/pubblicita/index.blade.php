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
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection