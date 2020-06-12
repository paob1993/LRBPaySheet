<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RegistroNomina;
use App\Models\RegistroNominaTipoEmpleado;
use App\OwnModels\Utilidades;
use App\OwnModels\OwnArrays;
use App\Http\Requests\RegistroNominaForm;

use Auth;

class RegistroNominaController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        /**
         * Verificar que el usuario en sesión tenga permisos de ver el index
         */

        if (Auth::user()->cannot('index',RegistroNomina::class)) {
            return redirect()->route('/');
        }

        /**
         * Filtros
         */
        $cantidad = Utilidades::getWithDefault(filter_input(INPUT_GET, 'cantidad', FILTER_SANITIZE_NUMBER_INT), 15);
        $nombre = filter_input(INPUT_GET, 'nombre', FILTER_SANITIZE_STRING);
        $tipo_valor = filter_input(INPUT_GET, 'tipo_valor', FILTER_SANITIZE_NUMBER_INT);
        $codigo_nomina = filter_input(INPUT_GET, 'codigo_nomina', FILTER_SANITIZE_STRING);
        $tipo_nomina = filter_input(INPUT_GET, 'tipo_nomina', FILTER_SANITIZE_NUMBER_INT);
        $basado_en = filter_input(INPUT_GET, 'basado_en', FILTER_SANITIZE_NUMBER_INT);

        $registrosNomina = RegistroNomina::orderBy('id','asc');

        /**
         * Aplicar filtros
         */   
        if ($nombre) {
           $registrosNomina = $registrosNomina->where('nombre', 'LIKE', "%$nombre%");
        }

        if ($tipo_valor) {
            $registrosNomina = $registrosNomina->where('tipo_valor', $tipo_valor);
        }

        if ($codigo_nomina) {
            $registrosNomina = $registrosNomina->where('codigo_nomina', 'LIKE', "%$codigo_nomina%");
        }

        if ($tipo_nomina) {
            $registrosNomina = $registrosNomina->where('tipo_nomina', $tipo_nomina);
        }

        if ($basado_en) {
            $registrosNomina = $registrosNomina->where('basado_en', $basado_en);
        }

        return view('pages.registroNomina.index',[
           'registrosNomina' => $registrosNomina->paginate($cantidad), 
           'busqueda_cantidad' => $cantidad,
           'nombre' => $nombre,
           'tipo_valor' => $tipo_valor,
           'codigo_nomina'=> $codigo_nomina,
           'tipo_nomina' => $tipo_nomina,
           'basado_en' => $basado_en
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistroNominaForm $request) {
        if (Auth::user()->cannot('create', RegistroNomina::class)) {
            return redirect()->route('');
        }   

        /**
         * Crear el Registro Nómina
         */
        $registro_nomina_to_add = new RegistroNomina();
        $registro_nomina_to_add->basado_en = $request->basado_en;
        $registro_nomina_to_add->codigo_nomina = $request->codigo_nomina;
        $registro_nomina_to_add->nombre = $request->nombre;
        $registro_nomina_to_add->requerido = 0;
        $registro_nomina_to_add->tipo_nomina = $request->tipo_nomina;
        $registro_nomina_to_add->tipo_valor = $request->tipo_valor;
        $registro_nomina_to_add->determinado = $request->determinado;
        $registro_nomina_to_add->carga_horaria = $request->carga_horaria;

        /**
         * Guardar el Registro Nómina
         */
        if(!$registro_nomina_to_add->save()) {
        return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido agregar correctamente el registro nómina."))->withInput();
        }

        /**
         * Verificar los tipos de requerimientos para los que aplica
         */
        foreach (OwnArrays::$requiere_prima_value as $key => $value) {
            if ($request->$value) {
                // Aplica para este tipo de empleado
                foreach (OwnArrays::$tipos_empleados_value as $keyTE => $valueTE) {
                    $tipo = $valueTE.'-'.$value;
                    if ($request->$tipo) {
                        // Aplica para este empleado, Verificar los montos para cada empleado
                        $cantidad = 'cantidad_'.$valueTE.'_'.$value;
                        $registro_nomina_tipo_empleado_to_add = new RegistroNominaTipoEmpleado();
                        $registro_nomina_tipo_empleado_to_add->cantidad = $request->$cantidad;
                        $registro_nomina_tipo_empleado_to_add->depende_de = $key;
                        $registro_nomina_tipo_empleado_to_add->registroNomina_id = $registro_nomina_to_add->id;
                        $registro_nomina_tipo_empleado_to_add->tipo_empleado = $keyTE;
                        /**
                         * Guardar el Registro Nómina Para ese tipo de Empleado y Requerimiento
                         */
                        if(!$registro_nomina_tipo_empleado_to_add->save()) {
                            return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido agregar correctamente alguno de los registros para los empleados."))->withInput();
                        }   
                    }
                }
            }
        }

        if ($request->recibo_id) {
            return redirect()->action('RegistroNominaReciboEmpleadoController@index', [
                'recibo_id' => $request->recibo_id]
            )->with("alert", Utilidades::getAlert("success", "Éxito", "Se ha agregado correctamente el registro nómina."));
        } else {
            return redirect()->back()->with("alert", Utilidades::getAlert("success", "Éxito", "Se ha agregado correctamente el registro nómina."));
        }       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegistroNomina  $registroNomina
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if (Auth::user()->cannot('view', RegistroNomina::class)) {
            return json_encode(['result'=> false,'data'=> []]);
        }

        $registro_nomina_to_find = RegistroNomina::with('registroNominaTiposEmpleado')->where('id', $id)->first();
        if (!$registro_nomina_to_find) {
            return json_encode(['result'=> false,'data'=> []]);
        }
        return json_encode(['result'=> true,'data'=> $registro_nomina_to_find]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RegistroNomina  $registroNomina
     * @return \Illuminate\Http\Response
     */
    public function update(RegistroNominaForm $request, $id) {
        if (Auth::user()->cannot('update', RegistroNomina::class)) {
            return redirect()->route('/');
        }

        $registro_nomina_to_edit = RegistroNomina::find($id);

        if (!$registro_nomina_to_edit) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "El Registro Nómina no existe o no se encuentra disponible."))->withInput();
        }

        $registro_nomina_to_edit->nombre = $request->nombre;
        $registro_nomina_to_edit->tipo_valor = $request->tipo_valor;
        $registro_nomina_to_edit->codigo_nomina = $request->codigo_nomina;
        $registro_nomina_to_edit->tipo_nomina = $request->tipo_nomina;
        $registro_nomina_to_edit->basado_en = $request->basado_en;
        $registro_nomina_to_edit->determinado = $request->determinado;
        $registro_nomina_to_edit->carga_horaria = $request->carga_horaria;

        if (!$registro_nomina_to_edit->save()) {
            return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido actualizar correctamente el registro nómina."))->withInput();
        }

        /** 
         * Verificar los tipos de empleados previamente guardados
         */
        foreach ($registro_nomina_to_edit->registroNominaTiposEmpleado as $tipoEmpleado) {
            $tipo = OwnArrays::$requiere_prima_value[$tipoEmpleado->depende_de];
            if ($request->$tipo){
                // Aún tiene requerimiento de este tipo
                $empleado_requiere = OwnArrays::$tipos_empleados_value[$tipoEmpleado->tipo_empleado].'-'.$tipo;
                if ($request->$empleado_requiere) {
                    // Aún posee monto para este empleado, se actualizan
                    $cantidad = 'cantidad_'.OwnArrays::$tipos_empleados_value[$tipoEmpleado->tipo_empleado].'_'.$tipo;
                    $tipoEmpleado->cantidad = $request->$cantidad;
                    // Se guarda
                    if (!$tipoEmpleado->save()) {
                        return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido actualizar correctamente el registro nómina."))->withInput();
                    }
                } else {
                    // No posee monto para este empleado, se elimina
                    if (!$tipoEmpleado->delete()) {
                        return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido actualizar correctamente el registro nómina."))->withInput();
                    }      
                }                
            }
        }

        /**
         * Verificar los nuevos agregados en el request
         */
        foreach (OwnArrays::$requiere_prima_value as $key => $value) {
            if ($request->$value) {
                // Aplica para este tipo de empleado
                foreach (OwnArrays::$tipos_empleados_value as $keyTE => $valueTE) {
                    $tipo = $valueTE.'-'.$value;
                    if ($request->$tipo) {
                        // Aplica para este empleado, Verificar los montos para cada empleado
                        $cantidad = 'cantidad_'.$valueTE.'_'.$value;
                        // Verificar si ya existe en el Registro Nómina
                        if (!$registro_nomina_to_edit->verificarSiExiste($key, $keyTE)) {
                            // Debe crearse
                            $registro_nomina_tipo_empleado_to_add = new RegistroNominaTipoEmpleado();
                            $registro_nomina_tipo_empleado_to_add->cantidad = $request->$cantidad;
                            $registro_nomina_tipo_empleado_to_add->depende_de = $key;
                            $registro_nomina_tipo_empleado_to_add->registroNomina_id = $registro_nomina_to_edit->id;
                            $registro_nomina_tipo_empleado_to_add->tipo_empleado = $keyTE;
                            /**
                             * Guardar el Registro Nómina Para ese tipo de Empleado y Requerimiento
                             */
                            if(!$registro_nomina_tipo_empleado_to_add->save()) {
                                return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido agregar correctamente alguno de los registros para los empleados."))->withInput();
                            }   
                        }
                    }
                }
            }
        }

        if ($request->recibo_id) {
            return redirect()->action('RegistroNominaReciboEmpleadoController@index', [
                'recibo_id' => $request->recibo_id]
            )->with("alert", Utilidades::getAlert("success", "Éxito", "Se ha actualizado correctamente el registro nómina."));
        } else {
            return redirect()->back()->with("alert", Utilidades::getAlert("success", "Éxito", "Se ha actualizado correctamente el registro nómina."));
        }

    }

    public function validarCodigo($codigo) {
        if (Auth::user()->cannot('validarCodigo',RegistroNomina::class)) {
            return json_encode(['result'=>false,'data'=>[]]);
        }

        $codigo_nomina_to_search = RegistroNomina::where('codigo_nomina', $codigo)->get();

        if ($codigo_nomina_to_search->isEmpty()) {
            return json_encode(['result'=>false,'data'=>[]]);
        } else {
            return json_encode(['result'=>true,'data'=>$codigo_nomina_to_search]);
        }
    }
}
