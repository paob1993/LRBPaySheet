<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use App\Models\Recibo;
use App\Models\Empleado;

class Cestaticket extends Model{
    use SoftDeletes;
    use Notifiable;

    /**
     * The table
     *
     * @var string
    */
    protected $table = 'cestaticket';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'empleado_id','recibo_id', 'cestaticket_valor', 'faltas', 'tickets_mes', 'asignacion'
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
     * @return \App\Models\Recibo
    */
    public function recibo(){
        return $this->belongsTo(Recibo::class);
    }

    /**
     * 
     * @return \App\Models\Empleado
    */
    public function empleado(){
        return $this->belongsTo(Empleado::class)->withTrashed();
    }

}