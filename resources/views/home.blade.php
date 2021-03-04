@extends('layouts.app')


@section('content')
    <header class="m-0 p-0" style="z-index: 1">
        <video class="video-container" muted autoplay loop>
            <source src="{{url('video/video.mp4')}}" type="video/mp4"/>
        </video>
        <h2 class="title text-center">Bem-Vindo!</h2>
        <section class="home-section">

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

                <div class="categoria">
                    <div class="bg-primary p-4 mt-4 w-75 mx-auto rounded">
                        <h4 class="text-center text-light">{{$c->nome}}</h4>
                    </div>
                    @foreach ($sub as $s)
                    @php
                        $foto = $fotos->where('subprojeto_id', $s->id);
                    @endphp
                        <div class="project-div d-flex flex-column">
                            <div class="flex-column">
                                <h4><b>{{$s->titulo}}</b></h4>
                                <p>{{$s->descricao}}</p>
                                <p><b>Integrantes:</b> {{$s->integrantes}}</p>

                                <div class="column">
                                    @foreach ($foto as $f)
                                        <a href="#imgModal">
                                            <img class="img" id="{{$f->id}}" style="width: 200px; height: 200px;" src="{{url("/storage/app/fotos/$f->foto")}}"  alt="image">
                                        </a>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            @endforeach

        @endforeach

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

        </section>
    </header>

    <script>
        $(document).ready(function() {
            $(".img").click(function() {
                let img = document.getElementById(this.id);
                let imgSrc = document.getElementById(this.id).src;


                let imageInsideModal = document.getElementById("imageInsideModal");
                $("#imgModal").modal();
                imageInsideModal.src = imgSrc;


            });

            $("#close").click(function() {
                $("#imgModal").modal("hide");

            });
        });
    </script>

@endsection
