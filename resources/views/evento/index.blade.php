@extends('layouts.app')

@section('content')
<div class="container col-md-8">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Eventi') }}</div>
                    <div class="card-body">
                        @foreach($eventi as $evento)
                            @include('evento.eventopost')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection