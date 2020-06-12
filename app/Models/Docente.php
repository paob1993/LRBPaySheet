<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use App\Models\CategoriaDocente;
use App\Models\Empleado;

use Carbon\Carbon;

class Docente extends Model{
    use SoftDeletes;
    use Notifiable;

    /**
     * The table
     *
     * @var string
    */
    protected $table = 'docente';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'empleado_id', 'categoria_docente_id', 'titulo_docente','especializacion','postgrado'
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
     * @return \App\Models\CategoriaDocente
    */
    public function categoriaDocente(){
        return $this->belongsTo(CategoriaDocente::class);
    }

    /**
     * 
     * @return \App\Models\Empleado
    */
    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }

    public function obtenerCategoria() {
        $categorias = CategoriaDocente::all();
        $anos = Carbon::now()->diffInYears($this->empleado->fecha_ingreso);
        $esp_post = $this->especializacion == 1 ? 1 : $this->postgrado == 1 ? 1 : 0;
        $nuevaCategoria = 1;
        for ($i=0; $i<count($categorias)-1; $i++) { 
            if($categorias[$i]->anos <= $anos && $categorias[$i+1]->anos > $anos){
                if($categorias[$i+1]->esp_post == 1){
                    if($esp_post == 1){
                        $nuevaCategoria = $categorias[$i+1]->id;
                    } else {
                        $nuevaCategoria = $categorias[3]->id;
                    }
                }
                else {
                    $nuevaCategoria = $categorias[$i+1]->id;                    
                }
            }
        }
        if($this->categoria_docente_id != $nuevaCategoria){
            $this->categoria_docente_id = $nuevaCategoria;
            $this->save();
        }
        return $this->categoriaDocente->abreviatura;
    }

}