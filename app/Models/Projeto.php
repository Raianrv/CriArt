<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projetos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'titulo', 'descricao', 'data_inicial', 'data_final', 'user_projeto_id', 'categoria_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'data_inicial', 'data_final'];

    public function usuario() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function usuarioProjeto() {
        return $this->belongsTo('App\Models\User', 'user_projeto_id');
    }

    public function categoria() {
        return $this->belongsTo('App\Models\Categoria', 'categoria_id');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag', 'projetoshastags');
    }
}
