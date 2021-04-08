@extends('layouts.template')

@section('content')

@php $projeto_id = request()->route('projeto_id'); @endphp

    @if (session('message'))
    <div class="text-center m-auto mb-5 mt-5 p-3 alert-{{session('msg-type')}}">
        <p>{{session('message')}}</p>
    </div>
    @endif

    <div class="text-center mx-auto mt-5">
        <h4>ADICIONAR FOTOS:</h4>
    </div>


<form name="formCriar" id="formCriar" action="{{url("/subprojetos/$subProjeto->projeto_id/$subProjeto->id")}}" class="col-lg-8 mx-auto col-sm-8" method="POST" enctype="multipart/form-data">
    @method('POST')
    @csrf


<input type="hidden" name="projeto_id" id="projeto_id" value="{{ request()->route('projeto_id') }}">
<div class="container mx-auto">
    <div class="mb-3 mt-5 mx-auto">
        <label class="custom-file-label" for="foto">Selecione as fotos (no máximo 4 imagens)</label>
        <input type="file" class="custom-file-input" name="foto[]"  id="foto[]"  multiple/>
    </div>

    <div class="mb-3 mt-2 ml-0 p-0">
        <button type="submit" class="add-foto btn btn-success ">Adicionar Fotos</button>
        <a href="{{url("subprojetos/$projeto_id")}}">
            <button type="button" class="voltar-add-foto btn btn-primary ">Voltar</button>
        </a>
    </div>

</form>
</div>


@endsection
