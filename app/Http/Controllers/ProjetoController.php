<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Projeto;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProjetoController extends Controller
{
    /*
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $busca = request('busca');

        if($busca) {

            $projetos = Projeto::where([ 
                ['titulo', 'like', '%'.$busca.'%']
            ])->get();

        } else {
            $projetos = Projeto::where('user_projeto_id', null)->get();
        }

        return view('welcome', ['projetos' => $projetos, 'busca' => $busca]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $tags = Tag::all(); 

        return view('projetos.create', ['categorias' => $categorias, 'tags' => $tags]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->all();
        $user = Auth::user();

        $projeto = Projeto::create([
            'user_id' => $user->id,
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao'],
            'data_inicial' => $dados['data_inicial'],
            'data_final' => $dados['data_final'],
            'categoria_id' => $dados['categoria']

        ]);

        $projeto->tags()->attach($request->tags);

        return redirect('publicados')->with('msg', 'Trabalho publicado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $projeto = Projeto::find($id);
        
        
        return view('projetos.show', ['projeto' => $projeto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categorias = Categoria::all();
        $tags = Tag::all();
        $projeto = Projeto::find($id);
        $user = Auth::user();

        if($user->id != $projeto->user_id) {
            return redirect('/publicados');
        }

        return view('projetos.edit', ['projeto' => $projeto, 'categorias' => $categorias, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $projeto = Projeto::find($id);
        $dados = $request->all();


        $projeto->update([
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao'],
            'data_inicial' => $dados['data_inicial'],
            'data_final' => $dados['data_final'],
            'categoria_id' => $dados['categoria']

        ]);

        $projeto->tags()->detach();

        $projeto->tags()->attach($request->tags);

        return redirect('publicados');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projeto = Projeto::find($id);

        if (!$projeto || Auth::user()->id != $projeto->user_id) {
            return redirect('/publicados')->with('error', 'Você não tem permissão para excluir este projeto.');
        }

        $projeto->tags()->detach();
    
        $projeto->delete();
    
        return redirect('publicados')->with('msg', 'Trabalho excluído com sucesso!');
    }

    public function publicados() {

        $user = Auth::user();
        $projeto = Projeto::where('user_id', $user->id)->get();

        return view('projetos.publicados', ['projetos' => $projeto ]);
    }

    public function atribuir($id) {

        $projeto = Projeto::find($id);
        $user = Auth::user();

        $projeto->update(['user_projeto_id' => $user->id]);

        if ($projeto->user_projeto_id) {
    
            return redirect('projetos')->with('msg', 'Desculpe, alguém já se inscreveu neste projeto.');
        }
        
        $projeto->update(['user_projeto_id' => $user->id]);
        
        return redirect('projetos')->with('msg', 'Inscrição realizada com sucesso!');

    }
}
