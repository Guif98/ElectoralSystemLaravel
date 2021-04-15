@extends('layouts.app')


@section('content')

        <header class="projeto mb-5">
            @foreach ($projetos as $projeto)
            <div class="mx-auto">
                @if (isset($projeto->capa) && $subProjetos->count() > 0)
                    <img class="projeto-cover" src="{{url("/storage/app/fotos/$projeto->capa")}}" alt="">
                @endif
            </div>
            @endforeach

            <!-- Alerta para quando não haver candidatos para o evento -->
                <div id="evento-alert" class="alert alert-warning alert-dismissible fade show d-none" role="alert">
                    <h4 class="nenhum-candidato-mensagem">Não há nenhum candidato para ser votado no momento!</h4>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        </header>
        <section class="home-section">
            @if ($projetos->where('ativo', 0)->count() > 0)
            <div id="ver_resultado_div" class="mx-auto text-center d-none">
                <a class="ver_resultado" href="{{route('resultados')}}">
                    <button class="btn btn-primary btn-lg">Ver resultados da votação</button>
                </a>
            </div>
            @endif
        @foreach ($projetos as $projeto)
            @php
            //dd($projeto->id)
            //dd($categorias->where('projeto_id', $projeto->id))->get();
            $cat = $categorias->where('projeto_id', $projeto->id);
            @endphp
            <h2 class="titulo-projeto text-center font-bold d-none">Projetos do evento: {{$projeto->nome}} </h2>

            @foreach ($cat as $c)
            @php
                $sub = $subProjetos->where('categoria_id', $c->id);
                //dd($sub)
            @endphp


            <!--Início da div categoria -->
            <form id="formVotar" action="{{url("/")}}" method="post">
                @method('post')
                @csrf
                <div class="categoria">
                    <input type="hidden" id="{{$c->id}}" value="{{$c->id}}">

                    <div class="bg-primary p-4 mt-4 mx-auto rounded col-xl-9 col-lg-9">
                        <h4 class="text-center text-light">{{$c->nome}}</h4>
                    </div>
                    @foreach ($sub as $s)
                    @php
                        $foto = $fotos->where('subprojeto_id', $s->id);
                    @endphp

                    <!-- Div projeto -->


                        <div class="radio project-div div-color">
                            <input type="hidden" id="{{$s->id}}" value="{{$s->id}}">
                            <div class="d-flex flex-column">
                                <h4><b>{{$s->titulo}}</b></h4>
                                <p>{{$s->descricao}}</p>
                                <p><b>Integrantes:</b> {{$s->integrantes}}</p>
                                <a class="ver_fotos" href="#imgModalSmartphone">
                                    <button type="button" class="btn btn-sm btn-secondary">Ver Fotos</button>
                                </a>
                            </div>

                            <div class="{{$s->id}} image-container container d-flex flex-wrap justify-content-around">
                                @foreach ($foto as $f)
                                    <ul class="list-unstyled  ">
                                        <li>
                                            <a href="#imgModal" class="img" id="{{$f->id}}">
                                                <img class="imgProjeto" style="width: 200px; height: 200px;" src="{{url("/storage/app/fotos/$f->foto")}}"  alt="image">
                                            </a>
                                        </li>
                                    </ul>
                                @endforeach
                            </div>

                        </div>


                        <!--Fim da div projeto -->
                    @endforeach
                    <div class="nulo">
                        <h4>Nenhuma das opções</h4>
                    </div>
                </div>

                <!--Fim da div categoria-->

            @endforeach

        @endforeach
        <footer>
            <div class="p-2 mt-5 mx-auto text-center">
                    <button type="button" id="voto" class="btn d-none btn-success btn-lg">VOTAR</button>
            </div>
        </footer>
    </section>


    <!-- Modal para imagens SmartPhone -->


    <div id="imgModalSmartphone" class="modal">
        <div style="top: 10%; left: 10%;">
            <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-light" style="font-size: 2em;">&times;</span>
            </button>

        </div>


          <div class="modal-content bg-light" >
            <div class="modal-body">
                <span id="prev" class="arrow arrow-left" type="button"></span>
                <span id="next" class="arrow arrow-right" type="button"></span>
                <div class="slide d-flex flex-row" style="width:100%; height: 300px;">

                </div>
            </div>
          </div>
      </div>



        <!-- Modal para imagens Desktop -->

        <div id="imgModal" class="modal mx-auto">
            <div class="m-2">
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-light" style="font-size: 4em;">&times;</span>
                </button>
            </div>
            <div class="modal-content mx-auto mt-5 mb-5 p-2" style="max-height: 96%; max-width: 96%;">
                    <span id="anterior" class="arrow arrow-left" type="button"></span>
                    <span id="proximo" class="arrow arrow-right" type="button"></span>
                    <img id="imageInsideModal" src="" alt="modal-image" style="overflow: hidden">
            </div>
        </div>



        <div id="modalLoad" class="modal mx-auto">
            <div class="modal-load-body mx-auto  w-50 p-5 bg-dark text-center">
                <img id="load-gif" src="{{url('/storage/app/fotos/loading.gif')}}" alt="modal-gif" width="auto">
            </div>
        </div>


          <!-- Modal para confirmar submit -->

          <div class="modal" id="descricaoModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Verifique se as informações abaixo constam com os seus dados informados:</h5>
                </div>
                <div class="modal-body" id="descricao">

                </div>
                <div class="modal-footer">
                  <button type="submit" form="formVotar" id="votarSubmit" class="btn btn-primary">Confirmar Votos</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
              </div>
            </div>
          </div>



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
                <form action="{{route('validarEleitor')}}"  method="POST">
                    <input type="hidden"@if (isset($projeto)) value="{{$projeto->id}}" @endif name="projeto_id">
                    <div class="modal-body">

                    <!--Divs de mensagens e erros dos modais-->

                        @if (session('message'))
                            <div id="msg-session" class="text-center m-auto p-3 alert-{{session('msg-type')}}">
                                <p>{{session('message')}}</p>
                            </div>
                        @endif

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
                            <input type="text" class="form-control" name="nome" id="nome">
                        </div>
                        <div>
                            <label for="sobrenome" class="form-label">Sobrenome</label>
                            <input type="text" class="form-control" name="sobrenome" id="sobrenome">
                        </div>
                        <div>
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" maxlength="11" class="form-control" required id="cpf" onkeypress="return apenasNumeros()" name="cpf">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="confirmar" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
@endsection
