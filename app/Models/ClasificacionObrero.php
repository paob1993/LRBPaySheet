<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Obrero;

class ClasificacionObrero extends Model{

    /**
     * The table
     *
     * @var string
    */
    protected $table = 'clasificacion_obrero';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'paso', 'grado', 'monto'
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
     * @return [\App\Models\Obrero]
    */
    public function obreros(){
        return $this->hasMany(Obrero::class);
    }

}