<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Administrativo;

class ClasificacionAdministrativo extends Model{
    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en el nivel
    */
    const MAX_LENGTH_NIVEL = 4;

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en el paso
    */
    const MAX_LENGTH_GRADO = 3;

    /**
     * The table
     *
     * @var string
    */
    protected $table = 'clasificacion_administrativo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'nivel', 'grado', 'monto'
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
     * @return [\App\Models\Administrativo]
    */
    public function administrativos(){
        return $this->hasMany(Administrativo::class);
    }
}