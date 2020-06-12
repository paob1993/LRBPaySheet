<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

use App\Models\Cargo;
use App\OwnModels\OwnArrays;

class CargoForm extends FormRequest {
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
        switch($this->method()) {
            case 'POST':
                return [
                    'abreviatura'       =>      'required|unique:cargo,abreviatura|max:'.Cargo::MAX_LENGTH_ABREVIATURA,
                    'descripcion'       =>      'required|max:'.Cargo::MAX_LENGTH_DESCRIPCION,
                    'tipo_empleado'     =>      'required|in:'.implode(',',array_keys(OwnArrays::$tipos_empleados)),
                ];
            case 'PUT':
                return [
                    'abreviatura'       =>      'max:'.Cargo::MAX_LENGTH_ABREVIATURA,
                    'descripcion'       =>      'max:'.Cargo::MAX_LENGTH_DESCRIPCION,
                    'tipo_empleado'     =>      'in:'.implode(',',array_keys(OwnArrays::$tipos_empleados)),
                ];
            default:return[];
        }
    }
    
    public function messages() {
        return [
            'abreviatura.required'      =>      'Debe ingresar la abreviatura.',
            'abreviatura.unique'        =>      'La abreviatura debe ser única.',
            'abreviatura.max'           =>      'La abreviatura debe contener un máximo de :max caracteres.',
            'descripcion.required'      =>      'Debe ingresar la descripción.',
            'descripcion.max'           =>      'La descripción debe contener un máximo de :max caracteres.',
            'tipo_empleado.required'    =>      'Debe ingresar un tipo de empleado.',
            'tipo_empleado.in'          =>      'El tipo de empleado ingresado es inválido.',
        ];
    }
}