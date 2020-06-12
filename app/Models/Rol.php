<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Rol extends Model {

    /**
     * @const int Constante que representa el límite de caracteres que se pueden
     * ingresar en el nombre
    */
    const MAX_LENGTH_NOMBRE = 25;

    /**
     * @const int Constante que indica el rol administrador del sistema
    */
    const ROL_ADMINISTRADOR_DEL_SISTEMA = 1;

    /**
     * @const int Constante que indica el rol directivo
    */
    const ROL_DIRECTIVO = 2;

    /**
     * @const int Constante que indica el rol estructura de costos
    */
    const ROL_ESTRUCTURA_DE_COSTOS = 3;

    /**
     * @const int Constante que indica el rol nomina
    */
    const ROL_NOMINA = 4;

    /**
     * @const int Constante que indica el rol empleado
    */
    const ROL_EMPLEADO = 5;

    /**
     *
     * @var array Arreglo que contiene los Roles
    */
    public static $tipos = [
        self::ROL_ADMINISTRADOR_DEL_SISTEMA => 'Administrador Del Sistema',
        self::ROL_DIRECTIVO => 'Directivo',
        self::ROL_ESTRUCTURA_DE_COSTOS => 'Estructura de Costos',
        self::ROL_NOMINA => 'Nómina',
        self::ROL_EMPLEADO => 'Empleado',
    ];

    /**
     * The table
     *
     * @var string
    */

    protected $table = 'rol';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'nombre'
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
     * @return [\App\Models\User] 
    */
    public function users(){
        return $this->hasMany(User::class);
    }

}