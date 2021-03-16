@extends('layouts.app')


@section('content')

    @if (session('message'))
    <div class="text-center m-auto p-3 alert-{{session('msg-type')}}">
        <p>{{session('message')}}</p>
    </div>
    @endif

    <header class="m-0 p-0" style="z-index: 1">
        <video class="video-container" muted autoplay loop>
            <source src="{{url('video/video.mp4')}}" type="video/mp4"/>
        </video>
        <h2 class="title text-center">Bem-Vindo!</h2>
    </header>
        <section class="home-section mb-5">

        @foreach ($projetos as $projeto)
            @php
            //dd($projeto->id)
            //dd($categorias->where('projeto_id', $projeto->id))->get();
            $cat = $categorias->where('projeto_id', $projeto->id);
            @endphp
            <h2 class="text-center font-bold pt-5">Projetos do evento: {{$projeto->nome}} </h2>

            @foreach ($cat as $c)
            @php
                $sub = $subProjetos->where('categoria_id', $c->id);
                //dd($sub)
            @endphp


            <!--Início da div categoria -->

                <div class="categoria">
                    <div class="bg-primary p-4 mt-4 w-75 mx-auto rounded">
                        <h4 class="text-center text-light">{{$c->nome}}</h4>
                    </div>
                    @foreach ($sub as $s)
                    @php
                        $foto = $fotos->where('subprojeto_id', $s->id);
                    @endphp

                    <!-- Div projeto -->
                    <form id="formVotar" action="{{url("/")}}" method="post">
                        @method('post')
                        @csrf

                        <div class="radio project-div d-flex flex-column">
                            <input type="hidden" id="{{$s->id}}" value="{{$s->id}}">
                            <div class="flex-column">
                                <h4><b>{{$s->titulo}}</b></h4>
                                <p>{{$s->descricao}}</p>
                                <p><b>Integrantes:</b> {{$s->integrantes}}</p>

                                <div class="column">
                                    @foreach ($foto as $f)
                                        <a href="#imgModal" class="img" id="{{$f->id}}">
                                            <img style="width: 200px; height: 200px;" src="{{url("/storage/app/fotos/$f->foto")}}"  alt="image">
                                        </a>
                                    @endforeach
                                </div>

                            </div>
                        </div>


                        <!--Fim da div projeto -->
                    @endforeach
                </div>

                <!--FIm da div categoria-->

            @endforeach

        @endforeach

        <footer>
            <div class="p-2 mt-5 mx-auto text-center">
                    <button type="submit" form="formVotar" id="voto" class="btn btn-success btn-lg">VOTAR</button>
            </div>
        </footer>
    </section>






        <!-- Modal para imagens-->

        <div id="imgModal" class="modal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                    <div class="slide">
                        <img class="demo" id="imageInsideModal" src="" alt="" style="width: 100%;" >
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
              </div>
            </div>
          </div>



          <!-- Modal para votos -->

          <div class="modal fade" id="votoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="votoModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="votoModal">Antes de votar, preencha as informações abaixo:</h5>
                </div>
                <form action="{{route('validarEleitor')}}"  method="POST">
                    <div class="modal-body">

                        @if (count($errors)>0)
                            <div class="alert-danger text-center m-auto mb-5 mt-5 p-3 rounded">
                                @foreach ($errors->all() as $error)
                                    <p>{{$error}}</p>
                                @endforeach
                            </div>
                        @endif

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
                            <input type="text" maxlength="11" class="form-control" id="cpf" onkeypress="return apenasNumeros()" name="cpf">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="confirmar" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>
              </div>
            </div>
          </div>


    <script>
        $(document).ready(function() {
            $(".img").click(function() {


                let imgSrc = document.getElementById(this.id).children[0].currentSrc;
                console.log(imgSrc)

                let imageInsideModal = document.getElementById("imageInsideModal");
                $("#imgModal").modal();
                imageInsideModal.src = imgSrc;


            });

            setTimeout(function() {
                $("#votoModal").modal("show");
            }, 100);
                $("#votoModal").modal({
                    backdrop: 'static',
                    keyboard: false
                });

            $("#confirmar").click(function() {
                $("#votoModal").modal('hide');
            });

            $("#voto").click(function() {
                $("#descricaoModal").modal('show');
            });
        });




        $(document).ready(
            function()
            {
            $(".project-div").click(
                function(event)
            {
                $(this).addClass("bg-dark").addClass("text-light").siblings().removeClass("bg-dark");
                $(this).parent().find('.radio').removeClass('selected');
                $(this).addClass('selected');
                $(this).children('input').attr('name', 'voto[]');
                $(this).children('input').parent().siblings('div').children('input').removeAttr('name');
            }
            );

        });

    </script>

@endsection
