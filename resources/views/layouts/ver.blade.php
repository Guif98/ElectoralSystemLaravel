@extends('layouts.template')

@section('content')
    <div class="container mt-5 mx-auto">
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
            <div>
                @php
                    $fotos = $subProjeto->find($subProjeto->id)->relFotos;
                @endphp
                @foreach ($fotos as $foto)
                    <a data-toggle="modal" href="#modalSubProjeto"><img style="width: 200px; height: 200px;" src="{{url("/storage/app/fotos/$foto->foto")}}" bigimage="{{url("/storage/app/fotos/$foto->foto")}}" alt="image"></a>
                @endforeach
            </div>

        </div>
    </div>

    <div id="modalSubProjeto" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <img id="image" src="" alt="">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary">Save changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

@endsection


