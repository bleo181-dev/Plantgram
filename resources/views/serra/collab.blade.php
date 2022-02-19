
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Invio collaborazione') }}</div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ URL::action('SerraController@process_collab') }}" method="POST" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <h3> Fatti aiutare con la tua serra </h3>
                        <h6> Manda un invito di collaborazione </h6>

                        <input id="email" type="text" name="email" placeholder="xxxx@yyy.zz" value="{{ old('email') }}" /> <label> Email collaboratore </label>
                        <br>
                        <br>

                        <input type="submit" class="btn btn-primary" value="Spedisci invito" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
