<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use App\Models\Recibo;
use App\Models\Empleado;
use App\Models\CodigoNominaReciboEmpleado;


class ReciboEmpleado extends Model {
    use SoftDeletes;
    use Notifiable;

     /**
     * The table
     *
     * @var string
     */

    protected $table = 'recibo_empleado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recibo_id', 'empleado_id', 'valor_por_hora', 'horas_semanales', 'monto_total', 'primer_quincena'
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

    public function empleado() {
        return $this->belongsTo(Empleado::class)->withTrashed();
    }

    /**
     * 
     * @return \App\Models\Recibo 
    */
    public function recibo() {
        return $this->belongsTo(Recibo::class);
    }

    /**
     * 
     * @return \App\Models\CodigoNominaReciboEmpleado
    */
    public function registroNominasReciboEmpleado() {
        return $this->hasMany(RegistroNominaReciboEmpleado::class, 'reciboEmpleado_id');
    }

}