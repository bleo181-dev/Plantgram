@extends('layouts.app_lending')

@section('content')
<div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active" data-interval="6000">

            <img src="/immagini/1.jpg" class="card-img">
            <div class="card-img-overlay text-center">
              <a class="btn btn-primary btn-lg" href="/register" role="button">Registrati ora</a>
          </div>
      </div>
      <div class="carousel-item" data-interval="4000">
        <img src="/immagini/2.jpg" class="d-block w-100">
      </div>
      <div class="carousel-item">
        <img src="/immagini/3.jpg" class="d-block w-100">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Prenditi cura delle tue piante con semplicità</h1>
      <p class="lead">Crea la tua serra virtuale, aggiungi le tue piante ed il gioco è fatto!</p>
      <p>Non lasciare mai più sola la tua pianta...</p>
      <a class="btn btn-primary btn-lg" href="/register" role="button">Registrati ora</a>
    </div>
  </div>

  <div class="container">
    <div class="media">
        <img src="/immagini/mini.jpg" class="mr-3" alt="...">
        <div class="media-body">
          <h5 class="mt-0">Media heading</h5>
          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

          <div class="media mt-3">
            <a class="mr-3">
              <img src="/immagini/mini.jpg" class="mr-3" alt="...">
            </a>
            <div class="media-body">
              <h5 class="mt-0">Media heading</h5>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection
