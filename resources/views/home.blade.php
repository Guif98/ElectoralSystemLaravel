@extends('layouts.app')


@section('content')

        <header class="projeto mb-5">
            @foreach ($projetos as $projeto)
            <div class="mx-auto">
                @if (isset($projeto->capa))
                    <img class="projeto-cover" src="{{url("/storage/app/fotos/$projeto->capa")}}" alt="">
                @endif
            </div>
            @endforeach

            <!-- Alerta para quando não haver eventos ativos -->
            <div id="evento-alert" class="alert alert-danger d-none text-center" style="font-size: 2em;" role="alert">
                <p class="mt-3">Não há nenhum evento ativo no momento!</p>
            </div>

        </header>
        <section class="home-section">

        @foreach ($projetos as $projeto)
            @php
            //dd($projeto->id)
            //dd($categorias->where('projeto_id', $projeto->id))->get();
            $cat = $categorias->where('projeto_id', $projeto->id);
            @endphp
            <h2 class="text-center font-bold">Projetos do evento: {{$projeto->nome}} </h2>

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

        <div id="imgModal" class="modal">
            <div style="top: 10%; left: 10%;">
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-light" style="font-size: 4em;">&times;</span>
                </button>
            </div>
              <div class="modal-content bg-light" style="width: 60%; margin: 5% auto;" >
                <div class="modal-body">
                    <span id="anterior" class="arrow arrow-left" type="button"></span>
                    <span id="proximo" class="arrow arrow-right" type="button"></span>

                    <div class="slide d-flex flex-row">
                        <img class="demo" id="imageInsideModal" src="" alt="" style="width: 100%;height: 750px;" >
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
                  <button type="submit" form="formVotar" id="votarSubmit" class="btn btn-primary">Confirmar Votos</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>

                </div>
                <form action="{{route('validarEleitor')}}"  method="POST">
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

                        <div id="mensagem-erro">

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



    <script>
        let projectDiv = document.querySelectorAll('.project-div');
        if (projectDiv.length > 0) {
            document.getElementById('voto').classList.remove('d-none');
            document.getElementById('evento-alert').classList.add('d-none');
        } else {
            document.getElementById('voto').classList.add('d-none');
            document.getElementById('evento-alert').classList.remove('d-none');
        }

       let imageContainers = document.querySelectorAll('.image-container');
        imageContainers.forEach(function(imageContainer){
            if (imageContainer.childElementCount == 0) {
                imageContainer.previousElementSibling.childNodes[7].classList.remove('ver_fotos')
                imageContainer.previousElementSibling.childNodes[7].classList.add('d-none')
            }
        });

        $(document).ready(function() {
            setTimeout(function(){
                $("#msg-session").fadeOut('fast');
                $("#msg-error-request").fadeOut('fast');
             }, 3000 );

            $(".img").click(function() {

                var index = 0;
                let currentImg = document.getElementById(this.id);
                let parentDiv = currentImg.parentNode.parentNode.parentNode;

                let siblingImages = parentDiv.getElementsByTagName('img');

                for (let i=0; i < siblingImages.length; i++) {
                    siblingImages[i].onclick = function(index) {
                        index = i;

                $("#imgModal").modal();
                let imageInsideModal = document.getElementById("imageInsideModal");
                let imgSrc = siblingImages[index].currentSrc;
                imageInsideModal.src = imgSrc;

            }
        }


             $("#proximo").click(function () {
                    index++;
                    if (index > siblingImages.length - 1 || index > 3 ) {
                        index = 0;
                        imgSrc = siblingImages[0].currentSrc;
                        imageInsideModal.src = imgSrc;
                        return imageInsideModal.src;
                    }

                    else if (index < 0) {
                        index = 0;
                        imgSrc = siblingImages[0].currentSrc;
                        imageInsideModal.src = imgSrc;
                        return imageInsideModal.src;
                    }
                    imgSrc = siblingImages[index].currentSrc;
                    imageInsideModal.src = imgSrc;
             });


                $("#anterior").click(function() {
                    index--;
                    if (index < 0) {
                        if (siblingImages.length > 4) {
                            index = 3;
                            imgSrc = siblingImages[3].currentSrc;
                            imageInsideModal.src = imgSrc;
                            return imageInsideModal.src;
                        } else {
                            index = siblingImages.length - 1;
                            imgSrc = siblingImages[siblingImages.length - 1].currentSrc;
                            imageInsideModal.src = imgSrc;
                            return imageInsideModal.src;
                        }

                    }
                    else if (index > siblingImages.length - 1 || index == 3) {
                        index = siblingImages.length - 1;
                        imgSrc = siblingImages[siblingImages.length - 1].currentSrc;
                        imageInsideModal.src = imgSrc;
                        return imageInsideModal.src;
                    }
                    imgSrc = siblingImages[index].currentSrc;
                    imageInsideModal.src = imgSrc;
                });
               /* let imgSrc = currentImg.children[0].currentSrc;
                alerta1sole.loalertagSrc)


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
                    let mensagem = document.getElementById("mensagem-erro");
                    let br = document.createElement('br');
                    let nome =  document.getElementById("nome").value;
                    let sobrenome =  document.getElementById("sobrenome").value;
                    let cpf =  document.getElementById("cpf").value;
                    let projetoVotado = document.querySelectorAll(".selected");
                    let projeto = [];


                if (nome.length > 1 && sobrenome.length > 1 && cpf.length == 11) {
                    projetoVotado.forEach(function(p) {
                        projeto.push(p.children[1].firstElementChild.textContent
                        );
                    });
                        if (projeto.length == 0) {
                            $("#votoModal").modal("show");
                            mensagem.innerHTML = `
                            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <strong>Você deve selecionar no mínimo um projeto!</strong>
                              </div>`
                        } else {
                            $("#descricaoModal").modal('show');
                            document.getElementById("descricao").innerHTML = `<p><b>Nome:</b> ${nome}</p>
                            <p><b>Sobrenome:</b> ${sobrenome}</p>
                            <p><b>Cpf:</b> ${cpf}</p>
                            <p><b>Projetos Votados:</b> ${projeto.toString()}</p>
                            `
                        }

                } else {
                        $("#votoModal").modal("show");
                        mensagem.innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            <strong>Você deve preencher suas informações corretamente!</strong>
                        </div>`
                }
            });


        });

            $(".ver_fotos").click(function() {
                let n = 0;
                let fotos = this.parentElement.parentElement.children[2].getElementsByTagName('img');
                $("#imgModalSmartphone").modal("show")
                document.querySelector('.slide').innerHTML = `<img class="smartPhoneModal" src="${fotos[n].currentSrc}" style="width: 100%;">`

                $("#next").click(function(){
                     n++;
                    if (n > fotos.length - 1) {
                        n = fotos.length - 1;
                        return document.querySelector('.slide').innerHTML = `<img class="smartPhoneModal" src="${fotos[fotos.length - 1].currentSrc}" style="width: 100%;">`
                    } else {
                        return document.querySelector('.slide').innerHTML = `<img class="smartPhoneModal" src="${fotos[n].currentSrc}" style="width: 100%;">`
                    }
                });

                $("#prev").click(function(){
                    n--;
                    if (n <= 0) {
                        n = 0
                        return document.querySelector('.slide').innerHTML = `<img class="smartPhoneModal" src="${fotos[0].currentSrc}" style="width: 100%;">`
                    } else {
                        return document.querySelector('.slide').innerHTML = `<img class="smartPhoneModal" src="${fotos[n].currentSrc}" style="width: 100%;">`
                    }
                });
            });

        $(document).ready(
            function()
            {
            $(".project-div").click(
                function(event)
            {
                $(this).addClass("bg-dark").addClass("text-light").siblings().removeClass("bg-dark").removeClass("text-light");
                $(this).parent().find('.radio').removeClass('selected');
                $(this).addClass('selected');
                $(this).children('input').attr('name', 'voto[]');
                $(this).children('input').parent().siblings('div').children('input').removeAttr('name');
            }
            );

            $(".nulo").click(
                function(event)
            {
                $(this).addClass("bg-dark").addClass("text-light").siblings().removeClass("bg-dark");
                $(this).parent().find('.radio').removeClass('selected');
                $(this).siblings('div').children('input').removeAttr('name');
            }
            );

        });

    </script>

@endsection
