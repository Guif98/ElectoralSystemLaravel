@extends('layouts.template')

@section('content')



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


<div class="container col-lg-6 m-auto mt-5">

    <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" class="form-control" name="foto[]" id="foto[]" multiple>
    </div>
    <button type="submit" class="btn btn-success">Add Foto</button>
    <a href="">
        <button class="btn btn-primary">Voltar</button>
    </a>
</div>

</form>

@endsection
