@extends('layouts.main')

@section('title', 'Criar Trabalho')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Publique seu Trabalho</h1>
    <form action="/projetos" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="titulo">Titulo do Trabalho:</label>
        <input type="titulo" class="form-control" id="titulo" name="titulo" placeholder="Titulo">
      </div>
      <div class="form-group">
        <label for="data_inicial">Data de inicio:</label>
        <input type="date" class="form-control" id="data_inicial" name="data_inicial">
      </div>
      <div class="form-group">
        <label for="data_final">Data de entrega:</label>
        <input type="date" class="form-control" id="data_final" name="data_final">
      </div>
      <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" class="form-control" placeholder="Descreva sua solicitação"></textarea>
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
                <input class="form-check-input" type="checkbox" name="tags[]" id="tag{{ $tag->id }}" value="{{ $tag->id }}">
                <label class="form-check-label" for="tag{{ $tag->id }}">
                    {{ $tag->name }}
                </label>
            </div>
        @endforeach
      </div>
        <input type="submit" class="btn btn-primary" value="Publicar Trabalho">
    </form>
  </div>

@endsection