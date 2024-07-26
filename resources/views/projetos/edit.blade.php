@extends('layouts.main')

@section('title', 'Editando: ' . $projeto->titulo)

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{ $projeto->titulo }}</h1>
    <form action="/projetos/{{ $projeto->id }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="title">Evento:</label>
        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Nome do evento" value="{{ $projeto->titulo }}">
      </div>
      <div class="form-group">
        <label for="date">Data inicial:</label>
        <input type="date" class="form-control" id="data_inicial" name="data_inicial" value="{{ $projeto->data_inicial }}">
      </div>
      <div class="form-group">
        <label for="date">Data final</label>
        <input type="date" class="form-control" id="data_final" name="data_final" value="{{ $projeto->data_final }}">
      </div>
      <div class="form-group">
        <label for="title">Descrição:</label>
        <textarea name="descricao" id="descricao" class="form-control" placeholder="Descreva sua solicitação">{{ $projeto->descricao }}</textarea>
      </div>
      <div class="form-group">
        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria" class="form-control">
            <option value="">Selecione a categoria</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="tags">Tags:</label>
        @foreach($tags as $tag)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="tags[]" id="tag{{ $tag->id }}" value="{{ $tag->id }}"
                @if($projeto->tags->contains($tag)) checked @endif>
                <label class="form-check-label" for="tag{{ $tag->id }}">
                    {{ $tag->name }}
                </label>
            </div>
        @endforeach
      </div>
      <input type="submit" class="btn btn-primary" value="Editar Trabalho">
    </form>
  </div>


@endsection