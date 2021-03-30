@extends('layouts.template')



@section('content')

@if (session('message'))
 <div class="text-center m-auto p-3 alert-{{session('msg-type')}}">
    <p>{{session('message')}}</p>
 </div>
 @endif



 <input type="hidden" name="projeto_id" id="projeto_id" value="{{ request()->route('projeto_id') }}">
    @php $projeto_id = request()->route('projeto_id'); @endphp


@if ($projeto->ativo == 1)
    <div class="w-100 container mx-auto mt-5 mb-5">
        <h4 class="text-center">Quantidade de votos:</h4>
        <table class="table mt-5 table-hover table-striped w-100">
            <thead class="bg-dark text-light">
                <tr>
                    <th>TÍTULO</th>
                    <th>CATEGORIA</th>
                    <th>QUANTIDADE DE VOTOS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($maisVotados->sortBy('categoria_id') as $item)
                        <td>{{$item->titulo}}</td>
                        @foreach ($categorias as $cat)
                            @if ($item->categoria_id == $cat->id)
                                <td>{{$cat->nome}}</td>
                                <td>{{$item->qtdVotos}}</td>
                            @endif
                        @endforeach
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
@endif



<div class="mt-5 container-fluid">
    <div class="m-auto mt-5">
        <h2 class="text-center">Candidatos:</h2>
    </div>
    <div class="mx-auto mt-5 text-center">
        <a class="text-decoration-none" href="{{url("subprojetos/$projeto_id/formProjeto")}}">
            <button class="btn btn-success">Criar Candidato</button>
        </a>
        <a class="text-decoration-none" href="{{url("/projetos")}}">
            <button class="btn btn-primary">Voltar</button>
        </a>
    </div>
<table id="xl-table-subprojetos" class="table mt-5 table-hover table-dark table-striped">
    <thead>
      <tr>
        <th scope="col">Título</th>
        <th scope="col">Categoria</th>
        <th scope="col" class="w-25">Descricao</th>
        <th scope="col">Integrantes</th>
        <th scope="col" class="w-25">Fotos</th>
        <th scope="col">Ações</th>
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


  <table id="lg-table-subprojetos" class="table mt-5 table-hover w-75 mx-auto table-dark table-striped">
    <thead>
      <tr>
        <th scope="col">Título</th>
        <th scope="col">Categoria</th>
        <th scope="col">Descricao</th>
        <th scope="col">Integrantes</th>
        <th scope="col" colspan="2">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($subProjetos as $subProjeto)
        <tr>
            <td>{{$subProjeto->titulo}}</td>
            <td>{{$subProjeto->relCategorias->nome}}</td>
            <td>{{$subProjeto->descricao}}</td>
            <td>{{$subProjeto->integrantes}}</td>
            <td>
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row">
                        <a href="{{url("/subprojetos/$subProjeto->projeto_id/edit/$subProjeto->id")}}">
                            <button class="btn btn-outline-primary">Editar</button>
                        </a>
                        <a href="{{url("/subprojetos/$subProjeto->projeto_id/addFoto/$subProjeto->id")}}">
                            <button class="btn btn-outline-success">+Fotos</button>
                        </a>
                    </div>

                    <div class="d-flex flex-row">
                        <a href="{{url("/subprojetos/$subProjeto->id/delete")}}" onclick="return confirm('Deseja realmente excluir esse projeto?')">
                            <button class="btn btn-outline-danger">Excluir</button>
                        </a>
                        <a href="{{url("/subprojetos/$subProjeto->projeto_id/ver/$subProjeto->id")}}">
                            <button class="btn btn-outline-secondary">Ver</button>
                        </a>
                    </div>

                </div>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>


  <table id="medium-table-subprojetos" class="table mt-5 w-50 mx-auto table-dark table-hover table-striped">
    <thead>
      <tr>
        <th scope="col">Título</th>
        <th scope="col">Categoria</th>
        <th scope="col" colspan="4">Ações</th>
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
                        <a class="flex-fill" href="{{url("/subprojetos/$subProjeto->projeto_id/edit/$subProjeto->id")}}">
                            <button class="btn btn-outline-primary">Editar</button>
                        </a>
                        <a href="{{url("/subprojetos/$subProjeto->projeto_id/addFoto/$subProjeto->id")}}">
                            <button class="btn btn-outline-success">+Fotos</button>
                        </a>
                    </div>

                    <div class="d-flex flex-row">
                        <a href="{{url("/subprojetos/$subProjeto->id/delete")}}" onclick="return confirm('Deseja realmente excluir esse projeto?')">
                            <button class="btn btn-outline-danger">Excluir</button>
                        </a>
                        <a href="{{url("/subprojetos/$subProjeto->projeto_id/ver/$subProjeto->id")}}">
                            <button class="btn btn-outline-secondary">Ver</button>
                        </a>
                    </div>
                </div>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <table id="little-table-subprojetos" class="table mt-5 mx-auto w-100 table-dark table-hover table-striped">
    <thead>
      <tr>
        <th scope="col">Título</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($subProjetos as $subProjeto)
        <tr>
            <td class="w-50">{{$subProjeto->titulo}}</td>
            <td class="w-100 ">
                <div class="d-flex flex-wrap">
                    <div class="d-flex flex-row justify-content-center">
                        <a class="mr-2 mt-2" href="{{url("/subprojetos/$subProjeto->projeto_id/edit/$subProjeto->id")}}">
                            <button class="btn btn-outline-primary btn">Editar</button>
                        </a>
                        <a class="mt-2" href="{{url("/subprojetos/$subProjeto->projeto_id/addFoto/$subProjeto->id")}}">
                            <button class="btn btn-outline-success btn">+Fotos</button>
                        </a>
                    </div>
                    <div class="d-flex flex-row justify-content-center">
                        <a class="mr-2 mt-2" href="{{url("/subprojetos/$subProjeto->id/delete")}}" onclick="return confirm('Deseja realmente excluir esse projeto?')">
                            <button class="btn btn-outline-danger btn ">Excluir</button>
                        </a>
                        <a class="mt-2" href="{{url("/subprojetos/$subProjeto->projeto_id/ver/$subProjeto->id")}}">
                            <button class="btn btn-outline-secondary btn">Ver</button>
                        </a>
                    </div>

                </div>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>



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
