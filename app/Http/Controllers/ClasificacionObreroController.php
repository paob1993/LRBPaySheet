<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ClasificacionObrero;
use App\OwnModels\Utilidades;
use App\Http\Requests\ClasificacionObreraForm;

use Auth;

class ClasificacionObreroController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        /**
         * Verificar que el usuario en sesión tenga permisos de ver el index
         */

        if (Auth::user()->cannot('index',ClasificacionObrero::class)) {
            return redirect()->route('/');
        }

        /**
         * Filtros
         */
        $cantidad = Utilidades::getWithDefault(filter_input(INPUT_GET, 'cantidad', FILTER_SANITIZE_NUMBER_INT), 15);
        $grado = filter_input(INPUT_GET, 'grado', FILTER_SANITIZE_NUMBER_INT);
        $paso = filter_input(INPUT_GET, 'paso', FILTER_SANITIZE_NUMBER_INT);

        /**
         * Obtener toda la clasificación Obrera
         */
        $clasificacionObreros = ClasificacionObrero::orderBy('id','asc');
        $clasificacion_obrero = ClasificacionObrero::all();
        $clasf_grados = ClasificacionObrero::where('paso', 1)->get();
        $clasf_pasos = ClasificacionObrero::where('grado', 1)->get();

        /**
         * Aplicar filtros
         */
        if ($grado) {
            $clasificacionObreros = $clasificacionObreros->where('grado', 'LIKE', "%$grado%");
        }
        if ($paso) {
            $clasificacionObreros = $clasificacionObreros->where('paso', 'LIKE', "%$paso%");
        }

        /**
         * Retorno la vista con las variables necesarias
         */

        return view('pages.clasificacionObreros.index', [
            'clasificacionObreros' => $clasificacionObreros->paginate($cantidad),
            'busqueda_cantidad' => $cantidad,
            'grado' => $grado,
            'paso' => $paso,
            'clasificacion_obrero' => $clasificacion_obrero,
            'clasf_grados' => $clasf_grados,
            'clasf_pasos' => $clasf_pasos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClasificacionObrero  $clasificacionObrero
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        /**
         * Buscar la clasificación Obrera especificada
         */
           if (Auth::user()->cannot('view', ClasificacionObrero::class)) {
            return json_encode(['result'=>false,'data'=>[]]);
        }

        $clasificacionObrero_to_find = ClasificacionObrero::where('id',$id)->first();

        if (!$clasificacionObrero_to_find){
            return json_encode(['result'=>false,'data'=>[]]);
        }
        
        return json_encode(['result'=>true,'data'=>$clasificacionObrero_to_find]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClasificacionObrero  $clasificacionObrero
     * @return \Illuminate\Http\Response
     */
    public function edit(ClasificacionObrero $clasificacionObrero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClasificacionObrero  $clasificacionObrero
     * @return \Illuminate\Http\Response
     */
    public function update(ClasificacionObreraForm $request, $id) {
        if (Auth::user()->cannot('update',ClasificacionObrero::class)) {
            return redirect()->route('/');
        }

        $clasificaciónObrero_to_edit = ClasificacionObrero::find($id);

        if (!$clasificaciónObrero_to_edit) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "La Clasificación Obrera no existe o no se encuentra disponible."))->withInput();
        }

        $clasificaciónObrero_to_edit->monto = $request->monto;

            if (!$clasificaciónObrero_to_edit->save()) {
            return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido actualizar correctamente el monto"))->withInput();
        }

        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "El monto de la clasificación obrera se ha actualizado correctamente."));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClasificacionObrero  $clasificacionObrero
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClasificacionObrero $clasificacionObrero)
    {
        //
    }


    public function updateAll(Request $request) {        
        if (Auth::user()->cannot('update',ClasificacionObrero::class)) {
            return redirect()->route('/');
        }

        $clasificacionObrero = ClasificacionObrero::all();

        foreach ($clasificacionObrero as $clasf_obr) {
            $id = 'monto-'.$clasf_obr->paso.'-'.$clasf_obr->grado;
            if ($request->$id) {
                $clasf_obr->monto = $request->$id;
                if (!$clasf_obr->save()) {
                   return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se han podido actualizar correctamente todos los montos"))->withInput(); 
                }
            }
        }
        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "Se han actualizado correctamente todos los montos."));
    }

}
