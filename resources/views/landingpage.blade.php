@extends('layouts.app_landing')

@section('content')
<div id="imm_p" class="carousel active">
    <img src="{{ asset('immagini/1.jpg') }}" style="filter:  sepia(92%) saturate(557%) hue-rotate(71deg) brightness(30%) contrast(83%);" class="card-img">
    <div class="card-img-overlay centered" style="
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);">
        <h1 style="font-size: 10vw; color: white;"> {{ config('app.name', 'Laravel') }}</h1>
        <a class="btn btn-success btn-lg " style="width:100%; font-size:25px" href="{{ asset('register') }}" >Registrati</a>
    </div>
</div>

  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Prenditi cura delle tue piante con semplicità</h1>
      <p class="lead">Crea la tua serra virtuale, aggiungi le tue piante ed il gioco è fatto!</p>
      <p>Non lasciare mai più sola la tua pianta...</p>
    </div>
  </div>

  <div id="container" class="container">
    <div class="media">
        <div class="media-body">
          <h5 class="mt-0" style="color: white">Rilassati</h5>
          <p style="color: white">
            Penseremo noi a ricordarti quando le tue piante avranno bisogno del tuo aiuto. 
            Nel frattempo tu potrai tenere traccia dei progressi di crescita nel loro diario personale
          </p>

          <div class="media mt-3">
            <a class="mr-3">
            </a>
            <div class="media-body">
              <h5 class="mt-0" style="color: white">Non sei da solo</h5>
              <p style="color: white">
                Unisciti alla grande famiglia di agricolotori e non che si scambiano consigli e trucchetti nel forum del buon vicinato. 
                Vieni a scoprirlo, ti aspettiamo!
              </p>
            </div>
          </div>
        </div>
      </div>
  </div>

  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h2>Fatti aiutare da un amico</h2>
      <p class="lead">
        Hai un piccolo orticello in comune con qualcuno o devi allontanarti dal tuo angolo verde per un pò?
        Incarica una persona di cui ti fidi come collaboratore della serra per avere un aiuto extra nel momento del bisogno
      </p>
    </div>
  </div>

  <div class=" text-center">
    <h1 style="font-size: 10vw; color: white"> {{ config('app.name', 'Laravel') }} </h1>
    <a class="btn btn-success btn-lg " style="width:80%; font-size:40px" href="{{ asset('register') }}" >Registrati ora</a>
  </div>
  <br>

  <script src="{{ asset('js/animation.js') }}"></script>

@endsection
