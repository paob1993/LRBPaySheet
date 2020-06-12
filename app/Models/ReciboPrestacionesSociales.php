<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\PrestacionesSociales;

class ReciboPrestacionesSociales extends Model {

     /**
     * The table
     *
     * @var string
     */

    protected $table = 'recibo_prestacionessociales';

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en el trimestre
    */
    const MAX_LENGTH_TRIMESTRE = 1;

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en el año
    */
    const MAX_LENGTH_ANO = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trimestre', 'ano'
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
     * @return [\App\Models\PrestacionesSociales]
    */
    public function prestacionesSociales(){
        return $this->hasMany(PrestacionesSociales::class);
    }

}