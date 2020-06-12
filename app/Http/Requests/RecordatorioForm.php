<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;
use App\Models\Recordatorios;

class RecordatorioForm extends FormRequest {
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
                    'empleado_id'       =>      'exists:empleado,id',
                    'nota'              =>      'required|max:'.Recordatorios::MAX_LENGTH_NOTA,
                    'fecha'             =>      'required'
                ];
            case 'PUT':
                return [
                    'empleado_id'       =>      'exists:empleado,id',
                    'nota'              =>      'max:'.Recordatorios::MAX_LENGTH_NOTA,
                    'fecha'             =>      ''

                ];
            default:return[];
        }
    }

    public function messages() {
        return [
            'empleado_id.exists'        =>      'El empleado ingresado es inválido.',
            'nota.required'             =>      'Debe ingresar la descripción de la nota.',
            'fecha.required'            =>      'Debe ingresar la fecha.'
        ];
    }
}
