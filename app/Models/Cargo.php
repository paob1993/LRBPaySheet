<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Cargo extends Model {  
    use SoftDeletes;
    use Notifiable;

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en la abreviatura
    */
    const MAX_LENGTH_ABREVIATURA = 5;

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en la descripción
    */
    const MAX_LENGTH_DESCRIPCION = 100;

    /**
     * The table
     *
     * @var string
    */
    protected $table = 'cargo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
      'abreviatura','descripcion','tipo_empleado'
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

}
