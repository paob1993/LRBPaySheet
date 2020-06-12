<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use App\Models\RegistroNomina;
use App\Models\ReciboEmpleado;


class RegistroNominaReciboEmpleado extends Model {

     /**
     * The table
     *
     * @var string
     */

    protected $table = 'registronomina_reciboempleado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registroNomina_id', 'reciboEmpleado_id', 'monto_base', 'cantidad', 'monto_total'
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
    public function registroNomina(){
        return $this->belongsTo(RegistroNomina::class, 'registroNomina_id');
    }

    /**
     * 
     * @return \App\Models\ReciboEmpleado 
    */
    public function reciboEmpleado(){
        return $this->belongsTo(ReciboEmpleado::class);
    }

}