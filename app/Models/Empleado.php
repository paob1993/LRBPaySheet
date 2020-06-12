<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use App\User;
use App\Models\Cargo;
use App\Models\Obrero;
use App\Models\Docente;
use App\Models\Cestaticket;
use App\Models\Recordatorio;
use App\Models\Administrativo;
use App\Models\ReciboEmpleado;
use App\Models\VariablesGlobales;
use App\Models\PrestacionesSociales;

use App\OwnModels\OwnArrays;

use Carbon\Carbon;


class Empleado extends Model{
    use SoftDeletes;
    use Notifiable;

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en nombres
    */
    const MAX_LENGTH_NOMBRES = 100;

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en apellidos
    */
    const MAX_LENGTH_APELLIDOS = 100;

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en la cédula
    */
    const MAX_LENGTH_CEDULA = 12;

    /**
     * The table
     *
     * @var string
    */
    protected $table = 'empleado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
      'cargo_id', 'horas_semanales', 'tipo_personal', 'nombres', 'apellidos', 'cedula', 'sso', 'lph', 'tiempo_completo', 'prestaciones_sociales_acumuladas'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
    */
    protected $hidden = [];
    
    protected $dates = [
      'deleted_at','fecha_ingreso'
    ];


    /**
     * 
     * @return \App\Models\User
    */
    public function user(){
        return $this->hasOne(User::class);
    }

    /**
     * 
     * @return \App\Models\Cargo 
    */
    public function cargo(){
        return $this->belongsTo(Cargo::class);
    }

    /**
     * 
     * @return \App\Models\Obrero 
    */
    public function obrero(){
        return $this->hasOne(Obrero::class);
    }

    /**
     * 
     * @return \App\Models\Docente 
    */
    public function docente(){
        return $this->hasOne(Docente::class);
    }

    /**
     * 
     * @return [\App\Models\Cestaticket] 
    */
    public function cestatickets(){
        return $this->hasMany(Cestaticket::class);
    }

    /**
     * 
     * @return [\App\Models\Recordatorio] 
    */
    public function recordatorios(){
        return $this->hasMany(Recordatorio::class);
    }

    /**
     * 
     * @return \App\Models\Administrativo 
    */
    public function administrativo(){
        return $this->hasOne(Administrativo::class);
    }

    /**
     * 
     * @return [\App\Models\ReciboEmpleado] 
    */
    public function recibosEmpleado(){
        return $this->hasMany(ReciboEmpleado::class);
    }

    /**
     * 
     * @return [\App\Models\PrestacionesSociales] 
    */
    public function prestacionesSociales(){
        return $this->belongsTo(PrestacionesSociales::class);
    }

    /**
     * 
     * @return String 
    */
    public function calcularAntiguedad() {
        return Carbon::now()->diffInYears($this->fecha_ingreso).' años y '.(Carbon::now()->diffInMonths($this->fecha_ingreso)%12).' meses';
    }

    /**
     * 
     * @return Double 
    */
    public function antiguedad() {
        return Carbon::now()->diffInYears($this->fecha_ingreso);
    }

    /**
     * 
     * @return String 
    */
    public function obtenerCategoria() {
        $categoria = '';
        if ($this->docente) {
            $categoria = $this->docente->obtenerCategoria();
        } elseif ($this->obrero) {
            $categoria = $this->obrero->clasificacionObrero->grado .'-'. $this->obrero->clasificacionObrero->paso;
        } elseif ($this->administrativo) {
            $categoria = $this->administrativo->clasificacionAdministrativo->nivel .'-'. $this->administrativo->clasificacionAdministrativo->grado;
        }
        return $categoria;
    }

    /**
     *
     * @return double ValorPorHora
     */
    public function obtenerValorPorHora() {
        $valor_por_hora = 0.00;
        if ($this->docente) {
            $valor_por_hora = $this->docente->categoriaDocente->valor_hora;
        } elseif ($this->obrero) {
            $valor_por_hora = $this->obrero->clasificacionObrero->monto;
        } elseif ($this->administrativo) {
            $valor_por_hora = $this->administrativo->clasificacionAdministrativo->monto;
        }
        return $valor_por_hora;        
    }

    /**
     *
     * @return double Número de horas semanales para tiempo completo
     */
    public function obtenerTiempoCompleto() {
        $variable_global_horas = VariablesGlobales::where('descripcion', '=', 'Cantidad de Horas Diarias')->first();
        $horas = VariablesGlobalesTipoEmpleado::where('variablesGlobales_id', $variable_global_horas->id)
            ->where('tipo_empleado', $this->cargo->tipo_empleado)
            ->first()->cantidad;   
        return ($horas * 5);
    }

 }