@extends('layouts.app_landing')

@section('content')
<div id="imm_p" class="carousel active">
    <img src="{{ asset('immagini/1.jpg') }}" class="card-img">
    <div class="card-img-overlay text-center">
        <h1 style="font-size: 10vw; color: white"> {{ config('app.name', 'Laravel') }} </h1>
        <a class="btn btn-primary btn-lg" href="{{ asset('register') }}" >Registrati ora</a>
    </div>
</div>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Prenditi cura delle tue piante con semplicità</h1>
      <p class="lead">Crea la tua serra virtuale, aggiungi le tue piante ed il gioco è fatto!</p>
      <p>Non lasciare mai più sola la tua pianta...</p>
      <a class="btn btn-primary btn-lg" href="{{ asset('register') }}" role="button">Registrati ora</a>
    </div>
  </div>

  <div id="container" class="container">
    <div class="media">
        <img src="{{ asset('immagini/mini.jpg') }}" class="mr-3" alt="...">
        <div class="media-body">
          <h5 class="mt-0" style="color: white"">Media heading</h5>
          <p style="color: white">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>

          <div class="media mt-3">
            <a class="mr-3">
              <img src="{{ asset('immagini/mini.jpg') }}" class="mr-3" alt="...">
            </a>
            <div class="media-body">
              <h5 class="mt-0" style="color: white">Media heading</h5>
              <p style="color: white">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
            </div>
          </div>
        </div>
      </div>
  </div>

  <br>
  <br>
  <br>
  <br>
  <br>

  <script src="{{ asset('js/animation.js') }}"></script>

@endsection
