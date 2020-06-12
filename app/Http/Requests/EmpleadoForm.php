<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

use App\Models\Empleado;
use App\OwnModels\OwnArrays;

class EmpleadoForm extends FormRequest {
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
                    // EMPLEADO
                    'cargo_id'                          => 'required|exists:cargo,id',
                    'horas_semanales'                   => 'required',
                    'fecha_ingreso'                     => 'required',
                    'tipo_personal'                     => 'required|in:'.implode(',',array_keys(OwnArrays::$tipos_de_personal)),
                    'nombres'                           => 'required|max:'.Empleado::MAX_LENGTH_NOMBRES,
                    'apellidos'                         => 'required|max:'.Empleado::MAX_LENGTH_APELLIDOS,
                    'cedula'                            => 'required|unique:empleado,cedula|max:'.Empleado::MAX_LENGTH_CEDULA,
                    'sso'                               => 'boolean',
                    'lph'                               => 'boolean',
                    'tiempo_completo'                   => 'required|boolean',
                    'prestaciones_sociales_acumuladas'  => 'required|numeric|min:0',
                    'tipo_empleado'                     => 'required',
                    // DOCENTE              
                    'titulo_docente'                    => 'required_if:tipo_empleado,'.OwnArrays::EMPLEADO_DOCENTE.'|in:'.implode(',',array_keys(OwnArrays::$descripciones_titulos)),
                    'especializacion'                   => 'boolean',
                    'postgrado'                         => 'boolean',
                    // OTRO EMPLEADO
                    'nivel_instruccion'                 => 'required_if:tipo_empleado,'.OwnArrays::EMPLEADO_OBRERO.','.OwnArrays::EMPLEADO_ADMINISTRATIVO.'|in:'.implode(',',array_keys(OwnArrays::$niveles_instruccion)),
                    // ADMINISTRATIVO
                    'clasificacion_administrativo_id'   => 'required_if:tipo_empleado,'.OwnArrays::EMPLEADO_ADMINISTRATIVO.'|exists:clasificacion_administrativo,id',
                    // OBRERO
                    'clasificacion_obrero_id'           => 'required_if:tipo_empleado,'.OwnArrays::EMPLEADO_OBRERO.'|exists:clasificacion_obrero,id',
                ];
            case 'PUT':
                return [
                    // EMPLEADO
                    'cargo_id'                          => 'exists:cargo,id',
                    'horas_semanales'                   => '',
                    'fecha_ingreso'                     => '',
                    'tipo_personal'                     => 'in:'.implode(',',array_keys(OwnArrays::$tipos_de_personal)),
                    'nombres'                           => 'max:'.Empleado::MAX_LENGTH_NOMBRES,
                    'apellidos'                         => 'max:'.Empleado::MAX_LENGTH_APELLIDOS,
                    'cedula'                            => 'max:'.Empleado::MAX_LENGTH_CEDULA,
                    'sso'                               => 'boolean',
                    'lph'                               => 'boolean',
                    'tiempo_completo'                   => 'boolean',
                    'prestaciones_sociales_acumuladas'  => 'numeric|min:0',
                    // DOCENTE              
                    'titulo_docente'                    => 'in:'.implode(',',array_keys(OwnArrays::$descripciones_titulos)),
                    'especializacion'                   => 'boolean',
                    'postgrado'                         => 'boolean',
                    // OTRO EMPLEADO
                    'nivel_instruccion'                 => 'in:'.implode(',',array_keys(OwnArrays::$niveles_instruccion)),
                    // ADMINISTRATIVO
                    'clasificacion_administrativo_id'   => 'exists:clasificacion_administrativo,id',
                    // OBRERO
                    'clasificacion_obrero_id'           => 'exists:clasificacion_obrero,id',
                ];
            default:return[];
        }
    }
    
    public function messages() {
        return [
            // EMPLEADO
            'cargo_id.required'                         => 'Debe ingresar el cargo',
            'cargo_id.exists'                           => 'El cargo ingresado es invalido',
            'horas_semanales.required'                  => 'Debe ingresar las horas semanales.',
            'fecha_ingreso.required'                    => 'Debe ingresar la fecha de ingreso.',
            'tipo_personal.required'                    => 'Debe ingresar el tipo de personal',
            'tipo_personal.in'                          => 'El tipo de personal ingresado es invalido',
            'nombres.required'                          => 'Debe ingresar el nombre.',
            'nombres.max'                               => 'El nombre debe contener un máximo :max caracteres.',
            'apellidos.required'                        => 'Debe ingresar el apellido.',
            'apellidos.max'                             => 'El apellido debe contener un máximo :max caracteres.',
            'cedula.required'                           => 'Debe ingresar la cédula de identidad.',
            'cedula.unique'                             => 'La cédula de identidad ya está asociada a otro empleado.',
            'cedula.max'                                => 'La cédula de identidad debe contener un máximo :max caracteres.',
            'prestaciones_sociales_acumuladas.required' => 'Debe ingresar el valor de las prestaciones sociales acumuladas',
            'prestaciones_sociales_acumuladas.numeric'  => 'El valor de las prestaciones sociales acumuladas debe ser un número',
            'prestaciones_sociales_acumuladas.min'      => 'El valor de las prestaciones sociales acumuladas debe ser positivo',
            'tiempo_completo.required'                  => 'Debe determinar si el empleado es tiempo completo',
            'tiempo_completo.boolean'                   => 'El valor seleccionado para el tiempo completo es invalido',
            // DOCENTE            
            'categoria_docente_id.exists'               => 'La categoría docente ingresada es inválido',
            'titulo_docente.in'                         => 'El título docente ingresado es inválido',
            'especializacion.boolean'                   => 'La especialización ingresada es inválida',
            'postrago.boolean'                          => 'El postgrado ingresado es inválido',
            // OTRO EMPLEADO
            'nivel_instruccion.in'                      => 'El nivel de instrucción no es válido',
            // ADMINISTRATIVO
            'clasificacion_administrativo_id.exists:'   => 'La clasificaión ingresada es inválida',
            // OBRERO
            'clasificacion_obrero_id.exists'            => 'La clasificaión ingresada es inválida',            
        ];
    }
}
