<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use App\Models\Empleado;
use App\Models\ClasificacionAdministrativo;

class Administrativo extends Model{
    use SoftDeletes;
    use Notifiable;

    /**
    * The table
    *
    * @var string
    */
    protected $table = 'administrativo';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
      'empleado_id', 'nivel_instruccion', 'clasificacion_administrativo_id'
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [];

    protected $dates = [
      'deleted_at'
    ];

    /**
     * 
     * @return \App\Models\Empleado
    */
    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }

    /**
     * 
     * @return \App\Models\ClasificacionAdministrativo
    */
    public function clasificacionAdministrativo(){
        return $this->belongsTo(ClasificacionAdministrativo::class);
    }
  
}
