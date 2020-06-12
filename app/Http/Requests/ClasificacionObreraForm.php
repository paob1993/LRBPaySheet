<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

use App\Models\ClasificacionObrero;

class ClasificacionObreraForm extends FormRequest {
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
                    'paso'             =>      'numeric:',
                    'grado'            =>      'numeric:',
                    'monto'            =>      'numeric|min:0'
                ];
            default:return[];
        }
    }
    
    public function messages() {
        return [
            'paso.max'                 =>      'El paso debe contener un máximo de :max caracteres.',
            'grado.max'                =>      'El grado debe contener un máximo de :max caracteres.',
            'monto.numeric'            =>      'El monto debe ser numérico.',
            'monto.min'                =>      'El monto debe se positivo.'
        ];
    }
}