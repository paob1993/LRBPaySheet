<?php

namespace App\Http\Controllers;

use App\Models\Recordatorios;
use App\Models\Empleado;
use App\OwnModels\Utilidades;
use App\Http\Requests\RecordatorioForm;

use Carbon\Carbon;

use Auth;

class RecordatoriosController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        /**
         * Verificar que el usuario en sesión tenga permisos de ver el index
         */
        if (Auth::user()->cannot('index', Recordatorios::class)){
            return redirect()->route('/');
        }

        /**
         * Filtros
         */
        $cantidad = Utilidades::getWithDefault(filter_input(INPUT_GET, 'cantidad', FILTER_SANITIZE_NUMBER_INT), 15);

        /**
         * Obtener todos los recordatorios
         */
        $recordatorios = Recordatorios::with(['empleado'])
            ->orderBy('recordatorio.id', 'asc');

        if (!Auth::user()->isAdministradorDelSistema()) {
            $recordatorios = $recordatorios->whereHas('empleado',function($query) {
                $query->where('id', Auth::user()->empleado->id);
            });
        }

        /**
         * Los arrays necesarios para los selects
         */
        $empleados = Empleado::get();

        /**
         * Retorno la vista con las variables necesarias
         */
        return view('pages.recordatorios.index', [
            'recordatorios' => $recordatorios->paginate($cantidad), 
            'busqueda_cantidad' => $cantidad,
            'empleados' => $empleados
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecordatorioForm $request) {
        /**
         * Verificar que el usuario en sesión tenga permisos de crear
         */
        if (Auth::user()->cannot('create', Recordatorios::class)){
            return redirect()->route('/');
        }

        /**
         * Crear la nueva instancia de recordatorio y asignarle los valores
         */
        $recordatorio_to_add = new Recordatorios();
        $recordatorio_to_add->empleado_id = $request->empleado_id;
        $recordatorio_to_add->nota = $request->nota;
        $recordatorio_to_add->fecha = Carbon::createFromFormat('d/m/yy', $request->fecha);

        /**
         * Si no guarda enviar la alerta de que no se pudo agregar correctamente
         */
        if(!$recordatorio_to_add->save()) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido agregar el recordatorio correctamente."))->withInput();
        }

        /**
         * Al guardar enviar la alerta de que se guardo correctamente
         */
        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "Se ha agregado el recordatorio correctamente."));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recordatorios  $recordatorios
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        /**
         * Buscar el recordatorio especificado
         */
        $recordatorio_to_find = Recordatorios::where('id', $id)
            ->first();

        /**
         * Si no se encuentra el usuario o si quien está logueado no tiene permisos para acceder a la vista de usuario se
         * retorna falso en el resultado.
         */
        if(!$recordatorio_to_find || Auth::user()->cannot('view', $recordatorio_to_find)){
            return json_encode(['result'=>false,'data'=>[]]);
        };  

        /**
         * Se retorna el resultado en true y la data solicitada
         */      
        return json_encode(['result'=>true,'data'=>$recordatorio_to_find]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recordatorios  $recordatorios
     * @return \Illuminate\Http\Response
     */
    public function update(RecordatorioForm $request, $id) {
        /**
         * Buscar el empleado especificado
         */      
        $recordatorio_to_find = Recordatorios::find($id);

        /**
         * Se verifica que el usuario logueado tenga permisos para editar un empleado.
         */
        if(Auth::user()->cannot('update', $recordatorio_to_find)) {
            return redirect()->route('/');
        } 

        /**
         * Si no se encuentra el recordatorio se envía una alerta
         */
        if(!$recordatorio_to_find) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "El recordatorio no existe o no se encuentra disponible."))->withInput();
        }

        /**
         * Se modifican los cambios del recordatorio
         */
        $recordatorio_to_find->empleado_id = $request->empleado_id;
        $recordatorio_to_find->nota = $request->nota;
        $recordatorio_to_find->fecha = Carbon::createFromFormat('d/m/yy', $request->fecha);

        /**
         * Si no guarda enviar la alerta de que no se pudo actualizar correctamente
         */
        if(!$recordatorio_to_find->save()) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido actualizar correctamente."))->withInput();
        }

        /**
         * Al actualizar enviar la alerta de que se actualizó correctamente
         */
        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "La actualización se ha realizado correctamente."));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recordatorios  $recordatorios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        /**
         * Buscar el recordatorio especificado
         */      
        $recordatorio_to_find = Recordatorios::find($id);

        /**
         * Se verifica que el usuario logueado tenga permisos para eliminar un recordatorio.
         */
        if(Auth::user()->cannot('delete', $recordatorio_to_find)){
            return redirect()->route('/');
        }

        /**
         * Si no se encuentra el recordatorio se envía una alerta
         */
        if(!$recordatorio_to_find) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "El recordatorio no existe o no se encuentra disponible."))->withInput();
        }

        /**
         * Se buscan y eliminan todas las relaciones del recordatorio
         */
        
        
        /**
         * Si no elimina enviar la alerta de que no se pudo eliminar correctamente
         */
        if(!$recordatorio_to_find->delete()){
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido eliminar correctamente."))->withInput();
        }

        /**
         * Al eliminar enviar la alerta de que se eliminó correctamente
         */
        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "La eliminación se ha realizado correctamente."));
    }
}
