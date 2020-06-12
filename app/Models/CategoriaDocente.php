<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Docente;

class CategoriaDocente extends Model{

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en la abreviatura
    */
    const MAX_LENGTH_ABREVIATURA = 3;

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en la categoria
    */
    const MAX_LENGTH_CATEGORIA = 45;

    /**
     * The table
     *
     * @var string
    */
    protected $table = 'categoria_docente';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'abreviatura', 'categoria', 'anos', 'esp_post', 'valor_hora'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
    */
    protected $hidden = [];
    
    protected $dates = [];


    /**
     * 
     * @return [\App\Models\Docente] 
    */
    public function docentes(){
        return $this->hasMany(Docente::class);
    }
}