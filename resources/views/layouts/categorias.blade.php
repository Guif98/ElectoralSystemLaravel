@extends('layouts.template')


@section('content')



@if (session('message'))
 <div class="text-center m-auto p-3 alert-{{session('msg-type')}}">
    <p>{{session('message')}}</p>
 </div>
 @endif

 <input type="hidden" name="projeto_id" id="projeto_id" value="{{ request()->route('projeto_id') }}">
    @php $projeto_id = request()->route('projeto_id'); @endphp

<div class="container-fluid mt-5">
    <div class="mx-auto mt-5">
        <h2 class="text-center">Categorias</h2>
    </div>
    <div class="mx-auto mt-5 text-center">
        <a class="text-decoration-none" href="{{url("categorias/$projeto_id/criar")}}">
            <button class="btn btn-success">Criar Categorias</button>
        </a>
        <a class="text-decoration-none" href="{{url('/projetos')}}">
            <button class="btn btn-primary">Voltar</button>
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-auto">
            <table id="lg-table-categorias" class="table mt-5 hidden table-hover table-striped">
                <thead class="bg-dark text-light">
                  <tr>
                    <th scope="col">CATEGORIA</th>
                    <th scope="col">PROJETO</th>
                    <th scope="col">ID DO PROJETO</th>
                    <th scope="col" colspan="2">AÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{$categoria->nome}}</td>
                            <td>{{$projeto->nome}}</td>
                            <td>{{$categoria->projeto_id}}</td>
                            <td>
                                <div class="d-inline-flex">
                                    <a class="text-decoration-none mr-2" href="{{url("/categorias/$categoria->projeto_id/edit/$categoria->id")}}">
                                        <button class="btn btn-outline-primary">Editar</button>
                                    </a>
                                    <a onclick="return confirm('Deseja realmente apagar esta categoria?')" class="text-decoration-none" href="{{url("/categorias/delete/$categoria->id")}}">
                                        <button class="btn btn-outline-danger">Excluir</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-auto">
            <table id="md-table-categorias" class="table mt-5 hidden table-hover table-striped">
                <thead class="bg-dark text-light">
                  <tr>
                    <th scope="col">CATEGORIA</th>
                    <th scope="col" colspan="2">AÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{$categoria->nome}}</td>
                            <td>
                                <div class="d-inline-flex">
                                    <a class="text-decoration-none mr-2" href="{{url("/categorias/$categoria->projeto_id/edit/$categoria->id")}}">
                                        <button class="btn btn-outline-primary">Editar</button>
                                    </a>
                                    <a onclick="return confirm('Deseja realmente apagar esta categoria?')" class="text-decoration-none" href="{{url("/categorias/delete/$categoria->id")}}">
                                        <button class="btn btn-outline-danger">Excluir</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>

</div>
@endsection
