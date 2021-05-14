@extends('layouts.template')

@section('content')


@guest
    <h1>Você não está logado</h1>
@endguest


@if (session('message'))
 <div class="text-center m-auto p-3 alert-{{session('msg-type')}}">
    <p>{{session('message')}}</p>
 </div>
 @endif

    <div>
        <h2 class="text-center mt-5">EVENTOS:</h2>
    </div>
    <div class="mx-auto mt-5 text-center">
        <a href="{{url('novoProjeto')}}">
            <button class="btn btn-success mt-5 col-lg-auto col-sm-auto p-2">Novo Evento</button>
        </a>
    </div>
    <div class="row justify-content-center mb-5 pb-5">
        <div class="col-lg-10">
        @if (isset($projetos) && $projetos->count() > 0)
            <table id="lg-table-projetos" class="mt-5 table table-hover text-dark table-striped table-responsive">
                <thead class="bg-dark text-light">
                  <tr>
                    <th scope="col">PROJETO</th>
                    <th scope="col">DATA INICIAL</th>
                    <th scope="col">DATA FINAL</th>
                    <th scope="col">DATA DO RESULTADO</th>
                    <th scope="col">ATIVO</th>
                    <th scope="col" colspan="3">AÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($projetos->sortByDesc('ativo') as $projeto)
                    <tr>
                        <td class="w-25"><a style="color: rgb(6, 234, 255)" href="{{url("subprojetos/$projeto->id")}}" class="text-decoration-none">{{$projeto->nome}}</a></td>
                        <td class="w-25">{{date('d/m/Y', strtotime($projeto->dataInicio))}}</td>
                        <td class="w-25">{{date('d/m/Y', strtotime($projeto->dataFim))}}</td>
                        <td class="w-25">{{date('d/m/Y', strtotime($projeto->dataResultado))}}</td>
                        @if ($projeto->ativo == 1)<td class="w-25">Ativo</td> @else <td class="w-25">Desativado</td>@endif
                        <td class="w-75">
                            <div class="d-inline-flex justify-content-around">
                                <a class="text-decoration-none pr-2" href="{{url("projetos/$projeto->id/edit")}}">
                                    <button class="btn btn-outline-primary">Editar</button>
                                </a>
                                <a class="text-decoration-none pr-2" href="{{url("categorias/$projeto->id")}}">
                                    <button class="btn btn-outline-secondary">Categorias</button>
                                </a>
                                <a class="text-decoration-none pr-2" onclick="return confirm('Deseja realmente excluir esse projeto/evento?')" href="{{url("projetos/delete/$projeto->id")}}">
                                    <button class="btn btn-outline-danger">Excluir</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @endif
        </div>

    </div>

    <div class="row justify-content-center mb-5 pb-5">
        <div class="col-auto">
        @if (isset($projetos) && $projetos->count() > 0)
            <table id="little-table-projetos" class="mt-5 table table-hover text-dark table-striped table-responsive">
                <thead class="bg-dark text-light">
                  <tr>
                    <th scope="col">PROJETO</th>
                    <th scope="col" colspan="3">AÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($projetos as $projeto)
                    <tr>
                        <td><a style="color: aqua" href="{{url("subprojetos/$projeto->id")}}" class="text-decoration-none">{{$projeto->nome}}</a></td>
                        <td class="buttons">
                                <a class="text-decoration-none mr-2" href="{{url("projetos/$projeto->id/edit")}}">
                                    <button class="btn btn-outline-primary">Editar</button>
                                </a>
                                <a class="text-decoration-none" href="{{url("categorias/$projeto->id")}}">
                                    <button class="btn btn-outline-secondary">Categorias</button>
                                </a>
                                <a class="text-decoration-none pr-2" onclick="return confirm('Deseja realmente excluir esse projeto/evento?')" href="{{url("projetos/delete/$projeto->id")}}">
                                    <button class="btn btn-outline-danger">Excluir</button>
                                </a>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @endif
        </div>
    </div>

@endsection

