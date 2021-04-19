@extends('layouts.app')

@section('content')
<div class="m-2">
    <a href="{{route('resultados')}}">
        <button class="btn btn-primary">Voltar</button>
    </a>
</div>
<div class="container mx-auto">
    <h4 class="mt-5 mb-5 text-center text-uppercase">VENCEDORES DO EVENTO {{$projeto->nome}}:</h4>

    <table class="table table-striped table-hover mt-5">
            <thead class="bg-dark text-light">
                <tr>
                    <th>NOME DA CATEGORIA</th>
                    <th>VENCEDOR</th>
                    <th>QUANTIDADE DE VOTOS</th>
                    <th>PORCENTAGEM DE VOTOS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $cat)
                <tr>
                    <td scope="col">{{$cat->nome}}</td>
                    @foreach ($maisVotados as $maisVotado)
                        @if($maisVotado->categoria_id == $cat->id)
                            @php
                                $vencedor = $maisVotado
                            @endphp
                        @endif
                    @endforeach
                    <td scope="col">{{$vencedor->titulo}}</td>
                    <td scope="col">{{$vencedor->qtdVotos}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    <h4 class="mt-5 mb-5 text-center text-uppercase">RESULTADO GERAL DO EVENTO {{$projeto->nome}}:</h4>

    <table class="table table-striped table-hover mt-5">
        <thead class="bg-dark text-light">
            <tr>
                <th>TÍTULO</th>
                <th>CATEGORIA</th>
                <th>QUANTIDADE DE VOTOS</th>
                <th>PORCENTAGEM DE VOTOS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($maisVotados->sortBy('categoria_id') as $item)
            @if ($item->qtdVotos > 0)

            <tr>
                <td scope="col"> {{$item->titulo}}</td>
                <td scope="col">{{$cat->nome}}</td>
                <td scope="col">{{$item->qtdVotos}}</td>
                @php
                    $candidatosCategoria = $maisVotados->where('categoria_id', $item->categoria_id);
                    $votosPorCategoria = 0;
                @endphp

                @foreach ($candidatosCategoria as $cand)
                        @php $votosPorCategoria += $cand->qtdVotos; @endphp
                @endforeach
                <td>{{round($item->qtdVotos * 100 / $votosPorCategoria)}}% dos votos</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>


@endsection
