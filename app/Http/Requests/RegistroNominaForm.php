<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

use App\OwnModels\OwnArrays;
use App\Models\RegistroNomina;

use Illuminate\Validation\Rule;

class RegistroNominaForm extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    public function all() {
        // Include the next line if you need form data, too.
        $request = Input::all();
        if($this->route('id')){
            $request['id'] = $this->route('id');
        }

        return $request;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $registro = RegistroNomina::find($this->route('id'));   
        switch($this->method()) {
            case 'POST':
                return [
                    'nombre'            =>      'required|max:'.RegistroNomina::MAX_LENGTH_NOMBRE,
                    'tipo_valor'        =>      'required|in:'.implode(',',array_keys(OwnArrays::$tipos_valor)),
                    'codigo_nomina'     =>      'required|unique:registro_nomina,codigo_nomina|max:'.RegistroNomina::MAX_LENGTH_CODIGO,
                    'tipo_nomina'       =>      'required|in:'.implode(',',array_keys(OwnArrays::$tipos_nominas)),
                    'basado_en'         =>      'required|in:'.implode(',',array_keys(OwnArrays::$basados_en)), 
                    'determinado'       =>      'required|in:'.implode(',',array_keys(OwnArrays::$tipos_registros_nomina)),  
                    'carga_horaria'     =>      'required|boolean',    
                ];
            case 'PUT':
                return [
                    'nombre'            =>      'max:'.RegistroNomina::MAX_LENGTH_NOMBRE,
                    'tipo_valor'        =>      'in:'.implode(',',array_keys(OwnArrays::$tipos_valor)),
                    'codigo_nomina'     =>      ['max:'.RegistroNomina::MAX_LENGTH_CODIGO, Rule::unique('registro_nomina')->ignore($registro->id)],
                    'tipo_nomina'       =>      'in:'.implode(',',array_keys(OwnArrays::$tipos_nominas)),
                    'basado_en'         =>      'in:'.implode(',',array_keys(OwnArrays::$basados_en)), 
                    'determinado'       =>      'in:'.implode(',',array_keys(OwnArrays::$tipos_registros_nomina)), 
                    'carga_horaria'     =>      'boolean',

                ];
            default:return[];
        }
    }

    public function messages() {
        return [
            'nombre.required'           =>      'Debe ingresar el nombre.',
            'tipo_valor.required'       =>      'Debe ingresar un tipo de valor.',
            'tipo_valor.in'             =>      'El tipo de valor ingresado es inválido.',
            'codigo_nomina.required'    =>      'El código nómina  es requerido.',
            'codigo_nomina.unique'      =>      'El código debe ser unico',
            'tipo_nomina.required'      =>      'Debe ingresar un tipo de nómina.',
            'tipo_nomina.in'            =>      'El tipo de nómina ingresado es inválido.',
            'basado_en.required'        =>      'Debe ingresar una opción',
            'basado_en.in'              =>      'La opción ingresada es inválida.',
            'determinado.required'      =>      'Debe ingresar una opción',
            'determinado.in'            =>      'La opción ingresada es inválida.',
            'carga_horaria.required'    =>      'Debe indicar si debe prorratearse o no.',
            'carga_horaria.boolean'     =>      'Debe indicar si debe prorratearse o no.',
        ];
    }
}
