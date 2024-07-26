@extends('layouts.main')

@section('title', $projeto->titulo)

@section('content')

<div class="container">
  <div class="row">
    <div id="info-container" class="col-md-6">
      <h3>Sobre o Trabalho:</h3>
      <h1>{{ $projeto->title }}</h1>
      <p class="event-owner"><ion-icon name="star-outline"></ion-icon>{{ $projeto->usuario->name }}</p>
      <p class="card-date"><ion-icon name="calendar-outline"></ion-icon>{{ date('d/m/Y', strtotime($projeto->data_inicial)) }}</p>
      <p class="card-date"><ion-icon name="calendar-outline"></ion-icon>{{ date('d/m/Y', strtotime($projeto->data_final)) }}</p>
      <h6 class="card-categoria"><ion-icon name="color-palette-outline"></ion-icon>{{ $projeto->categoria->name }}</h6>
    </div>
    <div class="col-md-6">
      <div id="description-container">
        <h5>Descrição do trabalho:</h5>
        <p class="event-description"><ion-icon name="clipboard-outline"></ion-icon>{{ $projeto->descricao }}</p>
      </div>
      <h5>Tags:</h5>
      <ul>
        @foreach($projeto->tags as $tag)
          <li>{{ $tag->name }}</li>
        @endforeach
      </ul>
      <form action="/projetos/{{ $projeto->id }}/atribuir" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-primary" id="event-submit">Se inscreva ao trabalho</button>
      </form>
    </div>
  </div>
</div>

@endsection
