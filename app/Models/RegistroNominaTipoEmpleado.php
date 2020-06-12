<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\RegistroNomina;


class RegistroNominaTipoEmpleado extends Model {

     /**
     * The table
     *
     * @var string
     */

    protected $table = 'registronomina_tipoempleado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registroNomina_id', 'cantidad', 'tipo_empleado', 'depende_de', 
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
     * @return \App\Models\RegistroNomina
    */

    public function registroNomina() {
        return $this->belongsTo(RegistroNomina::class);
    }

}