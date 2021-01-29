@extends('layouts.template')

<div class="container mt-5 col-8">
@if (isset($categoria))
<form name="formEdit" id="formEdit" action="{{url("categorias/$categoria->projeto_id/$categoria->id")}}" class="m-auto col-6" method="POST">
    @method('PATCH')
@else
<form name="formCriar" id="formCriar" action="{{url('/categorias/criar')}}" class="m-auto col-6" method="POST">
    @method('POST')
@endif
@csrf

<div class="m-auto mt-5 mb-5">
    <h2 class="text-center">@if (isset($categoria))Editar Categoria @else Criar Categoria @endif</h2>
</div>

@if (count($errors)>0)
<div class="alert-danger text-center m-auto mb-5 p-3 rounded">
    @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
</div>
@endif

    <input type="hidden" name="projeto_id" id="projeto_id" value="{{ request()->route('projeto_id') }}">
    @php $projeto_id = request()->route('projeto_id'); @endphp

    <div class="mb-3">
      <label for="nome" class="form-label">Nome da Categoria</label>
      <input required type="text" class="form-control" id="nome" name="nome" @if(isset($categoria)) value="{{$categoria->nome ?? ''}}" @endif >
    </div>
    <button type="submit" class="btn btn-success">@if (isset($categoria))Atualizar @else Criar  @endif</button>
    <a href="{{url("categorias/$projeto_id")}}" class="btn btn-secondary">Ver Categorias
    </a>
  </form>
</div>
