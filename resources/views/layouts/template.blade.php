<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIGEPRO</title>
    <link rel="stylesheet" href="{{url('css/app.css')}}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm container-fluid">
        <a class="navbar-brand" href="{{ url('/projetos') }}">
            {{ config('app.name', 'SIGEPRO') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

              <ul class="navbar-nav ml-auto">
                <div class="navbar-nav">
                    <li class="nav-item"><a class="nav-item nav-link" href="{{route('home')}}">Ir para votos<span class="sr-only">(Página atual)</span></a></li>
                    <li class="nav-item"><a class="nav-item nav-link" href="{{route('logout')}}">Sair</a></li>
                </div>
            </ul>

        </div>
      </nav>
      @yield('content')
      <script src="{{url('js/app.js')}}"></script>
      <script src="{{url('js/sigepro.js')}}"></script>
</body>
</html>
