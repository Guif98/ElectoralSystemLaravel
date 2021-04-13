@extends('layouts.template')



@section('content')

@if (session('message'))
 <div class="text-center m-auto p-3 alert-{{session('msg-type')}}">
    <p>{{session('message')}}</p>
 </div>
@endif


 <input type="hidden" name="projeto_id" id="projeto_id" value="{{ request()->route('projeto_id') }}">
    @php $projeto_id = request()->route('projeto_id'); @endphp


    <div class="mx-auto mt-5 text-center mb-5">
        <a class="text-decoration-none" href="{{url("subprojetos/$projeto_id/formProjeto")}}">
            <button class="btn btn-success col-lg-auto col-sm-auto p-2">Novo Candidato</button>
        </a>
        <a class="text-decoration-none" href="{{url("/projetos")}}">
            <button class="btn btn-primary col-lg-auto col-sm-auto mt-lg-auto mt-3 p-2">Voltar</button>
        </a>
    </div>


@if ($projeto->ativo == 1 && $votos->where('projeto_id', $projeto_id)->count() > 0))
<h4 class="text-center mt-5">QUANTIDADE DE VOTOS:</h4>
    <div class="w-100 container mx-auto mb-5 overflow-auto">
        <table class="table mt-5 table-hover table-striped w-100">
            <thead class="bg-dark text-light">
                <tr>
                    <th>TÍTULO</th>
                    <th>CATEGORIA</th>
                    <th>QUANTIDADE DE VOTOS</th>
                    <th>PORCENTAGEM DE VOTOS</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($maisVotados->where('projeto_id', $projeto_id)->sortBy('categoria_id') as $item)
                    <td>{{$item->titulo}}</td>
                    @foreach ($categorias as $cat)
                        @if ($item->categoria_id == $cat->id)
                            <td>{{$cat->nome}}</td>
                            <td>{{$item->qtdVotos}}</td>

                            @php
                                $candidatoCat = $maisVotados->where('categoria_id', $item->categoria_id);
                                $totalCat = 0;
                            @endphp

                            @foreach ($candidatoCat as $candidato)
                                @php $totalCat = $totalCat + $candidato->qtdVotos; @endphp
                            @endforeach

                            <td>{{round($item->qtdVotos * 100 / $totalCat)}}%</td>
                        @endif
                    @endforeach
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
@endif


@if ($subProjetos->where('projeto_id', $projeto_id)->count() > 0)
<div class="mx-auto mt-5 text-center mb-5">
    <div class="mt-5">
        <h4 class="text-center">CANDIDATOS:</h4>
    </div>

<div class="row justify-content-center">
    <div class="col-11">
        <table id="lg-table-subprojetos" class="table mt-5 table-hover table table-striped">
            <thead class="bg-dark text-white">
              <tr>
                <th scope="col">TÍTULO</th>
                <th scope="col">CATEGORIA</th>
                <th scope="col" class="w-25">DESCRIÇÃO</th>
                <th scope="col">INTEGRANTES</th>
                <th scope="col" class="w-25">FOTOS</th>
                <th scope="col">AÇÕES</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($subProjetos as $subProjeto)
              @php
                    $fotos = $subProjeto->find($subProjeto->id)->relFotos;
              @endphp
                <tr>
                    <td>{{$subProjeto->titulo}}</td>
                    <td>{{$subProjeto->relCategorias->nome}}</td>
                    <td>{{$subProjeto->descricao}}</td>
                    <td>{{$subProjeto->integrantes}}</td>
                    <td>@foreach ($fotos as $foto)
                        <a href="#imgModal" class="img" id="{{$foto->id}}">
                            <img style="width: 100px; height: 100px;" src="{{url("/storage/app/fotos/$foto->foto")}}" alt="image">
                        </a>
                      @endforeach
                    </td>
                    <td>
                        <div role="group" class=" btn-group pull-right">
                            <a class="mr-2" href="{{url("/subprojetos/$subProjeto->projeto_id/edit/$subProjeto->id")}}">
                                <button class="btn btn-outline-primary">Editar</button>
                            </a>
                            <a class="mr-2" href="{{url("/subprojetos/$subProjeto->projeto_id/addFoto/$subProjeto->id")}}">
                                <button class="btn btn-outline-success">+Fotos</button>
                            </a>
                            <a href="{{url("/subprojetos/$subProjeto->id/delete")}}" onclick="return confirm('Deseja realmente excluir esse projeto?')">
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
@endif
<div class="row justify-content-center">
    <div class="col-auto">
        <table id="medium-table-subprojetos" class="table mt-5 mx-auto table table-hover table-striped">
            <thead class="bg-dark text-white">
              <tr>
                <th scope="col">TÍTULO</th>
                <th scope="col">CATEGORIA</th>
                <th scope="col" colspan="4">AÇÕES</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($subProjetos as $subProjeto)
              @php
                    $fotos = $subProjeto->find($subProjeto->id)->relFotos;
              @endphp
                <tr>
                    <td>{{$subProjeto->titulo}}</td>
                    <td>{{$subProjeto->relCategorias->nome}}</td>
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row">
                                <a class="mr-2" href="{{url("/subprojetos/$subProjeto->projeto_id/edit/$subProjeto->id")}}">
                                    <button class="btn btn-outline-primary">Editar</button>
                                </a>
                                <a class="mr-2" href="{{url("/subprojetos/$subProjeto->projeto_id/addFoto/$subProjeto->id")}}">
                                    <button class="btn btn-outline-success">+Fotos</button>
                                </a>
                            </div>

                            <div class="d-flex flex-row mt-2">
                                <a class="mr-2" href="{{url("/subprojetos/$subProjeto->id/delete")}}" onclick="return confirm('Deseja realmente excluir esse projeto?')">
                                    <button class="btn btn-outline-danger">Excluir</button>
                                </a>
                                <a class="mr-2" href="{{url("/subprojetos/$subProjeto->projeto_id/ver/$subProjeto->id")}}">
                                    <button class="btn btn-outline-secondary">Ver</button>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
    </div>
</div>






<!-- Modal para imagens-->

        <div id="imgModal" class="modal mt-5">
            <div class="modal-dialog">
              <div class="modal-content">
                    <div class="slide">
                        <img class="demo" id="imageInsideModal" src="" alt="" style="width: 100%;" >
                    </div>
                <d iv class="modal-body bg-dark">
                    <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="imgModal">Fechar</button>

                    <a id="deleteImg" href="{{url("/subprojetos/$projeto_id/deletar/")}}">
                        <button class="btn btn-danger">Excluir</button>
                    </a>
                </div>
              </div>
            </div>
          </div>


    <script>
        $(document).ready(function() {
            $(".img").click(function() {

                let img = document.getElementById(this.id).id;
                let imgSrc = document.getElementById(this.id).children[0].currentSrc;

                let imageInsideModal = document.getElementById('imageInsideModal');
                $("#imgModal").modal("show");
                imageInsideModal.src = imgSrc;

                    var url = document.getElementById("deleteImg").href;
                    url = url + "/" + img

                    $("#deleteImg").click(function() {
                        document.getElementById("deleteImg").href= url
                    });

                    $("#close").click(function() {
                       $("#imgModal").modal("hide");
                    });
            });


    });


    </script>


@endsection
