<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Cestaticket;
use App\Models\ReciboEmpleado;

class Recibo extends Model {

    /**
     * The table
     *
     * @var string
    */
    protected $table = 'recibo';

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en el mes
    */
    const MAX_LENGTH_MES = 2;

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
        'mes', 'ano', 'completo'
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
     * @return [\App\Models\Cestaticket]
    */
    public function cestatickets(){
        return $this->hasMany(Cestaticket::class);
    }

    /**
     * 
     * @return [\App\Models\ReciboEmpleado]
    */
    public function recibosEmpleados(){
        return $this->hasMany(ReciboEmpleado::class);
    }

}