@extends('layouts.app')

@section('content')
<div class="m-2">
    <a href="{{route('resultados')}}">
        <button class="btn btn-primary">Voltar</button>
    </a>
</div>
<div class="container mx-auto">
    <h4 class="mt-5 mb-5 text-center text-uppercase">VENCEDORES DO EVENTO {{$projeto->nome}}:</h4>

    @foreach ($categorias as $categoria)
        <table class="table table-striped table-hover mt-5">
            <thead class="bg-dark text-light">
                <tr>
                    <th>NOME DA CATEGORIA</th>
                    <th>VENCEDOR</th>
                    <th>QUANTIDADE DE VOTOS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="col">{{$categoria->nome}}</td>
                    @foreach ($vencedor->where('categoria_id', $categoria->id) as $v)
                        @if ($loop->first)
                            <td scope="col">{{$v->titulo}}</td>
                            <td scope="col">{{$v->qtdVotos}}</td>
                        @endif

                    @endforeach
                </tr>
            </tbody>
        </table>

    @endforeach

</div>


@endsection
