<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\CategoriaDocente;
use App\OwnModels\Utilidades;
use App\Http\Requests\CategoriaDocenteForm;

use Auth;

class CategoriaDocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->cannot('index',CategoriaDocente::class)){
            return redirect()->route('/');
        }

        $categoriasDocentes = CategoriaDocente::orderBy('id','asc')->get();

        return view('pages.categoriasDocentes.index', [
            'categoriasDocentes' => $categoriasDocentes,
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
    public function store(CategoriaDocenteForm $request)
    {     

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoriaDocente  $categoriaDocente
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        if (Auth::user()->cannot('view',CategoriaDocente::class)){
            return json_encode(['result'=>false,'data'=>[]]);
        }

        $categoriaDocente_to_find = CategoriaDocente::where('id',$id)->first();

        if (!$categoriaDocente_to_find){
            return json_encode(['result'=>false,'data'=>[]]);
        }
        
        return json_encode(['result'=>true,'data'=>$categoriaDocente_to_find]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoriaDocente  $categoriaDocente
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaDocente $categoriaDocente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoriaDocente  $categoriaDocente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        if (Auth::user()->cannot('update',CategoriaDocente::class)) {
            return redirect()->route('/');
        }

        $categoriaDocente_to_edit = CategoriaDocente::find($id);

        if (!$categoriaDocente_to_edit) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "La Categoría Docente no existe o no se encuentra disponible."))->withInput();
        }

        $categoriaDocente_to_edit->valor_hora = $request->valor_hora;

        if (!$categoriaDocente_to_edit->save()) {
            return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido actualizar correctamente la categoría docente."))->withInput();
        }

        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "La categoría docente se ha actualizado correctamente."));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoriaDocente  $categoriaDocente
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriaDocente $categoriaDocente) {
        //
    }
}
