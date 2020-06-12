<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\CodigoNomina;
use App\Models\RegistroNominaTipoEmpleado;
use App\Models\RegistroNominaReciboEmpleado;

use App\OwnModels\OwnArrays;

class RegistroNomina extends Model{

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en el nombre
    */
    const MAX_LENGTH_NOMBRE = 45;

    /**
     * @const int Constante que representa el límite de caracteres que se pueden ingresar en el código
    */
    const MAX_LENGTH_CODIGO = 8;
    
    /**
     * The table
     *
     * @var string
    */
    protected $table = 'registro_nomina';

    /**
     * The attributes that are mass assignable.
     *º
     * @var array
    */
    protected $fillable = [
        'nombre', 'cantidad', 'codigo_nomina', 'tipo_valor', 'tipo_nomina', 'basado_en', 'requerido', 'determinado', 'carga_horaria'
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
     * @return [\App\Models\RegistroNominaTipoEmpleado]
    */
    public function registroNominaTiposEmpleado(){
        return $this->hasMany(RegistroNominaTipoEmpleado::class, 'registroNomina_id');
    }

    /**
     * 
     * @return [\App\Models\RegistroNominaReciboEmpleado]
    */
    public function registroNominaReciboEmpleado(){
        return $this->hasMany(RegistroNominaReciboEmpleado::class, 'registroNomina_id');
    }

    /**
     * 
     * @return String 
    */
    public function obtenerParaTipoEmpleado($tipo) {
        $valor = 'No Aplica';
        foreach ($this->registroNominaTiposEmpleado as $te) {
          if ($te->tipo_empleado === $tipo) {
            if ($valor !== 'No Aplica') {
                $valor .= " - " .$te->cantidad;
            } else {
                if ($te->cantidad == 0) {
                    $valor = "-";
                } else {
                    $valor = $te->cantidad;  
                }              
            }
          }
        }
        return $valor;
    }

    /**
     * 
     * @return RegistroNominaTipoEmpleado
    */
    public function verificarSiExiste($tipoRequerimiento, $tipoEmpleado) {
        $rnte = false;
        foreach ($this->registroNominaTiposEmpleado as $te) {
          if ($te->tipo_empleado === $tipoEmpleado && $te->depende_de === $tipoRequerimiento) {
            $rnte = $te;
          }
        }
        return $rnte;
    }

    /**
     * 
     * @return boolean aplica
    */
    public function aplicaParaEmpleado($empleado) {
        $aplica = false;
        foreach ($this->registroNominaTiposEmpleado as $te) {
          if ($te->tipo_empleado === $empleado->cargo->tipo_empleado) {
            if ($te->depende_de === OwnArrays::REQUIERE_NINGUNO) {
              $aplica = true;
            } elseif ($empleado->obrero) {
                if(($te->depende_de === OwnArrays::REQUIERE_TSU && $empleado->obrero->nivel_instruccion === OwnArrays::NIVEL_TSU) ||
                ($te->depende_de === OwnArrays::REQUIERE_LICENCIADO && $empleado->obrero->nivel_instruccion === OwnArrays::NIVEL_LICENCIADO)
                ) {
                    $aplica = true;
                }
            } elseif ($empleado->administrativo) {
                if(($te->depende_de === OwnArrays::REQUIERE_TSU && $empleado->administrativo->nivel_instruccion === OwnArrays::NIVEL_TSU) ||
                ($te->depende_de === OwnArrays::REQUIERE_LICENCIADO && $empleado->administrativo->nivel_instruccion === OwnArrays::NIVEL_LICENCIADO)
                ) {
                    $aplica = true;
                }
            } elseif ($empleado->docente) {
                if (($te->depende_de === OwnArrays::REQUIERE_ESPECIALIZACION && $empleado->docente->especializacion === 1) ||
                    ($te->depende_de === OwnArrays::REQUIERE_POSTGRADO && $empleado->docente->postgrado === 1)
                ) {
                    $aplica = true;
                }
            }
          }
        }
        return $aplica;
    }

    /**
     * 
     * @return Double cantidad
    */
    public function obtenerCantidad($empleado) {
        $cantidad = 0;
        foreach ($this->registroNominaTiposEmpleado as $te) {
          if ($te->tipo_empleado === $empleado->cargo->tipo_empleado) {
            if ($te->depende_de === OwnArrays::REQUIERE_NINGUNO) {
              $cantidad = $te->cantidad;
            } elseif ($empleado->obrero) {
                if ($te->depende_de === OwnArrays::REQUIERE_LICENCIADO && $empleado->obrero->nivel_instruccion === OwnArrays::NIVEL_LICENCIADO) {
                  $cantidad = $te->cantidad;
                } elseif ($te->depende_de === OwnArrays::REQUIERE_TSU && $empleado->obrero->nivel_instruccion === OwnArrays::NIVEL_TSU) {
                  $cantidad = $te->cantidad;
                }
              } elseif ($empleado->administrativo) {
                if ($te->depende_de === OwnArrays::REQUIERE_LICENCIADO && $empleado->administrativo->nivel_instruccion === OwnArrays::NIVEL_LICENCIADO) {
                  $cantidad = $te->cantidad;
                } elseif ($te->depende_de === OwnArrays::REQUIERE_TSU && $empleado->administrativo->nivel_instruccion === OwnArrays::NIVEL_TSU) {
                  $cantidad = $te->cantidad;
                }
              } elseif ($empleado->docente) {
                  if ($te->depende_de === OwnArrays::REQUIERE_POSTGRADO && $empleado->docente->postgrado === 1) {
                      $cantidad = $te->cantidad;
                    } elseif ($te->depende_de === OwnArrays::REQUIERE_ESPECIALIZACION && $empleado->docente->especializacion === 1) {
                        $cantidad = $te->cantidad;
                    }
                }
            }
        }
        return $cantidad;
    }

    /**
     * 
     * @return Double base
    */
    public function obtenerBase($empleado, $sueldo_base) {
        $base = 0;
        switch ($this->basado_en) {
            case OwnArrays::BASADO_EN_NO_APLICA:
                $base = 1;
                break;
            case OwnArrays::BASADO_EN_SUELDO_BASE:
                $base = $sueldo_base;
                break;
            case OwnArrays::BASADO_EN_ANTIGUEDAD:
                $base = $empleado->antiguedad();
                break;
            case OwnArrays::BASADO_EN_SUELDO_DIARIO:
                $base = ($empleado->obtenerValorPorHora()*$empleado->horas_semanales)/5;
                break;
            case OwnArrays::BASADO_EN_VALOR_POR_HORA:
                $base = $empleado->obtenerValorPorHora();
                break;            
            default:
                $base = 1;
                break;
        }
        return $base;
    }

    /**
     * 
     * @return strign tipo
    */
    public function obtenerTipoBase() {
        $tipo = '';
        switch ($this->basado_en) {
            case OwnArrays::BASADO_EN_NO_APLICA:
                $tipo = 'na';
                break;
            case OwnArrays::BASADO_EN_SUELDO_BASE:
                $tipo = 'sb';
                break;
            case OwnArrays::BASADO_EN_ANTIGUEDAD:
                $tipo = 'ant';
                break;
            case OwnArrays::BASADO_EN_SUELDO_DIARIO:
                $tipo = 'sd';
                break;
            case OwnArrays::BASADO_EN_VALOR_POR_HORA:
                $tipo = 'vh';
                break;            
            default:
                $tipo = '';
                break;
        }
        return $tipo;
    }

}