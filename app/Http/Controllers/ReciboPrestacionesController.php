<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use App\Models\PrestacionesSociales;
use App\Models\ReciboPrestacionesSociales;

use App\OwnModels\OwnArrays;
use App\OwnModels\Utilidades;

use Illuminate\Http\Request;

use Auth;

class ReciboPrestacionesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::user()->cannot('index',ReciboPrestacionesSociales::class)) {
            return redirect()->route('/');
        } 

        $cantidad = Utilidades::getWithDefault(filter_input(INPUT_GET, 'cantidad', FILTER_SANITIZE_NUMBER_INT), 15);
        $id_recibo_prestaciones = filter_input(INPUT_GET,'id_recibo_prestaciones',FILTER_SANITIZE_NUMBER_INT);
        $prestaciones_sociales = PrestacionesSociales::orderBy('id', 'asc');
        $recibos_prestaciones = ReciboPrestacionesSociales::all();
        $niveles_instruccion = OwnArrays::$niveles_instruccion;
        $titulos_docentes = OwnArrays::$descripciones_titulos;
        $basados_en = OwnArrays::$basados_en_value;

        if($id_recibo_prestaciones) {
            $prestaciones_sociales = $prestaciones_sociales->where('recibo_prestacionesSociales_id',$id_recibo_prestaciones);
        }

        return view('pages.prestaciones.index', [
            'busqueda_cantidad' => $cantidad,
            'id_recibo_prestaciones' => $id_recibo_prestaciones,
            'prestaciones_sociales' => $prestaciones_sociales->paginate($cantidad),
            'recibos_prestaciones' => $recibos_prestaciones,
            'niveles_instruccion' => $niveles_instruccion,
            'titulos_docentes' => $titulos_docentes,
            'basados_en' => $basados_en, 
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
       if (Auth::user()->cannot('create',ReciboPrestacionesSociales::class)) {
            return redirect()->route('/');
        }
        return view('pages.prestaciones.recibos.store'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (Auth::user()->cannot('create',ReciboPrestacionesSociales::class)) {
            return redirect()->route('/');
        }
        $recibo_prestaciones_id = null;
        $recibo_prestaciones = ReciboPrestacionesSociales::where('trimestre', $request->trimestre)
            ->where('ano', $request->ano)
            ->first();

        if($recibo_prestaciones) {
            $prestaciones_sociales = PrestacionesSociales::where('recibo_prestacionesSociales_id','=', $recibo_prestaciones->id)->get();
            if(!$prestaciones_sociales->isEmpty()) {
                return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "Este período ya fue creado."))->withInput();
            }
            $recibo_prestaciones_id = $recibo_prestaciones->id;
        } else {
            $recibo_prestaciones_to_add = new ReciboPrestacionesSociales();
            $recibo_prestaciones_to_add->trimestre = $request->trimestre;
            $recibo_prestaciones_to_add->ano = $request->ano;
            if(!$recibo_prestaciones_to_add->save()) {
                return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error","No se ha podido agregar correctamente este periodo."))->withInput();
            }
            $recibo_prestaciones_id = $recibo_prestaciones_to_add->id;
        }

        $mes = $request->trimestre * 3; // 1er = Marzo, 2do = Junio, 3er = Septiembre, 4to = Diciembre
        // Verificar que el Periodo de Nómina esté facturado ya
        $recibo = Recibo::where('ano', '=', $request->ano)
            ->where('mes', '=', $mes)
            ->first();

        if ($recibo && $recibo->completo == 2) { // Fue facturado en su totalidad la nómina del mes correspondiente al trimestre
            return redirect()->action(
                'PrestacionesController@create', ['recibo_prestaciones_id' => $recibo_prestaciones_id]
            )->with(
                "alert", Utilidades::getAlert("success", "Éxito", "Se ha agregado correctamente el período")
            )->withInput();            
        } else {
            return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error","Aún no ha sido facturado el periodo de nómina que corresponde a este trimestre."))->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\ReciboPrestacionesSociales  $reciboPrestacionesSociales
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        /**
         * Buscar el empleado especificado
         */
        $recibo_to_find = PrestacionesSociales::with(['reciboPrestacionesSociales', 'empleado', 'empleado.cargo',
            'empleado.obrero', 'empleado.obrero.clasificacionObrero',
            'empleado.docente', 'empleado.docente.categoriaDocente',
            'empleado.administrativo', 'empleado.administrativo.clasificacionAdministrativo'])
            ->find($id);

        /**
         * Si no se encuentra el usuario o si quien está logueado no tiene permisos para acceder a la vista de usuario se
         * retorna falso en el resultado.
         */
        if(!$recibo_to_find || Auth::user()->cannot('view', $recibo_to_find)){
            return json_encode(['result'=>false,'data'=>[]]);
        }; 

        /**
         * Se retorna el resultado en true y la data solicitada
         */      
        return json_encode(['result'=>true,'data'=>$recibo_to_find]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\ReciboPrestacionesSociales  $reciboPrestacionesSociales
     * @return \Illuminate\Http\Response
     */
    public function edit(ReciboPrestacionesSociales $reciboPrestacionesSociales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\ReciboPrestacionesSociales  $reciboPrestacionesSociales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\ReciboPrestacionesSociales  $reciboPrestacionesSociales
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReciboPrestacionesSociales $reciboPrestacionesSociales)
    {
        //
    }

    public function listarPrestaciones($recibo_id) {
        if (Auth::user()->cannot('index',ReciboPrestacionesSociales::class)) {
            return redirect()->route('/');
        } 
        $recibo = ReciboPrestacionesSociales::with(['prestacionesSociales', 'prestacionesSociales.empleado'])
            ->find($recibo_id);

        return view('pages.prestaciones.recibos.index', [
            'recibo' => $recibo,
        ]);
    }
}
