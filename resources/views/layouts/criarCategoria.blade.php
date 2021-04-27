@extends('layouts.template')

@section('content')



<div class="container mt-5 mx-auto">
@if (isset($categoria))
<form name="formEdit" id="formEdit" action="{{url("categorias/$categoria->projeto_id/$categoria->id")}}" class="col-lg-12 col-sm-8" method="POST">
    @method('PATCH')
@else
<form name="formCriar" id="formCriar" action="{{url('/categorias/criar')}}" class="col-lg-12 col-sm-8" method="POST">
    @method('POST')
@endif
@csrf

<div class="text-center">
    <h2 class="titulo-sm">@if (isset($categoria))EDITAR @else CRIAR @endif CATEGORIA:</h2>
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

    <div class="mb-3  mt-5">
      <label for="nome" class="form-label">Nome da Categoria</label>
      <input required type="text" class="form-control" id="nome" name="nome" @if(isset($categoria)) value="{{$categoria->nome ?? ''}}" @endif >
    </div>
    <button type="submit" class="btn btn-success col-lg-2 col-sm-auto">@if (isset($categoria))Atualizar @else Criar  @endif</button>
    <a href="{{url("categorias/$projeto_id")}}" class="btn btn-primary col-lg-2 col-sm-auto mt-sm-auto mt-3">Voltar
    </a>
  </form>
</div>
@endsection
