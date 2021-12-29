@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">{{ __('la mia serra') }}</div>

                <div class="card-body">
                    <div class="row">
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