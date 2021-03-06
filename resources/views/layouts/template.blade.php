<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ config('app.name', 'SISVOTE') }} </title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm container-fluid">

        <a class="navbar-brand" href="{{ route('home') }}">
            {{ config('app.name', 'SISVOTE') }}
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



            <ul class="navbar-nav ml-auto d-none d-lg-block d-xl-block">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('home')}}">{{__('Ir para votos')}}</a>
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
            </ul>
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>



      </nav>
      @yield('content')
    <script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sigepro.js')}}" defer></script>
    <script src="{{ asset('js/lightbox.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/loader.js')}}"></script>
</body>
</html>
