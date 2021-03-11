@extends('layouts.template')

@section('content')

<div class="container mx-auto mt-5">
    <div class="mx-auto text-center mb-5">
        @php $projeto_id = request()->route('projeto_id'); @endphp
        <a href="{{url("subprojetos/$projeto_id")}}">
            <button class="btn btn-primary btn-lg">Voltar</button>
        </a>
    </div>


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
        <label class="form-label" for="foto">Selecione as fotos (no máximo 4 imagens)</label>
        <input type="file" class="form-control" name="foto[]"  id="foto[]"  multiple/>
    </div>

    <button type="submit" class="btn btn-success input-formCriar">Add Foto</button>
</form>


</div>
@endsection
