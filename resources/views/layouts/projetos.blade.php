@extends('layouts.template')

@section('content')


@guest
    <h1>Você não está logado</h1>
@endguest


@if (session('message'))
 <div class="text-center m-auto p-3 alert-{{session('msg-type')}}">
    <p>{{session('message')}}</p>
 </div>
 @endif


<div class="container">
    <div class="m-auto">
        <h2 class="text-center mt-3">Lista de projetos</h2>
    </div>
    <div class="m-auto mt-5 text-center">
        <a href="{{url('novoProjeto')}}">
            <button class="btn btn-success mt-5">Criar Projeto</button>
        </a>
    </div>
<table class="table mt-5 hidden table-responsive-lg table-responsive-md table-responsive-sm table-hover table-dark">
    <thead>
      <tr>
        <th scope="col">Nome do Projeto</th>
        <th scope="col">Data de Início</th>
        <th scope="col">Data do Fim</th>
        <th scope="col" colspan="3">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($projetos as $projeto)
        <tr>
            <td><a style="color: aqua" href="{{url("subprojetos/$projeto->id")}}" class="text-decoration-none">{{$projeto->nome}}</a></td>
            <td>{{date('d/m/Y', strtotime($projeto->dataInicio))}}</td>
            <td>{{date('d/m/Y', strtotime($projeto->dataFim))}}</td>
            <td class="p-2">
                <a class="text-decoration-none" href="{{url("projetos/$projeto->id/edit")}}">
                    <button class="btn btn-outline-primary">Editar</button>
                </a>
                <a class="text-decoration-none" href="{{url("categorias/$projeto->id")}}">
                    <button class="btn btn-outline-warning">Categorias</button>
                </a>
                <a class="text-decoration-none" onclick="return confirm('Deseja realmente excluir esse projeto?')" href="{{url("projetos/delete/$projeto->id")}}">
                    <button class="btn btn-outline-danger">Excluir</button>
                </a>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <table class="table mt-5 little-table table-responsive-lg table-responsive-md table-responsive-sm table-hover table-dark">
    <thead>
      <tr>
        <th scope="col">Nome do Projeto</th>
        <th scope="col" colspan="3">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($projetos as $projeto)
        <tr>
            <td><a style="color: aqua" href="{{url("subprojetos/$projeto->id")}}" class="text-decoration-none">{{$projeto->nome}}</a></td>
            <td class="p-2">
                <a class="text-decoration-none" href="{{url("projetos/$projeto->id/edit")}}">
                    <button class="btn btn-outline-primary">Editar</button>
                </a>
                <a class="text-decoration-none" href="{{url("categorias/$projeto->id")}}">
                    <button class="btn btn-outline-warning">Categorias</button>
                </a>
                <a class="text-decoration-none" onclick="return confirm('Deseja realmente excluir esse projeto?')" href="{{url("projetos/delete/$projeto->id")}}">
                    <button class="btn btn-outline-danger">Excluir</button>
                </a>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

