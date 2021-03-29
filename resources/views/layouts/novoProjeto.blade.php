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
      <label for="nome" class="form-label">Nome do Projeto:</label>
      <input required type="text" class="form-control" id="nome" name="nome" @if(isset($projeto)) value="{{$projeto->nome ?? ''}}" @endif >
    </div>
    <div class="mb-3 input-formCriar">
      <label for="dataInicio" class="form-label">Data de início:</label>
      <input required type="date" class="form-control" id="dataInicio" name="dataInicio" @if (isset($projeto)) ?? value="{{$projeto->dataInicio}}" : value="" @endif>
    </div>
    <div class="mb-3 input-formCriar">
        <label for="dataFim" class="form-label">Data do Fim:</label>
        <input required type="date" class="form-control input-formCriar" id="dataFim" name="dataFim" @if (isset($projeto)) ?? value="{{$projeto->dataFim}}" : value="" @endif>
    </div>
    <label for="capa">Adicionar foto de capa:</label>
    <div class="custom-file mb-3" id="capa">
        <input type="file" name="capa" class="custom-file-input" id="capa">
        <label class="custom-file-label" for="capa">Selecionar arquivo</label>
    </div>

    @if (isset($projeto) && $projeto->ativo == 1)
        <label for="">Status do Projeto: Ativo</label>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" onclick="return confirm('Uma vez desativado o projeto não pode ser reativado, deseja realmente desativá-lo?')" value="1" name="desativar[]" id="desativar">
            <label class="form-check-label" for="desativar">
                Desativar Projeto
            </label>
          </div>
    @endif



    <a href="{{url('/projetos')}}" class="input-formCriar btn btn-outline-primary">Voltar</a>
    <button type="submit" class="input-formCriar btn btn-outline-success">@if (isset($projeto))Atualizar @else Criar  @endif</button>
  </form>
</div>
@endsection

    <script>
        let ativo = document.getElementById('ativo');
        ativo.addEventListener('click', function() {
            ativo.classList.add('btn-outline-danger');
            ativo.classList.remove('btn-outline-success');
        });
    </script>
