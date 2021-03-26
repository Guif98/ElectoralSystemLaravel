@extends('layouts.template')

@section('content')

<div class="container mx-auto mt-5">
        @php $projeto_id = request()->route('projeto_id'); @endphp



<form name="formCriar" id="formCriar" action="{{url("/subprojetos/$subProjeto->projeto_id/$subProjeto->id")}}" class="m-auto col-6" method="POST" enctype="multipart/form-data">
    @method('POST')
    @csrf


<input type="hidden" name="projeto_id" id="projeto_id" value="{{ request()->route('projeto_id') }}">

@if (session('message'))
<div class="text-center m-auto mb-5 mt-5 p-3 alert-{{session('msg-type')}}">
    <p>{{session('message')}}</p>
</div>
@endif




    <div class="mb-3 mt-5 mx-auto input-formCriar">
        <label class="custom-file-label" for="foto">Selecione as fotos (no máximo 4 imagens)</label>
        <input type="file" class="custom-file-input" name="foto[]"  id="foto[]"  multiple/>
    </div>

    <button type="submit" class="btn btn-success input-formCriar">Add Foto</button>
    <a href="{{url("subprojetos/$projeto_id")}}">
        <button type="button" class="btn btn-primary btn-lg">Voltar</button>
    </a>
</form>


</div>
@endsection
