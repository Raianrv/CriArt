<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'categorias';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = ['name'];

   public function projetos() {
    return $this->hasMany('App\Models\Projeto', 'categoria_id');
   }

}
