@extends('layouts.template')

@if (session('message'))
 <div class="text-center m-auto p-3 alert-{{session('msg-type')}}">
    <p>{{session('message')}}</p>
 </div>
 @endif

 <input type="hidden" name="projeto_id" id="projeto_id" value="{{ request()->route('projeto_id') }}">
    @php $projeto_id = request()->route('projeto_id'); @endphp

<div class="container col-12">
    <div class="m-auto mt-5">
        <h2 class="text-center">Lista de SubProjetos</h2>
    </div>
    <div class="m-auto mt-5 text-center">
        <a class="text-decoration-none" href="{{url("subprojetos/$projeto_id/formProjeto")}}">
            <button class="btn btn-success">Criar SubProjeto</button>
        </a>
        <a class="text-decoration-none" href="{{url("/")}}">
            <button class="btn btn-danger">Voltar Para Projetos</button>
        </a>
    </div>
<table class="table mt-5 table-hover table-striped">
    <thead>
      <tr>
        <th scope="col">Título</th>
        <th scope="col">Categoria</th>
        <th scope="col">Descricao</th>
        <th scope="col">Integrantes</th>
        <th scope="col">Fotos</th>
        <th scope="col" colspan="3">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($subProjetos as $subProjeto)
      @php  $categoria=$subProjeto->find($subProjeto->id)->relCategorias;
            $fotos = $subProjeto->find($subProjeto->id)->relFotos;
      @endphp
        <tr>
            <td>{{$subProjeto->titulo}}</td>
            <td>{{$categoria->nome}}</td>
            <td>{{$subProjeto->descricao}}</td>
            <td>{{$subProjeto->integrantes}}</td>
            <td>@foreach ($fotos as $foto)
                <img style="width: 100px; height: 100px;" class="d-inline-flex" src="{{url("/storage/app/fotos/$foto->foto")}}"  alt="image">
            @endforeach
            <td>
                <div class="d-lg-inline-flex">
                    <a class="flex-fill" href="{{url("/subprojetos/$subProjeto->projeto_id/edit/$subProjeto->id")}}">
                        <button class="btn btn-primary btn-sm">Editar</button>
                    </a>
                    <a href="{{url("/subprojetos/$subProjeto->projeto_id/addFoto/$subProjeto->id")}}">
                        <button class="btn btn-success btn-sm">+Fotos</button>
                    </a>
                    <a href="{{url("/subprojetos/$subProjeto->id/delete")}}" onclick="return confirm('Deseja realmente excluir esse projeto?')">
                        <button class="btn btn-danger btn-sm">Excluir</button>
                    </a>
                </div>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
