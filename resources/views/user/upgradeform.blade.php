
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Esegui upgrade a PRO') }}</div>

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

                    <form action="{{ URL::action('UserController@storeupgrade', $utente->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PATCH')
                        <h1>Vuoi essere un agricoltore PRO?</h1>
                        <p>Oltre a sostenere la piattaforma sbloccherai vantaggi come una capienza quasi illimitata per tua serra così potrai curare tutte le piante che vorrai.
                            L'upgrade è per sempre
                        </p>
                        
                        <div class="col-md-6">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" value="si" name="scelta">SI
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" value="no" name="scelta">NO
                                </label>
                            </div>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-success" value="Conferma e paga" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
