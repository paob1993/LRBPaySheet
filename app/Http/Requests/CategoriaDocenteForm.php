<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

use App\Models\CategoriaDocente;

class CategoriaDocenteForm extends FormRequest {
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
            case 'PUT':
                return [
                    'abreviatura'            =>      'max:'.CategoriaDocente::MAX_LENGTH_ABREVIATURA,
                    'categoria'              =>      'max:'.CategoriaDocente::MAX_LENGTH_CATEGORIA,
                    'anos'                   =>      'integer|min:0',
                    'esp_post'               =>      'boolean',
                    'valor_hora'             =>      'numeric|min:0'
                ];
            default:return[];
        }
    }
    
    public function messages() {
        return [
            'abreviatura.max'           =>      'La abreviatura debe contener un máximo de :max caracteres.',
            'categoria.max'             =>      'La categoria debe contener un máximo de :max caracteres.',
            'anos.integer'              =>      'La cantidad de años debe ser un entero.',
            'anos.min'                  =>      'La cantidad de años debe ser positiva',
            'esp_post.boolean'          =>      'No es válido el valo de especialización o postgrado',
            'valor_hora.numeric'        =>      'El valor por hora debe ser numérico.',
            'valor_hora.min'            =>      'El valor por hora debe se positivo.'
        ];
    }
}
