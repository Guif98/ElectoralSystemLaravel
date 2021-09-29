@extends('layouts.app')
@section('content')
@if($projeto->ativo == 0)
<div id="evento-alert" class="alert alert-warning alert-dismissible text-center p-5 m-5" role="alert">
    <h4>Votação não disponível : (</h4>
</div>
@else
<form action="{{route('votar')}}" method="post" id="formVotar" name="formVotar">
    @csrf
    @method('POST')
        <header class="projeto mb-5">
            @if (session('message'))
                      <div id="msg-session" class="text-center m-auto p-3 alert-{{session('msg-type')}}">
                          <p>{{session('message')}}</p>
                      </div>
            @endif
        </header>
<div>
    <h2 class="titulo-projeto text-center font-bold">{{$projeto->nome}} </h2>
    <h5 class="text-center">A votação termina na data {{date('d/m/Y', strtotime($projeto->dataFim))}}</h5>
    <div class="alerta-voto text-center alert-warning p-4 mb-5 mt-5">
        <h4>Clique nas áreas dos projetos abaixo de sua preferência para votar:</h4>
    </div>



    @foreach ($categorias as $c)
    @php
        $sub = $subProjetos->where('categoria_id', $c->id);
        //dd($sub)
    @endphp


    <!--Início da div categoria -->

        <div class="cat">
            <input type="hidden" name="" value="{{$c->id}}">

            <div class="categoria-titulo p-4 mt-4 mx-auto rounded col-xl-9 col-lg-9">
                <h3 class="text-center text-light">{{$c->nome}}</h3>
            </div>
            @foreach ($sub as $s)
            @php
                $foto = $fotos->where('subprojeto_id', $s->id);
            @endphp

            <!-- Div projeto -->


                <div class="radio project-div div-color">
                    <input type="hidden" id="{{$s->id}}" value="{{$s->id}}">
                    <div class="title-and-expand d-flex justify-content-between">
                        <h4><b>{{$s->titulo}}</b></h4>
                        <span class="material-icons-outlined expand_more">
                            <img  class="expand_more_image" width="40" height="40" src="{{url('images/expand_more_black_24dp.svg')}}" alt="expand_more">
                        </span>
                    </div>
                    <div class="project-content">
                        <div class="d-flex flex-column">
                            <p>{{$s->descricao}}</p>
                            <p>@if (isset($s->integrantes)) <b>Integrantes:</b> {{$s->integrantes}} @endif</p>
                        </div>

                        <div class="{{$s->id}} image-container container d-flex flex-wrap justify-content-around">
                            @foreach ($foto as $f)
                                <ul class="list-unstyled  ">
                                    <li>
                                        <a href="{{url("/storage/$f->foto")}}" rel="lightbox[{{$f->subprojeto_id}}]" data-lightbox="lightbox[{{$f->subprojeto_id}}]"  id="{{$f->id}}">
                                            <img class="imgProjeto" src="{{url("/storage/$f->foto")}}"  alt="image">
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    </div>

                </div>


                <!--Fim da div projeto -->
            @endforeach
            <div class="nulo">
                <h5>Nenhuma das opções</h5>
            </div>
        </div>
        <!--Fim da div categoria-->
    @endforeach
</div>

<footer class="m-5 p-5">
    <div class="mx-auto text-center">
        <button type="button" id="voto" class="btn d-none btn-success btn-lg mb-5">VOTAR</button>
    </div>
</footer>


<!-- Modal para preencher informacoes -->

<div class="modal fade" id="votoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="votoModal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="votoModal">Antes de votar, preencha as informações abaixo:</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>

  </div>
      <input type="hidden"@if (isset($projeto)) value="{{$projeto->id}}" @endif name="projeto_id">
      <div class="modal-body">

      <!--Divs de mensagens e erros dos modais-->

          @if (count($errors)>0)
              <div id="msg-error-request" class="alert-danger text-center m-auto mb-5 mt-5 p-3 rounded">
                  @foreach ($errors->all() as $error)
                      <p>{{$error}}</p>
                  @endforeach
              </div>
          @endif

          <div id="mensagem-erro" class="text-center">

          </div>

      <!-- Fim das divs de mensagens e erros -->
          <div>
              <label for="nome" class="form-label">Nome</label>
              <input form="formVotar" type="text" class="form-control" name="nome" id="nome">
          </div>
          <div>
              <label for="sobrenome" class="form-label">Sobrenome</label>
              <input form="formVotar" type="text" class="form-control" name="sobrenome" id="sobrenome">
          </div>
          <div>
              <label for="cpf" class="form-label">CPF</label>
              <input form="formVotar" type="text" maxlength="11" class="form-control" required id="cpf" onkeypress="return apenasNumeros()" name="cpf">
          </div>
      </div>

      <div class="modal-footer">
          <button type="button" id="confirmar" class="btn btn-primary">Confirmar</button>
      </div>
</div>
</div>
</div>


<!-- Confirmar submit -->

  <div class="modal" id="descricaoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Verifique se as informações abaixo constam com os seus dados informados:</h5>
        </div>
        <div id="mensagem-erro" class="text-center">

        </div>
        <div class="modal-body" id="descricao">

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" form="formVotar">Confirmar Votos</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</form>

@endif
@endsection
