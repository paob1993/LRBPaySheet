<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Rol;
use App\Models\Empleado;

use Auth;

class User extends Authenticatable{
    use Notifiable;
    
    /**
     * The table
     *
     * @var string
    */

    protected $table = 'user';

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en la cedula
    */
    const MAX_LENGTH_CEDULA = 12;

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en la contraseña
    */
    const MAX_LENGTH_PASSWORD = 15;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'cedula', 'rol_id', 'empleado_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
    ];

    /**
     * 
     * @return \App\Models\Rol 
    */
    public function rol(){
        return $this->belongsTo(Rol::class);
    }

    /**
     * 
     * @return \App\Models\Empleado 
    */
    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }

    /**
     * Retorna verdadero si el usuario es administrador del sistema
     * 
     * @return boolean
    */
    public function isAdministradorDelSistema() {
        return $this->rol_id == Rol::ROL_ADMINISTRADOR_DEL_SISTEMA;
    }

    /**
     * Retorna verdadero si el usuario es un directivo
     * 
     * @return boolean
    */
    public function isDirectivo() {
        return $this->rol_id == Rol::ROL_DIRECTIVO;
    }

    /**
     * Retorna verdadero si el usuario es quien maneja la estructura de costos
     * 
     * @return boolean
    */
    public function isEstructuraDeCostos() {
        return $this->rol_id == Rol::ROL_ESTRUCTURA_DE_COSTOS;
    }

    /**
     * Retorna verdadero si el usuario es quien maneja la nómina
     * 
     * @return boolean
    */
    public function isNomina() {
        return $this->rol_id == Rol::ROL_NOMINA;
    }

    /**
     * Retorna verdadero si el usuario es empleado
     * 
     * @return boolean
    */
    public function isEmpleado() {
        return $this->rol_id == Rol::ROL_EMPLEADO;
    }

}
