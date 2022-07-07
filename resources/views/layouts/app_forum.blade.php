<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    @yield('css')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="icon" href="{{ asset('immagini/PLANTGRAM.png') }}" type="image/x-icon"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Ploty -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('immagini/logoPLANTGRAM5.png') }}" width="30" height="30" alt="" loading="lazy">
                </a>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if(Auth::user())
                            @if(Auth::user()->admin==='AD')
                            <!-- Se sei admin -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ URL::action('UserController@index')}}">{{ __('Utenti') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ URL::action('PiantaController@index')}}">{{ __('Piante') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ URL::action('PubblicitaController@index')}}">{{ __('Pubblicita') }}</a>
                                </li>

                            @endif
                            <!-- Se sei user normale -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::action('SerraController@index')}}">{{ __('Serra') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::action('ChatterController@index')}}">{{ __('Forum del vicinato') }}</a>
                            </li>

                        @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                    <?php
                                        echo '<img class="thumb" src="data:image/jpeg;base64,'.base64_encode(Auth::user()->foto).'" class="card-img-top"/>';
                                    ?>



                                    {{ Auth::user()->nickname }} <span class="caret"></span>

                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ URL::action('UserController@edit', Auth()->id()) }}">Modifica profilo</a>
                                    @if($post->user->admin != "pro")
                                        <a class="dropdown-item" href="{{ URL::action('UserController@upgrade', $post->user->id) }}" class="btn btn-success"><button class="btn btn-success">Esegui l'upgrade a PRO</button></a>
                                    @else
                                        <p class="dropdown-item" style="color: gold; font-weight: bold;">Sei un utente PRO</p>
                                    @endif

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
</html>
