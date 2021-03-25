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

    <div>
        <h2 class="text-center mt-3">Lista de projetos</h2>
    </div>
    <div class="mx-auto mt-5 text-center">
        <a href="{{url('novoProjeto')}}">
            <button class="btn btn-success mt-5">Criar Projeto</button>
        </a>
    </div>
<table id="lg-table-projetos" class=" w-75 mt-5 table table-dark mx-auto">
    <thead>
      <tr>
        <th scope="col">Nome do Projeto</th>
        <th scope="col">Data de Início</th>
        <th scope="col">Data do Fim</th>
        <th scope="col">Ativo</th>
        <th scope="col" colspan="3">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($projetos as $projeto)
        <tr>
            <td class="w-25"><a style="color: aqua" href="{{url("subprojetos/$projeto->id")}}" class="text-decoration-none">{{$projeto->nome}}</a></td>
            <td class="w-25">{{date('d/m/Y', strtotime($projeto->dataInicio))}}</td>
            <td class="w-25">{{date('d/m/Y', strtotime($projeto->dataFim))}}</td>
            @if ($projeto->ativo == 1)<td class="w-25">Ativo</td> @else <td class="w-25">Inativo</td>@endif
            <td class="w-75">
                <div class="d-inline-flex justify-content-around">
                    <a class="text-decoration-none pr-2" href="{{url("projetos/$projeto->id/edit")}}">
                        <button class="btn btn-outline-primary">Editar</button>
                    </a>
                    <a class="text-decoration-none pr-2" href="{{url("categorias/$projeto->id")}}">
                        <button class="btn btn-outline-warning">Categorias</button>
                    </a>
                    <a class="text-decoration-none pr-2" onclick="return confirm('Deseja realmente excluir esse projeto?')" href="{{url("projetos/delete/$projeto->id")}}">
                        <button class="btn btn-outline-danger">Excluir</button>
                    </a>
                </div>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <table id="little-table-projetos" class="table mt-5 mx-auto w-50 table-hover table-dark">
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
            <td class="p-2 buttons">
                    <a class="text-decoration-none" href="{{url("projetos/$projeto->id/edit")}}">
                        <button class="btn btn-sm btn-outline-primary">Editar</button>
                    </a>
                    <a class="text-decoration-none" href="{{url("categorias/$projeto->id")}}">
                        <button class="btn btn-sm btn-outline-warning">Categorias</button>
                    </a>
                    <a class="text-decoration-none" onclick="return confirm('Deseja realmente excluir esse projeto?')" href="{{url("projetos/delete/$projeto->id")}}">
                        <button class="btn btn-sm btn-outline-danger">Excluir</button>
                    </a>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <table id="tiny-table-projetos" class="table mt-5 mx-auto w-100 table-hover table-dark">
    <thead>
      <tr>
        <th scope="col">Nome do Projeto</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($projetos as $projeto)
        <tr>
            <td class="w-50"><a style="color: aqua" href="{{url("subprojetos/$projeto->id")}}" class="text-decoration-none">{{$projeto->nome}}</a></td>
            <td class="w-50">
                <div class=" d-inline-flex">
                    <a class="text-decoration-none mr-2" href="{{url("projetos/$projeto->id/edit")}}">
                        <button class="btn btn-sm btn-outline-primary">Editar</button>
                    </a>
                    <a class="text-decoration-none mr-2" href="{{url("categorias/$projeto->id")}}">
                        <button class="btn btn-sm btn-outline-warning">Categorias</button>
                    </a>
                    <a class="text-decoration-none" onclick="return confirm('Deseja realmente excluir esse projeto?')" href="{{url("projetos/delete/$projeto->id")}}">
                        <button class="btn btn-sm btn-outline-danger">Remover</button>
                    </a>
                </div>

            </td>
        </tr>
      @endforeach
    </tbody>
  </table>

@endsection

