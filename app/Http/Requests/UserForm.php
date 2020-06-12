<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

use App\User;

class UserForm extends FormRequest {
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
                    'cedula'            =>      'required|unique:user,cedula|max:'.User::MAX_LENGTH_CEDULA,
                    'password'          =>      'required|max:'.User::MAX_LENGTH_PASSWORD,
                    'rol_id'            =>      'exists:rol,id',
                    'empleado_id'       =>      'exists:empleado,id'
                ];
            case 'PUT':
                return [
                    'cedula'            =>      'max:'.User::MAX_LENGTH_CEDULA,
                    'password'          =>      'max:'.User::MAX_LENGTH_PASSWORD,
                    'rol_id'            =>      'exists:rol,id',
                    'empleado_id'       =>      'exists:empleado,id'
                ];
            default:return[];
        }
    }
    
    public function messages() {
        return [
            'cedula.required'           =>      'Debe ingresar la cédula.',
            'cedula.unique'             =>      'La cédula ya tiene un usuario asociado.',
            'cedula.max'                =>      'La cédula debe contener un máximo de :max caracteres.',
            'password.required'         =>      'Debe ingresar la contraseña.',
            'password.max'              =>      'La contraseña debe contener un máximo de :max caracteres.',
            'rol_id.exists'             =>      'El rol ingresado es inválido.',
            'empleado_id.exists'        =>      'El empleado ingresado es inválido.',
        ];
    }
}