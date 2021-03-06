@extends('layouts.app')

@section('content')
<div class="m-2">
    <a href="{{route('resultados')}}">
        <button class="btn btn-primary">Voltar</button>
    </a>
</div>
@if($projeto->exibirResultado == 0)
<div id="evento-alert" class="alert alert-warning alert-dismissible text-center p-5 m-5" role="alert">
    <h4>Essa votação não pode ser exibida, pois ainda está em andamento!</h4>
</div>
@else
<div class="container-fluid ml-md-auto col-xl-10 col-sm-8  overflow-auto p-2">
    <h4 class="mt-5 mb-5 text-center text-uppercase">VENCEDORES DO EVENTO {{$projeto->nome}}:</h4>

    <table class="table table-striped mx-auto table-hover mt-5">
            <thead class="bg-dark text-light">
                <tr>
                    <th>NOME DA CATEGORIA</th>
                    <th>VENCEDOR</th>
                    <th>QUANTIDADE DE VOTOS</th>
                    <th>PORCENTAGEM DE VOTOS</th>
                </tr>
            </thead>
            <tbody>
    @foreach ($categorias as $categoria)
        @php
            $count = 0;
        @endphp

        @foreach ($maisVotados->where('categoria_id', $categoria->id) as $votoPorCategoria)
                @php
                    $count += $votoPorCategoria->qtdVotos;
                @endphp
        @endforeach


        @foreach ($maisVotados->where('categoria_id', $categoria->id)->sortByDesc('qtdVotos') as $item)

            @if($loop->first)
                <tr>

                    <td scope="col">{{$categoria->where('id', $item->categoria_id)->first()->nome}}</td>
                    <td>{{$item->titulo}}</td>
                    <td>{{$item->qtdVotos}}</td>
                    <td>{{round($item->qtdVotos * 100 / $count)}}%</td>
                </tr>
                @endif
        @endforeach
    @endforeach
            </tbody>
        </table>
</div>

<div class="container ml-sm-2 ml-md-auto col-xl-10 col-sm-8 p-2 overflow-auto mb-5 pb-5">

    <h4 class="mt-5 mb-5 text-center text-uppercase">RESULTADO GERAL DO EVENTO {{$projeto->nome}}:</h4>

    <table class="table table-striped table-hover mt-5 mb-5">
        <thead class="bg-dark text-light">
            <tr>
                <th>TÍTULO</th>
                <th>CATEGORIA</th>
                <th>QUANTIDADE DE VOTOS</th>
                <th>PORCENTAGEM DE VOTOS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $cat)
            @endforeach
            @foreach ($maisVotados->where('projeto_id', $projeto->id)->sortBy('categoria_id') as $item)
            @if ($item->qtdVotos > 0)
            <tr>
                <td scope="col"> {{$item->titulo}}</td>
                <td scope="col">{{$cat->where('id', $item->categoria_id)->first()->nome}}</td>
                <td scope="col">{{$item->qtdVotos}}</td>
                @php
                    $candidatosCategoria = $maisVotados->where('categoria_id', $item->categoria_id);
                    $votosPorCategoria = 0;
                @endphp

                @foreach ($candidatosCategoria as $cand)
                        @php $votosPorCategoria += $cand->qtdVotos; @endphp
                @endforeach
                <td>{{round($item->qtdVotos * 100 / $votosPorCategoria)}}%</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
@endif


@endsection
