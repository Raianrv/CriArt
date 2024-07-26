@extends('layouts.main')

@section('title', 'CriArt')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um trabalho</h1>
    <form action="/" method="GET">
        <input type="text" id="busca" name="busca" class="form-control" placeholder="Procurar...">
    </form>
</div>
<div id="events-container" class="col-md-12">
    @if($busca)
    <h2>Buscando por: {{ $busca }}</h2>
    @else
    <h2>Trabalhos Disponíveis</h2>
    <p class="subtitle">Veja os trabalhos disponíveis</p>
    @endif
    <div id="cards-container" class="row">
        @foreach ($projetos as $dados)
        <div class="card col-md-3">
            <div class="card-body">
                <h5 class="card-title">{{ $dados->titulo }}</h5>
                <p class="card-date">Data de Inicio:  {{ date('d/m/Y', strtotime($dados->data_inicial)) }}</p>
                <p class="card-date">Data de Entrega:  {{ date('d/m/Y', strtotime($dados->data_final)) }}</p>
                <h6 class="card-categoria"><ion-icon name="color-palette-outline"></ion-icon> {{ $dados->categoria->name }}</h6>
                <p class="card-tags">
                    @foreach($dados->tags as $tag)
                        <span class="badge badge-primary">{{ $tag->name }}</span>
                    @endforeach
                </p>
                <a href="/projetos/{{ $dados->id }}" class="btn btn-primary">Saber mais</a>
            </div>
        </div>
        @endforeach
        @if(count($projetos) == 0 && $busca)
            <p>Não foi possível encontrar nenhum trabalho com: {{ $busca }}! <a href="/">Ver todos</a></p>
        @elseif(count($projetos) == 0)
            <p>Não há trabalhos disponíveis</p>
        @endif
    </div>
</div>

@endsection


    