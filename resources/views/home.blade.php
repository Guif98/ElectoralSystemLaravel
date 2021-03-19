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

                        <div class="radio project-div">
                            <input type="hidden" id="{{$s->id}}" value="{{$s->id}}">
                            <div class="d-flex flex-column">
                                <h4><b>{{$s->titulo}}</b></h4>
                                <p>{{$s->descricao}}</p>
                                <p><b>Integrantes:</b> {{$s->integrantes}}</p>
                                <a id="ver_fotos" href="#imgModalSmartphone">
                                    <button type="button" class="btn btn-sm btn-secondary">Ver Fotos</button>
                                </a>
                            </div>

                            <div class="{{$s->id}} container d-flex flex-wrap justify-content-around">
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
                </div>

                <!--Fim da div categoria-->

            @endforeach

        @endforeach

        <footer>
            <div class="p-2 mt-5 mx-auto text-center">
                    <button type="button" id="voto" class="btn btn-success btn-lg">VOTAR</button>
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

        <button type="button" id="next" class="btn-primary btn">Netx
        </button>
          <div class="modal-content bg-light" >
            <div class="modal-body">
                <div class="slide d-flex flex-row">

                </div>
            </div>
          </div>
      </div>



        <!-- Modal para imagens Desktop -->

        <div id="imgModal" class="modal">
            <div style="top: 10%; left: 10%;">
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-light" style="font-size: 4em;">&times;</span>
                </button>
            </div>
              <div class="modal-content bg-light" style="width: 60%; margin: 5% auto;" >
                <div class="modal-body">
                    <button id="anterior" class="btn btn-lg btn-primary" type="button">Previous</button>
                    <button id="proximo" class="btn btn-lg btn-success" type="button">Next</button>

                    <div class="slide d-flex flex-row">
                        <img class="demo" id="imageInsideModal" src="" alt="" style="width: 100%; height:100%;" >
                    </div>
                </div>
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
                  <button type="submit" form="formVotar"  class="btn btn-primary">Confirmar Votos</button>
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

                let currentImg = document.getElementById(this.id);
                let singularImg = currentImg.childNodes[1];

                let parentDiv = currentImg.parentNode.parentNode.parentNode;
                let siblingImages = parentDiv.getElementsByTagName('img');

                for (let i=0; i < siblingImages.length; i++) {
                    siblingImages[i].onclick = function() {
                        index = i;
                        return index;
                    }
                }

                $("#imgModal").modal();
                let imageInsideModal = document.getElementById("imageInsideModal");
                let imgSrc = siblingImages[index].currentSrc;

                $("#proximo").click(function() {
                    console.log(index)
                    index++;
                    if (index >= siblingImages.length) {
                        index = 0;
                    }
                    imgSrc = siblingImages[index].currentSrc;
                    imageInsideModal.src = imgSrc;
                });

                $("#anterior").click(function() {
                    console.log(index)
                    index--;
                    if (index <= -1) {
                        index = siblingImages.length - 1;
                    }
                    imgSrc = siblingImages[index].currentSrc;
                    imageInsideModal.src = imgSrc;
                });


                imageInsideModal.src = imgSrc;






                $("#proximo").click(function() {
                    currentImg.src = currentImg.src + 1;
                });

               /* let imgSrc = currentImg.children[0].currentSrc;
                console.log(imgSrc)


                imageInsideModal.src = imgSrc;*/


            });

            setTimeout(function() {
                $("#votoModal").modal("show");
            }, 100);
                $("#votoModal").modal({
                    backdrop: 'static',
                    keyboard: false
                });

            $("#confirmar").click(function() {
                if (document.getElementById("nome").value) {
                    if (document.getElementById("sobrenome").value) {
                        if (document.getElementById("cpf").value) {
                            $("#votoModal").modal('hide');
                        }
                    }
                }
            });

            $("#voto").click(function() {
                let nome =  document.getElementById("nome").value;
                let sobrenome =  document.getElementById("sobrenome").value;
                let cpf =  document.getElementById("cpf").value;
                let projetoVotado = document.querySelectorAll(".selected");
                let projeto = [];
                projetoVotado.forEach(function(p) {
                    projeto.push(p.children[1].firstElementChild.textContent
                    );
                });


                $("#descricaoModal").modal('show');

                document.getElementById("descricao").innerHTML = `<p><b>Nome:</b> ${nome}</p>
                <p><b>Sobrenome:</b> ${sobrenome}</p>
                <p><b>Cpf:</b> ${cpf}</p>
                <p><b>Projetos Votados:</b> ${projeto.toString()}</p>
                `
            });
        });

        $("#ver_fotos").click(function() {
            let n = 0;
            let fotos = this.parentElement.parentElement.children[2].getElementsByTagName('img');
            console.log(fotos)
            $("#imgModalSmartphone").modal("show")
            document.querySelector('.slide').innerHTML = `<img class="smartPhoneModal" src="${fotos[n].currentSrc}" style="width: 100%;">`
            $("#next").click(function(){
                n++;
                document.querySelector('.slide').innerHTML = `<img class="smartPhoneModal" src="${fotos[n].currentSrc}" style="width: 100%;">`
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
