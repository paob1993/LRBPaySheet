<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ClasificacionAdministrativo;
use App\OwnModels\Utilidades;
use App\Http\Requests\ClasificacionAdministrativoForm;

use Auth;

class ClasificacionAdministrativoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        /**
         * Verificar que el usuario en sesión tenga permisos de ver el index
         */

        if (Auth::user()->cannot('index',ClasificacionAdministrativo::class)) {
            return redirect()->route('/');
        }

        /**
         * Filtros
         */
        $cantidad = Utilidades::getWithDefault(filter_input(INPUT_GET, 'cantidad', FILTER_SANITIZE_NUMBER_INT), 15);
        $nivel = filter_input(INPUT_GET,'nivel', FILTER_SANITIZE_STRING);      
        $grado = filter_input(INPUT_GET, 'grado', FILTER_SANITIZE_STRING);

        $clasificacionAdministrativos = ClasificacionAdministrativo::orderBy('id','asc');
        $clasificacion_administrativo = ClasificacionAdministrativo::all();
        $clasf_grados = ClasificacionAdministrativo::where('nivel', '=', 'I')->get();
        $clasf_nivel = ClasificacionAdministrativo::where('grado', '=', 'B1')->get();


        /**
         * Aplicar filtros
         */
        if ($nivel) {
            $clasificacionAdministrativos = $clasificacionAdministrativos->where('nivel', 'LIKE', "%$nivel%");
        }

        if ($grado) {
            $clasificacionAdministrativos = $clasificacionAdministrativos->where('grado', 'LIKE', "%$grado%");
        }

         /**
         * Retorno la vista con las variables necesarias
         */

        return view('pages.clasificacionAdministrativos.index', [
            'clasificacionAdministrativos' => $clasificacionAdministrativos->paginate($cantidad),
            'busqueda_cantidad' => $cantidad,
            'nivel' => $nivel,
            'grado' => $grado,
            'clasificacion_administrativo' => $clasificacion_administrativo,
            'clasf_grados' => $clasf_grados,
            'clasf_nivel' => $clasf_nivel,            
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
     * @param  \App\Models\ClasificacionAdministrativo  $clasificacionAdministrativo
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        /**
         * Buscar la clasificación Obrera especificada
         */
        if (Auth::user()->cannot('view', ClasificacionAdministrativo::class)) {
            return json_encode(['result'=>false,'data'=>[]]);
        }

        $clasificacionAdministrativo_to_find = ClasificacionAdministrativo::where('id',$id)->first();

        if (!$clasificacionAdministrativo_to_find) {
            return json_encode(['result'=>false,'data'=>[]]);
        }
        
        return json_encode(['result'=>true,'data'=>$clasificacionAdministrativo_to_find]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClasificacionAdministrativo  $clasificacionAdministrativo
     * @return \Illuminate\Http\Response
     */
    public function edit(ClasificacionAdministrativo $clasificacionAdministrativo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClasificacionAdministrativo  $clasificacionAdministrativo
     * @return \Illuminate\Http\Response
     */
    public function update(ClasificacionAdministrativoForm $request, $id) {
        if (Auth::user()->cannot('update',ClasificacionAdministrativo::class)) {
            return redirect()->route('/');
        }

        $clasificaciónAdministrativo_to_edit = ClasificacionAdministrativo::find($id);

        if (!$clasificaciónAdministrativo_to_edit) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "La Clasificación Administrativa no existe o no se encuentra disponible."))->withInput();
        }

        $clasificaciónAdministrativo_to_edit->monto = $request->monto;

            if (!$clasificaciónAdministrativo_to_edit->save()) {
            return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido actualizar correctamente el monto"))->withInput();
        }

        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "El monto de la clasificación administrativa se ha actualizado correctamente."));  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClasificacionAdministrativo  $clasificacionAdministrativo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClasificacionAdministrativo $clasificacionAdministrativo)
    {
        //
    }


    public function updateAll(Request $request) {        
        if (Auth::user()->cannot('update',ClasificacionAdministrativo::class)) {
            return redirect()->route('/');
        }

        $clasificacionAdministrativo = ClasificacionAdministrativo::all();

        foreach ($clasificacionAdministrativo as $clasf_adm) {
            $id = 'monto-'.$clasf_adm->nivel.'-'.$clasf_adm->grado;
            if ($request->$id) {
                $clasf_adm->monto = $request->$id;
                if (!$clasf_adm->save()) {
                   return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se han podido actualizar correctamente todos los montos"))->withInput(); 
                }
            }
        }
        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "Se han actualizado correctamente todos los montos."));
    }
}
