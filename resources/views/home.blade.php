@extends('layouts.app')


@section('content')
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
                    <form action="{{url("/$s->id")}}" method="post">
                        @method('post')
                        @csrf

                        <div class="project-div d-flex flex-column" id="{{$s->id}}">
                            <input type="hidden" name="voto" value="{{$s->id}}">
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

                        <button type="submit" class="btn btn-success btn-lg">VOTAR</button>
                    </form>
                        <!--Fim da div projeto -->

                    @endforeach
                </div>

                <!--FIm da div categoria-->

            @endforeach

        @endforeach


        <footer class="mt5 mb5 p-5 mx-auto text-center">

        </footer>
    </section>






        <!-- Modal -->

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


    <script>
        $(document).ready(function() {
            $(".img").click(function() {


                let imgSrc = document.getElementById(this.id).children[0].currentSrc;
                console.log(imgSrc)

                let imageInsideModal = document.getElementById("imageInsideModal");
                $("#imgModal").modal();
                imageInsideModal.src = imgSrc;


            });

            $("#close").click(function() {
                $("#imgModal").modal("hide");

            });
        });


        $(document).ready(
            function()
            {
            $(".project-div").click(
                function(event)
            {
                $(this).addClass("bg-dark").addClass("text-light").siblings().removeClass("bg-dark");
            }
            );
        });

    </script>

@endsection
