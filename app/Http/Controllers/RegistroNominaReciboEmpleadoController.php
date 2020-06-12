<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use App\Models\Empleado;
use App\Models\RegistroNomina;
use App\Models\ReciboEmpleado;
use App\Models\VariablesGlobales;
use App\Models\RegistroNominaReciboEmpleado;

use App\OwnModels\OwnArrays;
use App\OwnModels\Utilidades;

use Illuminate\Http\Request;

use Auth;

class RegistroNominaReciboEmpleadoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($recibo_id) {
        $registros_nomina_manuales = RegistroNomina::where('determinado', OwnArrays::TIPO_MANUAL)
            ->get();

        return view('pages.gestionNomina.createManual', [
            'registros_nomina' => $registros_nomina_manuales,
            'recibo_id' => $recibo_id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($recibo_id) {
        if (Auth::user()->cannot('create',RegistroNominaReciboEmpleado::class)) {
            return redirect()->route('/');
        }
        $registros_nomina_automaticos = RegistroNomina::with(['registroNominaTiposEmpleado'])
            ->where('determinado', OwnArrays::TIPO_AUTOMATICO)
            ->get();
        $registros_nomina_manuales = RegistroNomina::with(['registroNominaTiposEmpleado'])
            ->where('determinado', OwnArrays::TIPO_MANUAL)
            ->get();

        return view('pages.gestionNomina.store', [
            'registros_nomina_automaticos' => $registros_nomina_automaticos,
            'registros_nomina_manuales' => $registros_nomina_manuales,
            'recibo_id' => $recibo_id
            ]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
     
    public function createManual($recibo_id) {
        if (Auth::user()->cannot('create',RegistroNominaReciboEmpleado::class)) {
            return redirect()->route('/');
        }

        $registros_nomina_manuales = RegistroNomina::where('determinado', OwnArrays::TIPO_MANUAL)->get();
        $empleados = Empleado::orderBy('id','asc');    

        $nombres=filter_input(INPUT_GET,'nombres',FILTER_SANITIZE_STRING);
        $apellidos=filter_input(INPUT_GET,'apellidos',FILTER_SANITIZE_STRING);
        $cedula=filter_input(INPUT_GET,'cedula',FILTER_SANITIZE_STRING);

        if ($nombres) {
            $empleados = $empleados->where('nombres','LIKE',"%$nombres%");
        }

        if ($apellidos) {
            $empleados = $empleados->where('apellidos','LIKE',"%$apellidos%");         
        }

        if ($cedula) {
            $empleados = $empleados->where('cedula','LIKE',"%$cedula%");         
        }

        return view('pages.gestionNomina.storeManual', [
            'registros_nomina_manuales' => $registros_nomina_manuales,
            'recibo_id' => $recibo_id,
            'empleados' => $empleados->get(),
            'nombres' => $nombres, 
            'apellidos' => $apellidos, 
            'cedula' => $cedula
        ]);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        /**
         * Verificar que el usuario en sesión tenga permisos de crear
         */
        if (Auth::user()->cannot('create', RegistroNominaReciboEmpleado::class)) {
            return redirect()->route('/');
        }

        /**
         * Obtener todos los empleados y los registros nómina
         */
        $empleados = Empleado::get();
        $registros_nominas = RegistroNomina::where('determinado', OwnArrays::TIPO_AUTOMATICO)->get();
        $sueldo_base = RegistroNomina::where('codigo_nomina', '=', 'SB30')->first();
        $lph = RegistroNomina::where('codigo_nomina', '=', 'LPH')->first();
        $sso = RegistroNomina::where('codigo_nomina', '=', 'SSO')->first();

        /**
         * Verificar cuales registros manuales fueron seleccionados
         */
        $registros_nomina_manuales = RegistroNomina::where('determinado', OwnArrays::TIPO_MANUAL)->get();
        $registros_nomina_manuales_seleccionados = [];
        foreach ($registros_nomina_manuales as $reg) {
            $id = $reg->id;
            if ($request->$id) {
                array_push($registros_nomina_manuales_seleccionados, $reg);
            }
        }

        /**
         * Por Cada Empleado
         * 1.- Calcular Sueldo Mensual ((nº horas semanales*nro de semanas)Cantidad * (valor por hora)MontoBase)
         * 2.- Calcular LPH y SSO si aplica
         * 3.- Calcular Registros que apliquen y sumar/restar al monto total dependiendo del tipo
         */
        foreach ($empleados as $empleado) {        
            $recibo_empleado = new ReciboEmpleado();
            // Verificar si existe un recibo con ese id y ese empleado    
            $recibo_empleado_to_find = ReciboEmpleado::with('registroNominasReciboEmpleado')
                ->where('recibo_id', $request->recibo_id)
                ->where('empleado_id', $empleado->id)
                ->first();
            if ($recibo_empleado_to_find !== null) {
                $recibo_empleado = $recibo_empleado_to_find;
            }
            $recibo_empleado->recibo_id = $request->recibo_id;
            $recibo_empleado->empleado_id = $empleado->id;
            $recibo_empleado->valor_por_hora = $empleado->obtenerValorPorHora();
            $recibo_empleado->horas_semanales = $empleado->horas_semanales;
            $recibo_empleado->monto_total = 0;
            $recibo_empleado->primer_quincena = 0;
            // Guardar el ReciboEmpleado
            if(!$recibo_empleado->save()) {
                return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido facturar correctamente el periodo."))->withInput();
            }            
            // Cálculo del sueldo base
            $base = new RegistroNominaReciboEmpleado();
            // Verificar que no exista el registro
            $base_to_find = RegistroNominaReciboEmpleado::where('registroNomina_id', $sueldo_base->id)
                ->where('reciboEmpleado_id', $recibo_empleado->id)
                ->first();
            if ($base_to_find !== null) {
                $base = $base_to_find;
            }
            $base->registroNomina_id = $sueldo_base->id;
            $base->reciboEmpleado_id = $recibo_empleado->id;
            $base->monto_base = round($empleado->obtenerValorPorHora(), 2); // valor de Hora  
            if ($empleado->tiempo_completo === 1) { // Considerado como trabajador tiempo completo
                $base->cantidad = round(OwnArrays::NUMERO_DE_SEMANAS_MES * OwnArrays::NUMERO_DE_HORAS_SEMANALES, 2);  // Cantidad de Horas del Mes
            } else {
                $base->cantidad = round(OwnArrays::NUMERO_DE_SEMANAS_MES * $empleado->horas_semanales, 2); // Cantidad de Horas del Mes
            }         
            $base->monto_total = round($base->monto_base * $base->cantidad, 2); // Cálculo monto_base*cantidad
            // Guardar el Sueldo Base
            if(!$base->save()) {
                return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido facturar correctamente el periodo."))->withInput();
            }
            // Sumar sueldo base al recibo
            $recibo_empleado->monto_total += $base->monto_total; 
            // Cálculo de LPH
            // Verificar que no exista el registro
            $lph_to_find = RegistroNominaReciboEmpleado::where('registroNomina_id', $lph->id)
                ->where('reciboEmpleado_id', $recibo_empleado->id)
                ->first();
            if ($empleado->lph === 1) {
                $lph_registro = new RegistroNominaReciboEmpleado();
                if ($lph_to_find !== null) {
                    $lph_registro = $lph_to_find;
                }
                $lph_registro->registroNomina_id = $lph->id;
                $lph_registro->reciboEmpleado_id = $recibo_empleado->id;
                $lph_registro->monto_base = round($lph->obtenerBase($empleado, $base->monto_total), 2);
                $lph_registro->cantidad = round($lph->obtenerCantidad($empleado), 3);
                $lph_registro->monto_total = round($lph_registro->monto_base * ($lph_registro->cantidad / 100), 2);
                if(!$lph_registro->save()) {
                    return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido facturar correctamente el periodo."))->withInput();
                }
                $recibo_empleado->monto_total -= $lph_registro->monto_total;
            }  else if ($empleado->lph !== 1 && $lph_to_find !== null) {
                $lph_to_find->delete();
            }
            // Cálculo de SSO
            // Verificar que no exista el registro
            $sso_to_find = RegistroNominaReciboEmpleado::where('registroNomina_id', $sso->id)
                ->where('reciboEmpleado_id', $recibo_empleado->id)
                ->first();
            if ($empleado->sso === 1) {
                $sso_registro = new RegistroNominaReciboEmpleado();
                if ($sso_to_find !== null) { // No paga pero se le creó el registro de LPH
                    $sso_registro = $sso_to_find;
                }
                $sso_registro->registroNomina_id = $sso->id;
                $sso_registro->reciboEmpleado_id = $recibo_empleado->id;
                $sso_registro->monto_base = round($sso->obtenerBase($empleado, $base->monto_total), 2);
                $sso_registro->cantidad = round($sso->obtenerCantidad($empleado), 3);
                $sso_registro->monto_total = round($sso_registro->monto_base * ($sso_registro->cantidad / 100), 2);
                if(!$sso_registro->save()) {
                    return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido facturar correctamente el periodo."))->withInput();
                }
                $recibo_empleado->monto_total -= $sso_registro->monto_total;
            }   else if  ($empleado->sso !== 1 && $sso_to_find !== null) { // No paga pero se le creó el registro de SSO
                $sso_to_find->delete();
            }       
            // Cálculo de Otros Regitros Automáticos Seleccionados
            foreach ($registros_nominas as $registro) {
                $id = $registro->id;
                // Registro a Incluir
                if ($request->$id) {
                    // Aplica para este tipo de Empleado
                    if ($registro->aplicaParaEmpleado($empleado) && $registro->obtenerCantidad($empleado) !== 0) {
                        $registro_to_add = new RegistroNominaReciboEmpleado();
                        // Verificar si existe el registro
                        $registro_to_find = RegistroNominaReciboEmpleado::where('registroNomina_id', $registro->id)
                            ->where('reciboEmpleado_id', $recibo_empleado->id)
                            ->first();
                        if ($registro_to_find !== null) {
                            $registro_to_add = $registro_to_find;
                        }
                        $registro_to_add->registroNomina_id = $registro->id;
                        $registro_to_add->reciboEmpleado_id = $recibo_empleado->id;
                        $registro_to_add->monto_base = round($registro->obtenerBase($empleado, $base->monto_total), 2);
                        // Verificar si el registro nómina es prorrateado
                        if ($registro->carga_horaria === 1 && $empleado->tiempo_completo !== 1) { // Se Prorratea y el empleado no es tiempo completo
                            $tiempo_completo_empleado = $empleado->obtenerTiempoCompleto();
                            $total_cantidad = round($registro->obtenerCantidad($empleado), 2);
                            $registro_to_add->cantidad = round((($empleado->horas_semanales * $total_cantidad) / $tiempo_completo_empleado), 2);
                        } else { // No es prorrateado o el empleado es tiempo completo
                            $registro_to_add->cantidad = round($registro->obtenerCantidad($empleado), 2);                             
                        }
                        if ($registro->tipo_valor === OwnArrays::CONFIGURACION_PORCENTUAL) {
                            $registro_to_add->monto_total = round($registro_to_add->monto_base * ($registro_to_add->cantidad / 100) , 2);
                        } else {
                            $registro_to_add->monto_total = round($registro_to_add->monto_base * $registro_to_add->cantidad, 2);
                        } 
                        // Guardar el registro
                        if(!$registro_to_add->save()) {
                            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido facturar correctamente el periodo."))->withInput();
                        }
                        if ($registro->tipo_nomina === OwnArrays::CODIGO_DE_ASIGNACION) {
                            $recibo_empleado->monto_total += $registro_to_add->monto_total;
                        } else {
                            $recibo_empleado->monto_total -= $registro_to_add->monto_total;                            
                        }                   
                    }
                }
                $recibo_empleado->monto_total = round($recibo_empleado->monto_total, 2);
            }           
            // Guardar el nuevo monto total del recibo
            if(!$recibo_empleado->save()) {
                return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido facturar correctamente el periodo."))->withInput();
            }                        
        }

        return redirect()->action(
            'RegistroNominaReciboEmpleadoController@createManual', ['recibo_id' => $request->recibo_id]
        )->with(
            "alert", Utilidades::getAlert("success", "Éxito", "Se han facturado correctamente los registros automáticos.")
        )->withInput();  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeManual(Request $request) {
        dd($request);
        if (Auth::user()->cannot('create',RegistroNominaReciboEmpleado::class)) {
            return redirect()->route('/');
        }
        $registros_nomina_manuales = RegistroNomina::where('determinado', OwnArrays::TIPO_MANUAL)->get();
        //Busco el ReciboEmpleado, el sueldo base y el Empleado
        $recibo_empleado = ReciboEmpleado::where('recibo_id', $request->recibo_id)->where('empleado_id', $request->empleado_id)->first();
        $base = RegistroNominaReciboEmpleado::where('reciboEmpleado_id', $recibo_empleado->id)->where('registroNomina_id', RegistroNomina::first()->id)->first();
        $empleado = Empleado::find($request->empleado_id);
        /**
         * Por cada registro verifico si existe monto (!= 0), de ser así, 
         * se crea el registroNominaReciboEmpleado, se guarda y se le suma o resta del 
         * monto total del recibo.
         */
        foreach ($registros_nomina_manuales as $manual) {
            $id = $manual->id;
            $name = $manual->id.'-select';
            if ($request->$name) {
                if ($request->$id != 0) {
                    $registro_to_add = new RegistroNominaReciboEmpleado();
                    /**
                     * Verificar si ya existe el registro
                     */
                    $reg_to_find = RegistroNominaReciboEmpleado::where('registroNomina_id', $manual->id)->where('reciboEmpleado_id', $recibo_empleado->id)->first();
                    if ($reg_to_find !== null) {
                        $monto_anterior = $reg_to_find->monto_total;
                        $registro_to_add = $reg_to_find;
                    }
                    $registro_to_add->registroNomina_id = $manual->id;
                    $registro_to_add->reciboEmpleado_id = $recibo_empleado->id;
                    $registro_to_add->monto_base = round($manual->obtenerBase($empleado, $base->monto_total), 2);
                    $registro_to_add->cantidad = round($request->$id, 2);
                    if ($manual->tipo_valor === OwnArrays::CONFIGURACION_PORCENTUAL) {
                        $registro_to_add->monto_total = round($registro_to_add->monto_base * ($registro_to_add->cantidad / 100), 2);
                    } else {  
                        $registro_to_add->monto_total = round($registro_to_add->monto_base * $registro_to_add->cantidad, 2);
                    } 
                    $registro_to_add->monto_total = round($registro_to_add->monto_base * $registro_to_add->cantidad, 2); 
                    // Guardar la asignación
                    if(!$registro_to_add->save()) {
                        return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido almacenar correctamente los registros para este empleado."))->withInput();
                    }
                    if ($manual->tipo_nomina == OwnArrays::CODIGO_DE_ASIGNACION) {
                        $recibo_empleado->monto_total += $registro_to_add->monto_total;
                    } else {
                        $recibo_empleado->monto_total -= $registro_to_add->monto_total;
                    } 
                    // Guardar el nuevo monto total del recibo
                    $recibo_empleado->monto_total = round($recibo_empleado->monto_total, 2);
                    if(!$recibo_empleado->save()) {
                        return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido facturar correctamente el periodo."))->withInput();
                    } 
                }
            }
        }
        return redirect()->back()->with("alert", Utilidades::getAlert("success", "Éxito", "Se ha actualizado correctamente el empleado."));     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegistroNominaReciboEmpleado  $registroNominaReciboEmpleado
     * @return \Illuminate\Http\Response
     */
    public function show($id)  {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RegistroNominaReciboEmpleado  $registroNominaReciboEmpleado
     * @return \Illuminate\Http\Response
     */
    public function edit(RegistroNominaReciboEmpleado $registroNominaReciboEmpleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RegistroNominaReciboEmpleado  $registroNominaReciboEmpleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistroNominaReciboEmpleado $registroNominaReciboEmpleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegistroNominaReciboEmpleado  $registroNominaReciboEmpleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegistroNominaReciboEmpleado $registroNominaReciboEmpleado)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegistroNominaReciboEmpleado  $registroNominaReciboEmpleado
     * @return \Illuminate\Http\Response
     */
    public function findRegistro($recibo_id, $empleado_id) {        
        if (Auth::user()->cannot('findRegistro', RegistroNominaReciboEmpleado::class)) {
            return json_encode(['result'=> false,'data'=> []]);
        }
        $recibo_empleado = ReciboEmpleado::with(['registroNominasReciboEmpleado'])->where('recibo_id', $recibo_id)->where('empleado_id', $empleado_id)->first();

        if (!$recibo_empleado){
            return json_encode(['result'=> false,'data'=> []]);
        }
        
        return json_encode(['result'=> true,'data'=> $recibo_empleado->registroNominasReciboEmpleado]);
    }

    /**
     * Realiza el cálculo del descuento de la primera quincena.
     *
     * @param  $request
     */
    public function primeraQuincena(Request $request) { 
        /**
         * Verificar que el usuario en sesión tenga permisos de realizar esta acción
         */
        if (Auth::user()->cannot('primeraQuincena', RegistroNominaReciboEmpleado::class)) {
            return redirect()->route('/');
        }

        /**
         * Obtener todos los empleados
         */
        $empleados = Empleado::get();
        /**
         * Buscar los ReciboEmpleado de cada uno de los empleados
         */
        foreach ($empleados as $empleado) {
            $recibo_empleado = ReciboEmpleado::where('recibo_id', $request->recibo_id)->where('empleado_id', $empleado->id)->first();
            /**
             * Calcular la primera quincena
             */
            $recibo_empleado->primer_quincena = round(($recibo_empleado->monto_total / 2), 2);
            /**
             * Guardar el recibo empleado
             */
            if(!$recibo_empleado->save()) {
                return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido facturar correctamente el periodo."))->withInput();
            }
        }

        $recibo = Recibo::find($request->recibo_id);
        $recibo->completo = 1;
        if(!$recibo->save()) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido actualizar el recibo."))->withInput();
        }
        /**
         * Devolver al index de ese recibo
         */
        return redirect()->action(
            'ReciboEmpleadoController@index', ['recibo_id' => $request->recibo_id]
        )->with(
            "alert", Utilidades::getAlert("success", "Éxito", "Se ha agregado correctamente el periodo de facturación.")
        )->withInput();
    }

    /**
     * Realiza el cálculo del pago de la segunda quincena.
     *
     * @param  $request
     */
    public function segundaQuincena(Request $request) {
        /**
         * Verificar que el usuario en sesión tenga permisos de realizar esta acción
         */
        if (Auth::user()->cannot('primeraQuincena', RegistroNominaReciboEmpleado::class)) {
            return redirect()->route('/');
        }

        /**
         * Obtener todos los empleados
         */
        $empleados = Empleado::get();
        $recibo = Recibo::find($request->recibo_id);
        $recibo->completo = 2;
        if(!$recibo->save()) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido actualizar el recibo."))->withInput();
        }
        /**
         * Devolver al index de ese recibo
         */
        return redirect()->action(
            'ReciboEmpleadoController@indexSegunda', ['recibo_id' => $request->recibo_id]
        )->with(
            "alert", Utilidades::getAlert("success", "Éxito", "Se ha agregado correctamente el periodo de facturación.")
        )->withInput();
    }
}
