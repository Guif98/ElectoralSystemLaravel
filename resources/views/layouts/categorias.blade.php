@extends('layouts.template')

@if (session('message'))
 <div class="text-center m-auto p-3 alert-{{session('msg-type')}}">
    <p>{{session('message')}}</p>
 </div>
 @endif

 <input type="hidden" name="projeto_id" id="projeto_id" value="{{ request()->route('projeto_id') }}">
    @php $projeto_id = request()->route('projeto_id'); @endphp

<div class="container col-lg-auto col-md-auto col-sm-auto">
    <div class="m-auto mt-5">
        <h2 class="text-center">Lista de Categorias</h2>
    </div>
    <div class="m-auto mt-5 text-center col-lg-12 col-md-10 col-sm-2">
        <a class="text-decoration-none" href="{{url("categorias/$projeto_id/criar")}}">
            <button class="btn btn-success">Criar Categorias</button>
        </a>
        <a class="text-decoration-none" href="{{url('/')}}">
            <button class="btn btn-secondary">Voltar</button>
        </a>
    </div>
<table class="table mt-5 table-hover table-responsive-lg table-responsive-md table-responsive-sm">
    <thead>
      <tr>
        <th scope="col">Nome da Categoria</th>
        <th scope="col">Projeto da Categoria</th>
        <th scope="col">Id do Projeto da Categoria</th>
        <th scope="col" colspan="2">Ações</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($categorias as $categoria)
            <tr>
                <td>{{$categoria->nome}}</td>
                <td>{{$projeto->nome}}</td>
                <td>{{$categoria->projeto_id}}</td>
                <td>
                    <div class="d-inline-flex">
                        <a class="text-decoration-none" href="{{url("/categorias/$categoria->projeto_id/edit/$categoria->id")}}">
                            <button class="btn btn-sm btn-outline-primary">Editar</button>
                        </a>
                        <a onclick="return confirm('Deseja realmente apagar esta categoria?')" class="text-decoration-none" href="{{url("/categorias/delete/$categoria->id")}}">
                            <button class="btn btn-sm btn-outline-danger">Excluir</button>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
