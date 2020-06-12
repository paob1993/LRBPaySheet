<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use App\Models\Empleado;

class Recordatorios extends Model {
    use SoftDeletes;
    use Notifiable;

     /**
     * The table
     *
     * @var string
     */

    protected $table = 'recordatorio';

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en la nota
    */
    const MAX_LENGTH_NOTA = 500;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empleado_id', 'nota'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    
    protected $dates = [
        'fecha', 'deleted_at'
    ];

    /**
     * 
     * @return \App\Models\Empleado 
    */
    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }

}