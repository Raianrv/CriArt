@extends('layouts.main')

@section('title', 'Meus Trabalhos')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Trabalhos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($projetos) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Nome do Inscrito ao trabalho</th>
                <th scope="col">E-mail do Inscrito ao trabalho</th>
                <th scope="col">Categoria</th> 
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projetos as $projeto)
                <tr>
                    <td scropt="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/projetos/{{ $projeto->id }}">{{ $projeto->titulo }}</a></td>
                    @if($projeto->usuarioProjeto)
                    <td>{{ $projeto->usuarioProjeto->name }}</td>  
                    <td>{{ $projeto->usuarioProjeto->email }}</td>
                    @else
                    <td>N/A</td>
                    <td>N/A</td>
                    @endif
                    <td>{{ $projeto->categoria->name }}</td> 
                    <td>
                        <a href="/projetos/{{ $projeto->id }}/edit/" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon>Editar</a> 
                        <form action="/projetos/{{ $projeto->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach    
        </tbody>
    </table>
    @else
    <p>Você ainda não publicou um trabalho, <a href="/projetos/create">Pulicar Trabalho</a></p>
    @endif
</div>

@endsection