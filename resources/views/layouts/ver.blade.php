@extends('layouts.template')

@section('content')

    <div class="mx-auto mt-5 text-center">
        @php $projeto_id = request()->route('projeto_id'); @endphp
        <a href="{{url("subprojetos/$projeto_id")}}">
            <button class="btn btn-primary btn-lg">Voltar</button>
        </a>
    </div>

    <div class="container mt-5 mx-auto mb-5">
        <div>
            <h3><b>Id: </b> {{$subProjeto->id}}</h3>
        </div>
        <div>
            <h3><b>Título: </b> {{$subProjeto->titulo}}</h3>
        </div>
        <div>
            <h3><b>Projeto em que faz parte: </b>{{$subProjeto->relProjeto->nome}}</h3>
        </div>
        <div>
            <h3><b>Categoria em que faz parte:</b> {{$subProjeto->relCategorias->nome}}</b></h3>
        </div>
        <div>
            <h3><b>Descrição: </b>{{$subProjeto->descricao}}</h3>
        </div>
        <div>
            <h3><b>Integrantes: </b>{{$subProjeto->integrantes}}</h3>
        </div>
        <div>
            <h3><b>Fotos do Projeto: </b></h3>
            <div class="mt-5 mx-auto">
                @php
                    $fotos = $subProjeto->find($subProjeto->id)->relFotos;
                @endphp
                <ul class="list-unstyled d-flex flex-wrap justify-content-around text-center">
                    @foreach ($fotos as $foto)
                    <li class="mt-3">
                        <img style="width: 98%; height: 100%;" src="{{url("/storage/fotos/$foto->foto")}}" bigimage="{{url("/storage/app/fotos/$foto->foto")}}" alt="image">
                    </li>
                    @endforeach
                </ul>

            </div>

        </div>
    </div>

@endsection


