<?php

namespace App\Http\Controllers;

use App\Models\VariablesGlobales;
use App\OwnModels\Utilidades;
use App\OwnModels\OwnArrays;
use App\Http\Requests\VariablesGlobalesForm;

use Auth;

class VariablesGlobalesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        /**
         * Verificar que el usuario en sesión tenga permisos de ver el index
         */
        if (Auth::user()->cannot('index', VariablesGlobales::class)){
            return redirect()->route('/');
        }

        /**
         * Filtros
         */
        $cantidad = Utilidades::getWithDefault(filter_input(INPUT_GET, 'cantidad', FILTER_SANITIZE_NUMBER_INT), 15);
        $tipo_valor = filter_input(INPUT_GET, 'tipo_valor', FILTER_SANITIZE_NUMBER_INT);
        $formula = filter_input(INPUT_GET, 'formula', FILTER_SANITIZE_NUMBER_INT);
        $tipo_empleado = filter_input(INPUT_GET, 'tipo_empleado', FILTER_SANITIZE_NUMBER_INT);

        /**
         * Obtener todos las Variables Globales
         */
        $variablesGlobales = VariablesGlobales::with(['variablesGlobalesTiposEmpleado'])
            ->orderBy('variables_globales.id', 'asc');

        /**
         * Aplicar filtros
         */
        if ($tipo_valor) {
            $variablesGlobales = $variablesGlobales->where('tipo_valor', $tipo_valor);
        }
        if ($formula) {
            $variablesGlobales = $variablesGlobales->where('formula', $formula);
        }
        if($tipo_empleado) {
            $variablesGlobales= $variablesGlobales->whereHas('variablesGlobalesTiposEmpleado',function($query)use($tipo_empleado){
                $query->where('tipo_empleado', $tipo_empleado);
            });
        }

        /**
         * Retorno la vista con las variables necesarias
         */
        return view('pages.variablesGlobales.index', [
            'variablesGlobales' => $variablesGlobales->paginate($cantidad), 
            'busqueda_cantidad' => $cantidad,
            'tipo_valor' => $tipo_valor, 
            'formula' => $formula,
            'tipo_empleado' => $tipo_empleado
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VariablesGlobales  $variablesGlobales
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        /**
         * Buscar la variable global especificada
         */
        $variableGlobal_to_find = VariablesGlobales::with(['variablesGlobalesTiposEmpleado'])
            ->where('variables_globales.id', $id)
            ->first();

        /**
         * Si no se encuentra el usuario o si quien está logueado no tiene permisos para acceder a la vista de usuario se
         * retorna falso en el resultado.
         */
        if(!$variableGlobal_to_find || Auth::user()->cannot('view', $variableGlobal_to_find)){
            return json_encode(['result'=>false,'data'=>[]]);
        };  

        /**
         * Se retorna el resultado en true y la data solicitada
         */      
        return json_encode(['result'=>true,'data'=>$variableGlobal_to_find]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VariablesGlobales  $variablesGlobales
     * @return \Illuminate\Http\Response
     */
    public function update(VariablesGlobalesForm $request, $id) {
        /**
         * Buscar la variable golbal especificado
         */      
        $variableGlobal_to_find = VariablesGlobales::find($id);

        /**
         * Si no se encuentra la variable golbal se envía una alerta
         */
        if(!$variableGlobal_to_find){
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "La variable no existe o no se encuentra disponible."))->withInput();
        }  

        /**
         * Se verifica que el usuario logueado tenga permisos para editar una variable golbal.
         */
        if(Auth::user()->cannot('update',$variableGlobal_to_find)){
            return redirect()->route('/');
        }

        /**
         * Se modifica la cantidad
         */
        foreach ($variableGlobal_to_find->variablesGlobalesTiposEmpleado as $tipoEmpleado) {
            if ($tipoEmpleado->tipo_empleado === OwnArrays::EMPLEADO_ADMINISTRATIVO) {
                $tipoEmpleado->cantidad = $request->valor_administrativo;
                /**
                 * Si no guarda enviar la alerta de que no se pudo actualizar correctamente
                 */
                if(!$tipoEmpleado->save()) {
                    return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido actualizar correctamente."))->withInput();
                }
            } elseif ($tipoEmpleado->tipo_empleado === OwnArrays::EMPLEADO_OBRERO) {
                $tipoEmpleado->cantidad = $request->valor_obrero;
                /**
                 * Si no guarda enviar la alerta de que no se pudo actualizar correctamente
                 */
                if(!$tipoEmpleado->save()) {
                    return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido actualizar correctamente."))->withInput();
                }
            } elseif ($tipoEmpleado->tipo_empleado === OwnArrays::EMPLEADO_DOCENTE) {
                $tipoEmpleado->cantidad = $request->valor_docente;
                /**
                 * Si no guarda enviar la alerta de que no se pudo actualizar correctamente
                 */
                if(!$tipoEmpleado->save()) {
                    return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido actualizar correctamente."))->withInput();
                }
            }
        }

        /**
         * Al actualizar enviar la alerta de que se actualizó correctamente
         */
        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "La actualización se ha realizado correctamente."));
    }
}
