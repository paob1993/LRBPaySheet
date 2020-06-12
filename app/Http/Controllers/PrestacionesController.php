<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use App\Models\Empleado;
use App\Models\ReciboEmpleado;
use App\Models\VariablesGlobales;
use App\Models\PrestacionesSociales;
use App\Models\ReciboPrestacionesSociales;

use App\OwnModels\OwnArrays;
use App\OwnModels\Utilidades;

use Illuminate\Http\Request;

use Auth;

class PrestacionesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($recibo_prestaciones_id) {
        if (Auth::user()->cannot('create',ReciboPrestacionesSociales::class)) {
            return redirect()->route('/');
        }
        $prestaciones_configuraciones = VariablesGlobales::with(['variablesGlobalesTiposEmpleado'])->where('formula', OwnArrays::FORMULA_PRESTACIONES_SOCIALES)->get();

        return view('pages.prestaciones.store', [
            'prestaciones_configuraciones' => $prestaciones_configuraciones,
            'recibo_prestaciones_id' => $recibo_prestaciones_id
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
        $recibo_prestaciones = ReciboPrestacionesSociales::find((int)$request->recibo_id);
        $recibo = Recibo::where('ano', '=', $recibo_prestaciones->ano)
            ->where('mes', '=', $recibo_prestaciones->trimestre * 3)
            ->first();
        $empleados = Empleado::with('cargo')->get();
        $alicuota = VariablesGlobales::with('variablesGlobalesTiposEmpleado')
            ->where('descripcion', '=', 'Alicuota')
            ->first();

        foreach ($empleados as $empleado) {
            $prestacion_social = new PrestacionesSociales();
            // Buscar si ya existe
            $ps = PrestacionesSociales::where('empleado_id', $empleado->id)
                ->where('recibo_prestacionesSociales_id', $recibo_prestaciones->id)
                ->first();
            if ($ps) {
                $prestacion_social = $ps;
            }
            // Buscar el recibo del empleado correspondiente a este periodo
            $recibo_empleado = ReciboEmpleado::where('recibo_id', $recibo->id)
                ->where('empleado_id', $empleado->id)
                ->first();
            $prestacion_social->recibo_prestacionesSociales_id = $recibo_prestaciones->id;
            $prestacion_social->empleado_id = $empleado->id;
            $prestacion_social->monto = round(($recibo_empleado->monto_total * $alicuota->obtenerParaTipoEmpleado($empleado->cargo->tipo_empleado) * 3), 2);          
            // Guardar la prestación social de este empleado
            if(!$prestacion_social->save()) {
                return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se han podido facturar correctamente las prestaciones sociales de todos los trabajadores."))->withInput();
            }
            // Actualizar el acumulado en el empleado
            $empleado->prestaciones_sociales_acumuladas += $prestacion_social->monto;
            // Actualizar el Empleado
            if(!$empleado->save()) {
                return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se han podido facturar correctamente las prestaciones sociales de todos los trabajadores."))->withInput();
            }

        }
        /**
         * Devolver al index de ese recibo
         */
        return redirect()->action(
            'ReciboPrestacionesController@listarPrestaciones', ['recibo_id' => $recibo_prestaciones->id]
        )->with(
            "alert", Utilidades::getAlert("success", "Éxito", "Se han facturado las prestaciones sociales para este trimestre correctamente.")
        )->withInput();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\PrestacionesSociales  $prestacionesSociales
     * @return \Illuminate\Http\Response
     */
    public function show(PrestacionesSociales $prestacionesSociales) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\PrestacionesSociales  $prestacionesSociales
     * @return \Illuminate\Http\Response
     */
    public function edit(PrestacionesSociales $prestacionesSociales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\PrestacionesSociales  $prestacionesSociales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $prestacionesSociales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\PrestacionesSociales  $prestacionesSociales
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrestacionesSociales $prestacionesSociales)
    {
        //
    }
}
