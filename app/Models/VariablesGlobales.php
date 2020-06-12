<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\VariablesGlobalesTipoEmpleado;
use App\OwnModels\OwnArrays;

class VariablesGlobales extends Model{

  /**
  * The table
  *
  * @var string
  */
  protected $table = 'variables_globales';

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'descripcion', 'cantidad', 'tipo_valor', 'formula'
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
     * @return [\App\Models\VariablesGlobalesTiposEmpleados]
    */
    public function variablesGlobalesTiposEmpleado(){
      return $this->hasMany(VariablesGlobalesTipoEmpleado::class, 'variablesGlobales_id');
    }

    /**
     * 
     * @return String 
    */
    public function obtenerParaTipoEmpleado($tipo) {
        $valor = 'No Aplica';
        foreach ($this->variablesGlobalesTiposEmpleado as $te) {
          if ($te->tipo_empleado === $tipo) {
            $valor = $te->cantidad;
          }
        }
        return $valor;
    }

  }
