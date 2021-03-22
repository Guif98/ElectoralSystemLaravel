@extends('layouts.template')

@section('content')


<div class="mx-auto">



@if (isset($subProjeto))

<form name="formEdit" id="formEdit" action="{{url("/subprojetos/$subProjeto->projeto_id/$subProjeto->id")}}" class="m-auto col-6" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf

@else

<form name="formCriar" id="formCriar" action="{{url("/subprojetos/formProjeto")}}" class="m-auto col-6" method="POST" enctype="multipart/form-data">
    @method('POST')
    @csrf

@endif

<div class="mx-auto mt-5 mb-5">
    <h3 class="titulo-sm text-center">Criar SubProjeto para o Projeto</h3>
</div>

@if (isset($errors) && count($errors)>0)
<div class="alert-danger text-center m-auto mb-5 p-3 rounded">
    @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
</div>
@endif

    <input type="hidden" name="projeto_id" id="projeto_id" value="{{ request()->route('projeto_id') }}">
    @php $projeto_id = request()->route('projeto_id'); @endphp


    <div class="mb-3 input-formCriar">
        <label for="titulo" class="form-label">Título</label>
        <input required type="text" class="form-control" id="titulo" name="titulo" @if (isset($subProjeto)) value="{{$subProjeto->titulo}}" @endif>
    </div>
    <div class="mb-3 input-formCriar">
      <label for="categoria" class="form-label">Categoria</label>
        <select class="form-control selector" name="categoria_id" id="categoria_id">
        <option  value="{{$subProjeto->relCategorias->id ?? ''}}">@if (isset($subProjeto)){{$subProjeto->relCategorias->nome}}@else Categoria @endif</option>
        @foreach ($categorias as $categoria)
        <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
        @endforeach
    </select>
    </div>
    <label for="descricao_div" class="form-label">Descrição</label>
    <div class="input-formCriar" id="descricao_id">
        <textarea class="mb-3 form-control" id="descricao" name="descricao"  value="">@if (isset($subProjeto)) {{$subProjeto->descricao}} @endif</textarea>
    </div>
    <label for="integrantes_div" class="form-label">Integrantes</label>
    <div class="input-formCriar" id="integrantes_div">
        <textarea class="mb-3 form-control" id="integrantes" name="integrantes">@if (isset($subProjeto)) {{$subProjeto->integrantes}} @endif</textarea>
    </div>
    <button type="submit" class="btn btn-success input-formCriar">@if (isset($subProjeto))Atualizar @else Criar  @endif</button>
    <a href="{{url("/subprojetos/$projeto_id")}}" class="btn btn-primary input-formCriar">Voltar
    </a>
  </form>

</div>
@endsection
