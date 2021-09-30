<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="grecaptcha-key" content="{{config('recaptcha.v3.public_key')}}">


    <title>{{ config('app.name', 'SISVOTE') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sigepro.js')}}" defer></script>
    <script src="{{ asset('js/lightbox.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    @if (Auth::check())
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{route('home')}}">
                    {{ config('app.name', 'SIGEPRO') }}
                </a>

                <div class="collapse ml-auto col-12" id="navbarSupportedContent">
                    <div class="bg-dark p-4">
                        <ul class="list-unstyled">
                            <li class="p-3">
                                <a class="text-light" href="{{route('home')}}">{{__('Ir para votos')}}</a>
                            </li>
                            <li class="p-3">
                                <a class="text-light" href="{{route('projetos')}}">{{__('Ir para projetos')}}</a>
                            </li>
                            <li class="p-3">
                                <a class="text-light" href="{{route('resultados')}}">{{__('Ir para resultados')}}</a>
                            </li>
                            <li class="p-3">
                                <a class="text-light" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto d-none d-md-block d-lg-block d-xl-block">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('projetos')}}">{{__('Ir para projetos')}}</a>
                                    <a class="dropdown-item" href="{{route('resultados')}}">{{__('Ir para resultados')}}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    @endif
        <main class="m-0 p-0">
            @yield('content')
        </main>
    </div>
</body>
</html>
