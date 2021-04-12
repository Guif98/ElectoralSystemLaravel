@extends('layouts.app')

@section('content')
<div class="m-2">
    <a href="{{route('home')}}">
        <button class="btn btn-primary">Voltar</button>
    </a>
</div>
<div class="container mx-auto">
    <h4 class="mt-5 mb-5 text-center">RESULTADOS DE TODOS OS EVENTOS:</h4>

    @foreach ($projetos as $projeto)
        <a class="text-decoration-none" href="{{route('resultadoView', $projeto->id)}}">
            <div class="resultado-div bg-secondary text-light text-center text-uppercase">{{$projeto->nome}}</div>

        </a>
    @endforeach
</div>


@endsection
