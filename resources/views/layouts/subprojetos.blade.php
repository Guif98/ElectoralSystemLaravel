@extends('layouts.template')

@section('content')



@if (session('message'))
 <div class="text-center m-auto p-3 alert-{{session('msg-type')}}">
    <p>{{session('message')}}</p>
 </div>
 @endif

 <input type="hidden" name="projeto_id" id="projeto_id" value="{{ request()->route('projeto_id') }}">
    @php $projeto_id = request()->route('projeto_id'); @endphp

<div class="mt-5 container-fluid">
    <div class="m-auto mt-5">
        <h2 class="text-center">Lista de SubProjetos</h2>
    </div>
    <div class="mx-auto mt-5 text-center">
        <a class="text-decoration-none" href="{{url("subprojetos/$projeto_id/formProjeto")}}">
            <button class="btn btn-success">Criar SubProjeto</button>
        </a>
        <a class="text-decoration-none" href="{{url("/")}}">
            <button class="btn btn-danger">Voltar Para Projetos</button>
        </a>
    </div>
<table id="xl-table-subprojetos" class="table text-center mt-5 table-hover table-dark table-striped">
    <thead>
      <tr>
        <th scope="col">Título</th>
        <th scope="col">Categoria</th>
        <th scope="col">Descricao</th>
        <th scope="col">Integrantes</th>
        <th class="w-50" scope="col">Fotos</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($subProjetos as $subProjeto)
      @php
            $fotos = $subProjeto->find($subProjeto->id)->relFotos;
      @endphp
        <tr>
            <td>{{$subProjeto->titulo}}</td>
            <td>{{$subProjeto->relCategorias->nome}}</td>
            <td>{{$subProjeto->descricao}}</td>
            <td>{{$subProjeto->integrantes}}</td>
            <td>@foreach ($fotos as $foto)
                <img style="width: 100px; height: 100px;" src="{{url("/storage/app/fotos/$foto->foto")}}"  alt="image">
              @endforeach
            </td>
            <td>
                <div role="group" class=" btn-group pull-right">
                    <a href="{{url("/subprojetos/$subProjeto->projeto_id/edit/$subProjeto->id")}}">
                        <button class="btn btn-outline-primary btn-sm">Editar</button>
                    </a>
                    <a href="{{url("/subprojetos/$subProjeto->projeto_id/addFoto/$subProjeto->id")}}">
                        <button class="btn btn-outline-success btn-sm">+Fotos</button>
                    </a>
                    <a href="{{url("/subprojetos/$subProjeto->id/delete")}}" onclick="return confirm('Deseja realmente excluir esse projeto?')">
                        <button class="btn btn-outline-danger btn-sm">Excluir</button>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>


  <table id="lg-table-subprojetos" class="table mt-5 table-hover w-75 mx-auto table-dark table-striped">
    <thead>
      <tr>
        <th scope="col">Título</th>
        <th scope="col">Categoria</th>
        <th scope="col">Descricao</th>
        <th scope="col">Integrantes</th>
        <th scope="col" colspan="2">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($subProjetos as $subProjeto)
        <tr>
            <td>{{$subProjeto->titulo}}</td>
            <td>{{$subProjeto->relCategorias->nome}}</td>
            <td>{{$subProjeto->descricao}}</td>
            <td>{{$subProjeto->integrantes}}</td>
            <td>
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row">
                        <a href="{{url("/subprojetos/$subProjeto->projeto_id/edit/$subProjeto->id")}}">
                            <button class="btn btn-outline-primary btn-sm">Editar</button>
                        </a>
                        <a href="{{url("/subprojetos/$subProjeto->projeto_id/addFoto/$subProjeto->id")}}">
                            <button class="btn btn-outline-success btn-sm">+Fotos</button>
                        </a>
                    </div>

                    <div class="d-flex flex-row">
                        <a href="{{url("/subprojetos/$subProjeto->id/delete")}}" onclick="return confirm('Deseja realmente excluir esse projeto?')">
                            <button class="btn btn-outline-danger btn-sm">Excluir</button>
                        </a>
                        <a href="{{url("/subprojetos/$subProjeto->projeto_id/ver/$subProjeto->id")}}">
                            <button class="btn btn-outline-secondary btn-sm">Ver</button>
                        </a>
                    </div>

                </div>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>


  <table id="medium-table-subprojetos" class="table mt-5 w-50 mx-auto table-dark table-hover table-striped">
    <thead>
      <tr>
        <th scope="col">Título</th>
        <th scope="col">Categoria</th>
        <th scope="col" colspan="4">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($subProjetos as $subProjeto)
      @php
            $fotos = $subProjeto->find($subProjeto->id)->relFotos;
      @endphp
        <tr>
            <td>{{$subProjeto->titulo}}</td>
            <td>{{$subProjeto->relCategorias->nome}}</td>
            <td>
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row">
                        <a class="flex-fill" href="{{url("/subprojetos/$subProjeto->projeto_id/edit/$subProjeto->id")}}">
                            <button class="btn btn-outline-primary btn-sm">Editar</button>
                        </a>
                        <a href="{{url("/subprojetos/$subProjeto->projeto_id/addFoto/$subProjeto->id")}}">
                            <button class="btn btn-outline-success btn-sm">+Fotos</button>
                        </a>
                    </div>

                    <div class="d-flex flex-row">
                        <a href="{{url("/subprojetos/$subProjeto->id/delete")}}" onclick="return confirm('Deseja realmente excluir esse projeto?')">
                            <button class="btn btn-outline-danger btn-sm">Excluir</button>
                        </a>
                        <a href="{{url("/subprojetos/$subProjeto->projeto_id/ver/$subProjeto->id")}}">
                            <button class="btn btn-outline-secondary btn-sm">Ver</button>
                        </a>
                    </div>
                </div>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <table id="little-table-subprojetos" class="table mt-5 mx-auto w-75 table-dark table-hover table-striped">
    <thead>
      <tr>
        <th scope="col">Título</th>
        <th class="w-100 text-center" scope="col" colspan="4">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($subProjetos as $subProjeto)
        <tr>
            <td>{{$subProjeto->titulo}}</td>
            <td>
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-center">
                        <a href="{{url("/subprojetos/$subProjeto->projeto_id/edit/$subProjeto->id")}}">
                            <button class="btn btn-outline-primary btn-sm">Editar</button>
                        </a>
                        <a href="{{url("/subprojetos/$subProjeto->projeto_id/addFoto/$subProjeto->id")}}">
                            <button class="btn btn-outline-success btn-sm">+Fotos</button>
                        </a>
                    </div>
                    <div class="d-flex flex-row justify-content-center">
                        <a href="{{url("/subprojetos/$subProjeto->id/delete")}}" onclick="return confirm('Deseja realmente excluir esse projeto?')">
                            <button class="btn btn-outline-danger btn-sm ">Excluir</button>
                        </a>
                        <a href="{{url("/subprojetos/$subProjeto->projeto_id/ver/$subProjeto->id")}}">
                            <button class="btn btn-outline-secondary btn-sm">Ver</button>
                        </a>
                    </div>

                </div>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>



</div>

@endsection
