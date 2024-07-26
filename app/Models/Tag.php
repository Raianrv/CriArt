<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'tags';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name'];

    public function projetos() {
        return $this->belongsToMany('App\Models\Projeto', 'projetoshastags');
    }
}

