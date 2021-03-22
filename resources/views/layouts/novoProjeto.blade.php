@extends('layouts.template')

@section('content')



<div class="mt-5 mx-auto">
@if (isset($projeto))
<form name="formEdit" id="formEdit" action="{{url("projetos/$projeto->id")}}" class="m-auto col-6" method="POST" enctype="multipart/form-data">
    @method('patch')
@else
<form name="formCriar" id="formCriar" action="{{url('novoProjeto')}}" class="m-auto col-6" method="POST" enctype="multipart/form-data">
    @method('POST')
@endif
@csrf

<div class="mx-auto mt-5 mb-5">
    <h2 class="text-center titulo-sm">@if (isset($projeto))Editar Projeto @else Criar Projeto @endif</h2>
</div>

@if (count($errors)>0)
<div class="alert-danger text-center m-auto mb-5 p-3 rounded">
    @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
</div>
@endif

    <div class="mb-3 mt-5 input-formCriar">
      <label for="nome" class="form-label">Nome do Projeto</label>
      <input required type="text" class="form-control" id="nome" name="nome" @if(isset($projeto)) value="{{$projeto->nome ?? ''}}" @endif >
    </div>
    <div class="mb-3 input-formCriar">
      <label for="dataInicio" class="form-label">Data de início</label>
      <input required type="date" class="form-control" id="dataInicio" name="dataInicio" @if (isset($projeto)) ?? value="{{$projeto->dataInicio}}" : value="" @endif>
    </div>
    <div class="mb-3 input-formCriar">
        <label for="dataFim" class="form-label">Data do Fim</label>
        <input required type="date" class="form-control input-formCriar" id="dataFim" name="dataFim" @if (isset($projeto)) ?? value="{{$projeto->dataFim}}" : value="" @endif>
    </div>
    <label for="capa">Adicionar foto de capa</label>
    <div class="custom-file mb-3" id="capa">
        <input type="file" name="capa" class="custom-file-input" id="capa">
        <label class="custom-file-label" for="capa">Selecionar arquivo</label>
      </div>
    <div class="form-check form-switch mb-4 input-formCriar">
        <input class="form-check-input" value="1" type="checkbox" id="ativo" name="ativo[]">
        <label class="form-check-label" for="ativo">Projeto ativo</label>
    </div>
    <button type="submit" class="input-formCriar btn btn-outline-success">@if (isset($projeto))Atualizar @else Criar  @endif</button>
    <a href="{{url('/projetos')}}" class="input-formCriar btn btn-outline-primary">Ver Projetos
    </a>
  </form>
</div>
@endsection
