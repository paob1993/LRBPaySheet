<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests\CargoForm;
use App\Models\Cargo;
use App\OwnModels\Utilidades;

use Auth;

class CargoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::user()->cannot('index', Cargo::Class)) {
            return redirect()->route('/');
        }

        $cantidad = Utilidades::getWithDefault(filter_input(INPUT_GET, 'cantidad', FILTER_SANITIZE_NUMBER_INT), 15);
        $abreviatura = filter_input(INPUT_GET, 'abreviatura', FILTER_SANITIZE_STRING);
        $descripcion = filter_input(INPUT_GET, 'descripcion', FILTER_SANITIZE_STRING);
        $tipo_empleado = filter_input(INPUT_GET, 'tipo_empleado', FILTER_SANITIZE_NUMBER_INT);
        
        $cargos = Cargo::orderBy('id','asc');

        if($abreviatura){
            $cargos = $cargos->where('abreviatura', 'LIKE', "%$abreviatura%");
        }
        if($descripcion){
            $cargos= $cargos->where('descripcion', 'LIKE', "%$descripcion%");
        }
        if($tipo_empleado){
            $cargos= $cargos->where('tipo_empleado', $tipo_empleado);
        }

        return view('pages.cargos.index', [
            'cargos' => $cargos->paginate($cantidad),
            'busqueda_cantidad' => $cantidad,
            'abreviatura' => $abreviatura,
            'descripcion' => $descripcion,
            'tipo_empleado' => $tipo_empleado,
        ]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CargoForm $request) {
        if (Auth::user()->cannot('create', Cargo::class)) {
            return redirect()->route('');
        }

        $cargo_to_add = new Cargo();
        $cargo_to_add->abreviatura = strtoupper($request->abreviatura);
        $cargo_to_add->descripcion = $request->descripcion;
        $cargo_to_add->tipo_empleado = $request->tipo_empleado;

        if (!$cargo_to_add->save()) {
            return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido agregar correctamente el cargo."))->withInput();
        }

        return redirect()->back()->with("alert", Utilidades::getAlert("success", "Éxito", "Se ha agregado correctamente el cargo."));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if (Auth::user()->cannot('view', Cargo::class)) {
            return json_encode(['result'=> false,'data'=> []]);
        }

        $cargo_to_find = Cargo::where('id',$id)
            ->first();

        if (!$cargo_to_find){
            return json_encode(['result'=> false,'data'=> []]);
        }
        
        return json_encode(['result'=> true,'data'=> $cargo_to_find]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(CargoForm $request, $id){
        if (Auth::user()->cannot('update', Cargo::class)) {
            return redirect()->route('/');
        }

        $cargo_to_edit = Cargo::find($id);

        if (!$cargo_to_edit) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "El Cargo no existe o no se encuentra disponible."))->withInput();
        }

        $cargo_to_edit->abreviatura = strtoupper($request->abreviatura);
        $cargo_to_edit->descripcion = $request->descripcion;
        $cargo_to_edit->tipo_empleado = $request->tipo_empleado;

        if (!$cargo_to_edit->save()) {
            return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido actualizar correctamente el cargo."))->withInput();
        }

        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "El cargo se ha actualizado correctamente."));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cargo $cargo)
    {
        //
    }

    public function obtenerTipoEmpleado($cargoId) {
        if(Auth::user()->cannot('getTipoEmpleado',Cargo::class)){
            return json_encode(['result'=>false,'data'=>[]]);
        }

        $cargo = Cargo::find($cargoId);
            
        if(!$cargo){
            return json_encode(['result'=>false,'data'=>[]]);   
        }

        return json_encode(['result'=>true,'data'=>$cargo->tipo_empleado]);
    }
}
