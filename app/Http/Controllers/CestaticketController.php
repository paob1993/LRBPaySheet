<?php

namespace App\Http\Controllers;

use App\Models\Cestaticket;
use Illuminate\Http\Request;
use App\OwnModels\Utilidades;
use App\OwnModels\OwnArrays;
use App\Models\Recibo;
use App\Models\VariablesGlobales;
use App\Models\Empleado;

use Auth;


class CestaticketController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($recibo_id) {
        if (Auth::user()->cannot('view',Recibo::class)) {
            return redirect()->route('/');            
        }
        $recibo = Recibo::with(['cestatickets', 'cestatickets.empleado'])->find($recibo_id);
        return view('pages.cestatickets.recibos.index', [
            'recibo' => $recibo,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($recibo_id) {
        if (Auth::user()->cannot('create',Recibo::class)) {
            return redirect()->route('/');
        }
        $recibo = Recibo::find($recibo_id);
        $cestaticket_configuraciones = VariablesGlobales::with(['variablesGlobalesTiposEmpleado'])
            ->where('formula', OwnArrays::FORMULA_CESTATICKET)
            ->get();

        return view('pages.cestatickets.store', [
            'cestaticket_configuraciones' => $cestaticket_configuraciones,
            'recibo_cestaticket_id' => $recibo_id
            ]);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (Auth::user()->cannot('create', Empleado::class)){
            return redirect()->route('/');
        }
        $recibo_id = (int)$request->recibo_id;
        $recibo = Recibo::find($recibo_id); 
        $empleados = Empleado::with('cargo')->get();

        $horas_dia_valor = VariablesGlobales::with('variablesGlobalesTiposEmpleado')
            ->where('descripcion', '=', 'Cantidad de Horas Diarias')
            ->where('formula', OwnArrays::FORMULA_CESTATICKET)
            ->first();

        $monto_vigente = VariablesGlobales::with('variablesGlobalesTiposEmpleado')
            ->where('descripcion', '=', 'Monto Vigente Mensual')
            ->where('formula', OwnArrays::FORMULA_CESTATICKET)
            ->first();

        $valor_hora_administrativo = round($monto_vigente->obtenerParaTipoEmpleado(OwnArrays::EMPLEADO_ADMINISTRATIVO) / 30 / $horas_dia_valor->obtenerParaTipoEmpleado(OwnArrays::EMPLEADO_ADMINISTRATIVO), 2);
        $valor_hora_docente = round($monto_vigente->obtenerParaTipoEmpleado(OwnArrays::EMPLEADO_DOCENTE) / 30 / $horas_dia_valor->obtenerParaTipoEmpleado(OwnArrays::EMPLEADO_DOCENTE), 2);
        $valor_hora_obrero = round($monto_vigente->obtenerParaTipoEmpleado(OwnArrays::EMPLEADO_OBRERO) / 30 / $horas_dia_valor->obtenerParaTipoEmpleado(OwnArrays::EMPLEADO_OBRERO), 2);

        foreach ($empleados as $empleado) {
            $cestaticket_to_add = new Cestaticket();
            $cestaticket = Cestaticket::where('recibo_id', $request->recibo_id)
                ->where('empleado_id', $empleado->id)
                ->first();
            if ($cestaticket !== null) {
                $cestaticket_to_add = $cestaticket;
            }
            $cestaticket_to_add->empleado_id = $empleado->id;
            $cestaticket_to_add->recibo_id = $request->recibo_id;

            if ($empleado->cargo->tipo_empleado == OwnArrays::EMPLEADO_ADMINISTRATIVO) {
                $cestaticket_to_add->cestaticket_valor = $valor_hora_administrativo;
                $cestaticket_to_add->tickets_mes = $empleado->tiempo_completo ? 
                    $monto_vigente->obtenerParaTipoEmpleado(OwnArrays::EMPLEADO_ADMINISTRATIVO) : 
                    round(($empleado->horas_semanales / 5), 2 )* 30 * $valor_hora_administrativo;
                $cestaticket_to_add->asignacion = $cestaticket_to_add->tickets_mes;

            } else if ($empleado->cargo->tipo_empleado == OwnArrays::EMPLEADO_DOCENTE) {
                $cestaticket_to_add->cestaticket_valor = $valor_hora_docente;
                $cestaticket_to_add->tickets_mes = $empleado->tiempo_completo ? 
                    $monto_vigente->obtenerParaTipoEmpleado(OwnArrays::EMPLEADO_DOCENTE) :
                    round(($empleado->horas_semanales / 5), 2) * 30 * $valor_hora_docente;
                $cestaticket_to_add->asignacion = $cestaticket_to_add->tickets_mes;

            } else {
                $cestaticket_to_add->cestaticket_valor = $valor_hora_obrero;
                $cestaticket_to_add->tickets_mes = $empleado->tiempo_completo ? 
                    $monto_vigente->obtenerParaTipoEmpleado(OwnArrays::EMPLEADO_OBRERO) :
                    round(($empleado->horas_semanales / 5), 2) * 30 * $valor_hora_obrero; 
                $cestaticket_to_add->asignacion = $cestaticket_to_add->tickets_mes;
            }

            $cestaticket_to_add->faltas = 0;
            $cestaticket_to_add->save();
        }

        return redirect()->action(
            'ReciboController@update', ['id' => $recibo_id]
        )->with(
            "alert", Utilidades::getAlert("success", "Éxito", "Se han agregado correctamente las facturas.")
        )->withInput();

    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cestaticket  $cestaticket
     * @return \Illuminate\Http\Response
     */
    public function show(Cestaticket $cestaticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cestaticket  $cestaticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Cestaticket $cestaticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cestaticket  $cestaticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cestaticket_id ) {

        if (Auth::user()->cannot('update',Cestaticket::class)) {
            return redirect()->route('/');
        }

        $cestaticket_update = Cestaticket::find($cestaticket_id);
        $descontado = $request->faltas*$cestaticket_update->cestaticket_valor;
        $cestaticket_update->faltas = $request->faltas;
        $cestaticket_update->asignacion = $cestaticket_update->asignacion - $descontado;

        if (!$cestaticket_update->save()) {
            return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido actualizar correctamente el cestaticket."))->withInput();
        }

        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "El cestaticket se ha actualizado correctamente."));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cestaticket  $cestaticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cestaticket $cestaticket)
    {
        //
    }
}
