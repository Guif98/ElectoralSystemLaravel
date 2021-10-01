@extends('layouts.app')
@section('content')
        <div>

        </div>
        <header class="projeto mb-5">
            @if (session('message'))
                      <div id="msg-session" class="text-center m-auto p-3 alert-{{session('msg-type')}}">
                          <p>{{session('message')}}</p>
                      </div>
            @endif


            @foreach ($projetos as $projeto)
            <div class="mx-auto">
                @if (isset($projeto->capa) && $subProjetos->count() > 0)
                    <img class="projeto-cover" src="{{url("storage/fotos/$projeto->capa")}}" alt="">
                @endif
            </div>
            @endforeach

            <!-- Alerta para quando não haver candidatos para o evento -->
                <div id="evento-alert" class="alert alert-warning alert-dismissible fade show d-none" role="alert">
                    <p>Não há nenhum candidato para ser votado no momento!</p>
                </div>
        </header>
        <section class="home-section">
            @if ($projetosFinalizados->count() > 0 && $projetos->count() <= 0)
                @include('resultados', ['projetos' => $projetosGeral, 'title' => 'Não há nenhum evento para votação no momento']);
            @endif
            <h3 class="text-center text-uppercase">Votações:</h3>
        @foreach ($projetos as $projeto)
            @php
                $cat = $categorias->where('projeto_id', $projeto->id);
            @endphp
        <a class="text-decoration-none" href="{{url("votar/$projeto->id")}}">
        <div class="div-evento">
            <h2 class="titulo-projeto text-center font-bold">{{$projeto->nome}} </h2>
        </div>
        </a>
        @endforeach

        @if ($projetosFinalizados->count() > 0)
            <a class="text-decoration-none" href="{{route('resultados')}}">
                <div class="div-resultados">
                    <h4 class="mt-5 mb-5 text-center">Resultados de todos os eventos</h4>
                </div>
            </a>
        @endif
     </section>
@endsection
