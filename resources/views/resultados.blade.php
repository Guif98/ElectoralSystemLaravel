@extends('layouts.app')
@section('content')
<div class="mx-auto">
    <div class="m-2">
        <a href="{{route('home')}}">
            <button class="btn btn-primary">Voltar</button>
        </a>
    </div>

    @if (isset($title))
        <div class="text-center m-auto p-4 alert-warning w-75 rounded">
            <p class="text-uppercase font-weight-bold">{{$title}}</p>
            <p class="font-weight-bold">Abaixo encontram-se os resultados de todos os eventos realizados</p>
        </div>
    @endif

    <div class="col-md-12  col-sm-auto mx-auto">
        <h4 class="mt-5 mb-5 text-center">RESULTADOS DE TODOS OS EVENTOS:</h4>

        @if ($projetos->where('exibirResultado', 1)->count() == 0)
            <div class="alert-warning p-5 text-center">Ainda não há nenhum resultado de evento divulgado!</div>
        @endif

        @foreach ($projetos->sortByDesc('dataResultado') as $projeto)
            <a class="text-decoration-none" href="{{route('resultadoView', $projeto->id)}}">
                <div class="resultado-div bg-secondary text-light text-center text-uppercase">{{$projeto->nome}}</div>
            </a>
        @endforeach
    </div>
</div>


@endsection
