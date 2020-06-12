<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use App\Models\VariablesGlobales;

class VariablesGlobalesTipoEmpleado extends Model{
    use Notifiable;

  /**
  * The table
  *
  * @var string
  */

  protected $table = 'variablesglobales_tipoempleado';

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'variables_globales_id' , 'tipo_empleado', 'cantidad'
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
     * @return \App\Models\VariablesGlobales
    */

    public function variablesGlobales() {
      return $this->belongsTo(VariablesGlobales::class);
    }

  }
