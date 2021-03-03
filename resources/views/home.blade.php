@extends('layouts.app')


@section('content')
    <header class="m-0 p-0" style="z-index: -1">
        <video class="video-container" muted autoplay loop>
            <source src="{{url('video/video.mp4')}}" type="video/mp4"/>
        </video>
        <h2 class="title text-center">Bem-Vindo!</h2>
        <section class="home-section">

        <h2 class="text-center font-bold pt-5">Projetos do evento: {{$projeto->nome}} </h2>

        <div class="categoria">
            <div class="bg-primary p-4 mt-4 w-75 mx-auto rounded">
                <h4 class="text-center text-light">{{$sub->relCategorias->nome}}</h4>
            </div>

            @foreach ($subProjetos->sortBy('categoria_id') as $sub)


                <div class="project-div d-flex flex-column">
                    <div class="flex-column">
                        <h4>{{$sub->titulo}}</h4>
                        <p>2 pessoas votaram</p>
                    </div>
                    <div class="flex-row align-items-center">
                        <div class="pt-2">De 22/02/2021 à 15/03/2021</div>
                        <a class="d-flex justify-content-end text-decoration-none" href="">
                            <button class="btn btn-primary">Ver</button>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

        </section>
    </header>
@endsection
