<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Obrero;
use App\Models\Docente;
use App\Models\Empleado;
use App\Models\Administrativo;
use App\Models\ClasificacionObrero;
use App\Models\ClasificacionAdministrativo;
use App\OwnModels\Utilidades;
use App\OwnModels\OwnArrays;
use App\Http\Requests\EmpleadoForm;
use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;

class EmpleadoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        /**
         * Verificar que el usuario en sesión tenga permisos de ver el index
         */
        if (Auth::user()->cannot('index', Empleado::class)){
            return redirect()->route('/');
        }

        /**
         * Filtros
         */
        $cantidad = Utilidades::getWithDefault(filter_input(INPUT_GET, 'cantidad', FILTER_SANITIZE_NUMBER_INT), 15);
        $nombres = filter_input(INPUT_GET, 'nombres', FILTER_SANITIZE_STRING);
        $apellidos = filter_input(INPUT_GET, 'apellidos', FILTER_SANITIZE_STRING);
        $cedula = filter_input(INPUT_GET, 'cedula', FILTER_SANITIZE_STRING);
        $cargo_filtro = filter_input(INPUT_GET, 'cargo_filtro', FILTER_SANITIZE_NUMBER_INT);
        $tipo_empleado = filter_input(INPUT_GET, 'tipo_empleado', FILTER_SANITIZE_NUMBER_INT);

        /**
         * Obtener todos los usuarios
         */
        $empleados = Empleado::with(['user', 'cargo'])
            ->orderBy('empleado.id', 'desc');

        /**
         * Aplicar filtros
         */
        if ($nombres) {
            $empleados = $empleados->where('nombres', 'LIKE', "%$nombres%");
        }
        if ($apellidos) {
            $empleados = $empleados->where('apellidos', 'LIKE', "%$apellidos%");
        }
        if($cedula) {
            $empleados = $empleados->where('cedula', $cedula);
        }
        if ($cargo_filtro) {
            $empleados= $empleados->where('cargo_id',$cargo_filtro);
        }
        if($tipo_empleado) {
            $empleados = $empleados->whereHas('cargo',function($query)use($tipo_empleado){
                $query->where('tipo_empleado',$tipo_empleado);
            });
        }

        /**
         * Los arrays necesarios para los selects
         */
        $cargos = Cargo::select(['cargo.id', 'cargo.descripcion'])->orderBy('cargo.id', 'desc')->get();
        $clasificaciones_obreras = ClasificacionObrero::get();
        $clasificaciones_administrativas = ClasificacionAdministrativo::get();

        /**
         * Retorno la vista con las variables necesarias
         */
        return view('pages.empleados.index', [
            'empleados' => $empleados->paginate($cantidad), 
            'busqueda_cantidad' => $cantidad,
            'nombres' => $nombres, 
            'apellidos' => $apellidos,
            'cedula' => $cedula,
            'cargo_filtro' => $cargo_filtro,
            'tipo_empleado' => $tipo_empleado,
            'cargos' => $cargos,
            'clasificaciones_obreras' => $clasificaciones_obreras,
            'clasificaciones_administrativas' => $clasificaciones_administrativas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoForm $request) {
        /**
         * Verificar que el usuario en sesión tenga permisos de crear
         */
        if (Auth::user()->cannot('create', Empleado::class)){
            return redirect()->route('/');
        }

        /**
         * Crear la nueva instancia de empleado y asignarle los valores
         */
        $empleado_to_add = new Empleado();
        $empleado_to_add->cargo_id = $request->cargo_id;
        $empleado_to_add->horas_semanales = $request->horas_semanales;
        $empleado_to_add->fecha_ingreso = Carbon::createFromFormat('d/m/yy', $request->fecha_ingreso);
        $empleado_to_add->tipo_personal = $request->tipo_personal;
        $empleado_to_add->nombres = $request->nombres;
        $empleado_to_add->apellidos = $request->apellidos;
        $empleado_to_add->cedula = $request->cedula;
        $empleado_to_add->sso = $request->sso == 1 ? 1 : 0;
        $empleado_to_add->lph = $request->lph == 1 ? 1 : 0;
        $empleado_to_add->prestaciones_sociales_acumuladas = $request->prestaciones_sociales_acumuladas;
        $empleado_to_add->tiempo_completo = $request->tiempo_completo;

        /**
         * Si no guarda enviar la alerta de que no se pudo agregar correctamente
         */
        if(!$empleado_to_add->save()) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido agregar el empleado correctamente."))->withInput();
        }

        /**
         * Crear la instancia de docente, obrero o administrativo dependiendo del cargo
         * del empleado creado
         */
        if ($empleado_to_add->cargo->tipo_empleado == OwnArrays::EMPLEADO_DOCENTE) {
            $docente_to_add = new Docente();
            $docente_to_add->empleado_id = $empleado_to_add->id;
            $docente_to_add->categoria_docente_id = 1;
            $docente_to_add->titulo_docente = $request->titulo_docente;
            $docente_to_add->especializacion = $request->especializacion == 1 ? 1 : 0;
            $docente_to_add->postgrado = $request->postgrado == 1 ? 1 : 0;
            if (!$docente_to_add->save()) {
                return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido agregar correctamente los datos del docente."))->withInput();
            }
        } elseif ($empleado_to_add->cargo->tipo_empleado == OwnArrays::EMPLEADO_OBRERO) {
            $obrero_to_add = new Obrero();
            $obrero_to_add->empleado_id = $empleado_to_add->id;
            $obrero_to_add->nivel_instruccion = $request->nivel_instruccion;
            $obrero_to_add->clasificacion_obrero_id = $request->clasificacion_obrero_id;
            if (!$obrero_to_add->save()) {
                return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido agregar correctamente los datos del obrero."))->withInput();
            }
        } elseif ($empleado_to_add->cargo->tipo_empleado == OwnArrays::EMPLEADO_ADMINISTRATIVO) {
            $administrativo_to_add = new Administrativo();
            $administrativo_to_add->empleado_id = $empleado_to_add->id;
            $administrativo_to_add->nivel_instruccion = $request->nivel_instruccion;
            $administrativo_to_add->clasificacion_administrativo_id = $request->clasificacion_administrativo_id;
            if (!$administrativo_to_add->save()) {
                return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido agregar correctamente los datos del administrativo."))->withInput();
            }
        }

        /**
         * Al guardar enviar la alerta de que se guardo correctamente
         */
        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "Se ha agregado el empleado correctamente."));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        /**
         * Buscar el empleado especificado
         */
        $empleado_to_find = Empleado::with(['user', 'cargo', 
            'obrero', 'obrero.clasificacionObrero',
            'docente', 'docente.categoriaDocente',
            'administrativo', 'administrativo.clasificacionAdministrativo'])
            ->where('empleado.id', $id)
            ->first();

        /**
         * Si no se encuentra el usuario o si quien está logueado no tiene permisos para acceder a la vista de usuario se
         * retorna falso en el resultado.
         */
        if(!$empleado_to_find || Auth::user()->cannot('view', $empleado_to_find)){
            return json_encode(['result'=>false,'data'=>[]]);
        };  

        /**
         * Se retorna el resultado en true y la data solicitada
         */      
        return json_encode(['result'=>true,'data'=>$empleado_to_find,'tipo_empleado'=>OwnArrays::$tipos_empleados[$empleado_to_find->cargo->tipo_empleado]]);
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadoForm $request, $id) {
        /**
         * Buscar el empleado especificado
         */      
        $empleado_to_find = Empleado::find($id);

        /**
         * Se verifica que el usuario logueado tenga permisos para editar un empleado.
         */
        if(Auth::user()->cannot('update', $empleado_to_find)) {
            return redirect()->route('/');
        } 

        /**
         * Si no se encuentra el empleado se envía una alerta
         */
        if(!$empleado_to_find) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "El empleado no existe o no se encuentra disponible."))->withInput();
        }

        /**
         * Se modifican los cambios del empleado
         */
        $empleado_to_find->cargo_id = $request->cargo_id;
        $empleado_to_find->horas_semanales = $request->horas_semanales;
        $empleado_to_find->fecha_ingreso = Carbon::createFromFormat('d/m/yy', $request->fecha_ingreso);
        $empleado_to_find->tipo_personal = $request->tipo_personal;
        $empleado_to_find->nombres = $request->nombres;
        $empleado_to_find->apellidos = $request->apellidos;
        $empleado_to_find->cedula = $request->cedula;
        $empleado_to_find->sso = $request->sso == 1 ? 1 : 0;
        $empleado_to_find->lph = $request->lph == 1 ? 1 : 0;
        $empleado_to_find->prestaciones_sociales_acumuladas = $request->prestaciones_sociales_acumuladas;
        $empleado_to_find->tiempo_completo = $request->tiempo_completo;

        /**
         * Si no guarda enviar la alerta de que no se pudo actualizar correctamente
         */
        if(!$empleado_to_find->save()) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido actualizar correctamente."))->withInput();
        }

        /**
         * Editar/Eiminar la instancia de docente, obrero o administrativo dependiendo del cargo
         * del empleado creado
         */
        if ($empleado_to_find->cargo->tipo_empleado == OwnArrays::EMPLEADO_DOCENTE) {
            /**
             * Verificar que el empleado posea un docente
             */
            $docente_to_add = $empleado_to_find->docente ? $empleado_to_find->docente : new Docente();
            $docente_to_add->empleado_id = $empleado_to_find->id;
            $docente_to_add->categoria_docente_id = 1;
            $docente_to_add->titulo_docente = $request->titulo_docente;
            $docente_to_add->especializacion = $request->especializacion == 1 ? 1 : 0;
            $docente_to_add->postgrado = $request->postgrado == 1 ? 1 : 0;
            if (!$docente_to_add->save()) {
                return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido agregar correctamente los datos del docente."))->withInput();
            }

            /**
             * Verificar si el empleado posee un Obrero o Administrativo y borrarlo
             */
            $empleado_to_find->obrero ? $empleado_to_find->obrero->delete() : null;
            $empleado_to_find->administrativo ? $empleado_to_find->administrativo->delete() : null;
        } elseif ($empleado_to_find->cargo->tipo_empleado == OwnArrays::EMPLEADO_OBRERO) {
            /**
             * Verificar que el empleado posea un obrero
             */
            $obrero_to_add = $empleado_to_find->obrero ? $empleado_to_find->obrero : new Obrero();
            $obrero_to_add->empleado_id = $empleado_to_find->id;
            $obrero_to_add->nivel_instruccion = $request->nivel_instruccion;
            $obrero_to_add->clasificacion_obrero_id = $request->clasificacion_obrero_id;
            if (!$obrero_to_add->save()) {
                return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido agregar correctamente los datos del obrero."))->withInput();
            }

            /**
             * Verificar si el empleado posee un Docente o Administrativo y borrarlo
             */
            $empleado_to_find->docente ? $empleado_to_find->docente->delete() : null;
            $empleado_to_find->administrativo ? $empleado_to_find->administrativo->delete() : null;
        } elseif ($empleado_to_find->cargo->tipo_empleado == OwnArrays::EMPLEADO_ADMINISTRATIVO) {
            /**
             * Verificar que el empleado posea un obrero
             */
            $administrativo_to_add = $empleado_to_find->administrativo ? $empleado_to_find->administrativo : new Administrativo();
            $administrativo_to_add->empleado_id = $empleado_to_find->id;
            $administrativo_to_add->nivel_instruccion = $request->nivel_instruccion;
            $administrativo_to_add->clasificacion_administrativo_id = $request->clasificacion_administrativo_id;
            if (!$administrativo_to_add->save()) {
                return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido agregar correctamente los datos del administrativo."))->withInput();
            }

            /**
             * Verificar si el empleado posee un Docente u Obrero y borrarlo
             */
            $empleado_to_find->docente ? $empleado_to_find->docente->delete() : null;
            $empleado_to_find->obrero ? $empleado_to_find->obrero->delete() : null;
        }

        /**
         * Al actualizar enviar la alerta de que se actualizó correctamente
         */
        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "La actualización se ha realizado correctamente."));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        /**
         * Buscar el empleado especificado
         */      
        $empleado_to_find = Empleado::find($id);

        /**
         * Se verifica que el usuario logueado tenga permisos para eliminar un empleado.
         */
        if(Auth::user()->cannot('delete', $empleado_to_find)){
            return redirect()->route('/');
        }

        /**
         * Si no se encuentra el empleado se envía una alerta
         */
        if(!$empleado_to_find) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "El usuario no existe o no se encuentra disponible."))->withInput();
        }        
        
        /**
         * Si no elimina enviar la alerta de que no se pudo eliminar correctamente
         */
        if(!$empleado_to_find->delete()){
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido eliminar correctamente."))->withInput();
        }

        /**
         * Al eliminar enviar la alerta de que se eliminó correctamente
         */
        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "La eliminación se ha realizado correctamente."));
    }
}
