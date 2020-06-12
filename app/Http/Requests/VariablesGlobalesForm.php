<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

use App\OwnModels\OnwArrays;

class VariablesGlobalesForm extends FormRequest {
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
                    'valor_administrativo'          =>      'required|numeric|min:0',
                    'valor_obrero'                  =>      'required|numeric|min:0',
                    'valor_docente'                 =>      'required|numeric|min:0',
                ];
            case 'PUT':
                return [
                    'valor_administrativo'          =>      'numeric|min:0',
                    'valor_obrero'                  =>      'numeric|min:0',
                    'valor_docente'                 =>      'numeric|min:0',
                ];
            default:return[];
        }
    }
    
    public function messages() {
        return [
            'valor_administrativo.required'         =>      'Debe ingresar la cantidad para el administrativo',
            'valor_administrativo.numeric'          =>      'La cantidad para el administrativo debe ser un número',
            'valor_administrativo.min'              =>      'La cantidad para el administrativo debe ser un valor positivo',
            'valor_obrero.required'                 =>      'Debe ingresar la cantidad para el obrero',
            'valor_obrero.numeric'                  =>      'La cantidad para el obrero debe ser un número',
            'valor_obrero.min'                      =>      'La cantidad para el obrero debe ser un valor positivo',
            'valor_docente.required'                =>      'Debe ingresar la cantidad para el docente',
            'valor_docente.numeric'                 =>      'La cantidad para el docente debe ser un número',
            'valor_docente.min'                     =>      'La cantidad para el docente debe ser un valor positivo',  
        ];
    }
}
