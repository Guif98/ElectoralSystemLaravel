@extends('layouts.template')

@section('content')

<div class="container mx-auto mt-5">

<form name="formCriar" id="formCriar" action="{{url("/subprojetos/$subProjeto->projeto_id/$subProjeto->id")}}" class="m-auto col-6" method="POST" enctype="multipart/form-data">
    @method('POST')
    @csrf


<input type="hidden" name="projeto_id" id="projeto_id" value="{{ request()->route('projeto_id') }}">
@php $projeto_id = request()->route('projeto_id'); @endphp

@if (session('message'))
<div class="text-center m-auto mb-5 mt-5 p-3 alert-{{session('msg-type')}}">
    <p>{{session('message')}}</p>
</div>
@endif




    <div class="mb-3 mx-auto input-formCriar">
        <label class="form-label" for="foto">Selecione as fotos (no máximo 8 imagens)</label>
        <input type="file" class="form-control" name="foto[]"  id="foto[]"  multiple/>

    </div>

    <button type="submit" class="btn btn-success input-formCriar">Add Foto</button>
    <a href="">
        <button class="btn btn-primary input-formCriar">Voltar</button>
    </a>


</form>

</div>

@endsection
