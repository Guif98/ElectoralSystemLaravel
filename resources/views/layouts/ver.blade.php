@extends('layouts.template')

@section('content')
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
                @foreach ($fotos as $foto)
                    <img style="width: 200px; height: 200px;" src="{{url("/storage/app/fotos/$foto->foto")}}" bigimage="{{url("/storage/app/fotos/$foto->foto")}}" alt="image">
                @endforeach
            </div>

        </div>
    </div>

@endsection


