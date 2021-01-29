@extends('layouts.template')

<div class="container mt-5 col-8">
@if (isset($projeto))
<form name="formEdit" id="formEdit" action="{{url("projetos/$projeto->id")}}" class="m-auto col-6" method="POST">
    @method('patch')
@else
<form name="formCriar" id="formCriar" action="{{url('projetos')}}" class="m-auto col-6" method="POST">
    @method('POST')
@endif
@csrf

<div class="m-auto mt-5 mb-5">
    <h2 class="text-center">@if (isset($projeto))Editar Projeto @else Criar Projeto @endif</h2>
</div>

@if (count($errors)>0)
<div class="alert-danger text-center m-auto mb-5 p-3 rounded">
    @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
</div>
@endif

    <div class="mb-3">
      <label for="nome" class="form-label">Nome do Projeto</label>
      <input required type="text" class="form-control" id="nome" name="nome" @if(isset($projeto)) value="{{$projeto->nome ?? ''}}" @endif >
    </div>
    <div class="mb-3">
      <label for="dataInicio" class="form-label">Data de início</label>
      <input required type="date" class="form-control" id="dataInicio" name="dataInicio" @if (isset($projeto)) ?? value="{{$projeto->dataInicio}}" : value="" @endif>
    </div>
    <div class="mb-3">
        <label for="dataFim" class="form-label">Data do Fim</label>
        <input required type="date" class="form-control" id="dataFim" name="dataFim" @if (isset($projeto)) ?? value="{{$projeto->dataFim}}" : value="" @endif>
    </div>
    <div class="form-check form-switch mb-4">
        <input class="form-check-input" type="checkbox" id="ativo">
        <label class="form-check-label" for="ativo">Projeto ativo</label>
    </div>
    <button type="submit" class="btn btn-outline-success">@if (isset($projeto))Atualizar @else Criar  @endif</button>
    <a href="{{url('/')}}" class="btn btn-outline-primary">Ver Projetos
    </a>
  </form>
</div>
