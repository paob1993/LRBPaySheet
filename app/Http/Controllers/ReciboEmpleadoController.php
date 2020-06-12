<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use App\OwnModels\Utilidades;
use Illuminate\Http\Request;

use Auth;

class ReciboEmpleadoController extends Controller{ 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($recibo_id) {
        if (Auth::user()->cannot('index',Recibo::class)) {
            return redirect()->route('/');
        }
        $recibo = Recibo::with(['recibosEmpleados', 'recibosEmpleados.empleado', 'recibosEmpleados.registroNominasReciboEmpleado'])->find($recibo_id);
        return view('pages.gestionNomina.recibos.index', [
            'recibo' => $recibo,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSegunda($recibo_id) {
        if (Auth::user()->cannot('index',Recibo::class)) {
            return redirect()->route('/');
        }
        $recibo = Recibo::with(['recibosEmpleados', 'recibosEmpleados.empleado', 'recibosEmpleados.registroNominasReciboEmpleado'])->find($recibo_id);
        return view('pages.gestionNomina.recibos.indexSegunda', [
            'recibo' => $recibo,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (Auth::user()->cannot('create',Recibo::class)) {
            return redirect()->route('/');
        }
        return view('pages.gestionNomina.recibos.store');       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (Auth::user()->cannot('create',Recibo::class)) {
            return redirect()->route('');
        }

        $recibo_id = null;

        $recibo = Recibo::where('mes', '=', $request->mes)
            ->where('ano', '=', $request->ano)
            ->first();

        if ($recibo) {
            if (!$recibo->recibosEmpleados->isEmpty()) {
                return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "Este periodo de facturación ya fue creado."))->withInput();
            } 
            $recibo_id = $recibo->id;              
        } else {
            $recibo_to_add = new Recibo();
            $recibo_to_add->mes = $request->mes;
            $recibo_to_add->ano = $request->ano;

            if(!$recibo_to_add->save()) {
                return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "No se ha podido agregar correctamente este periodo de facturación."))->withInput();                  
            }
            $recibo_id = $recibo_to_add->id;
        }

        return redirect()->action(
            'RegistroNominaReciboEmpleadoController@create', ['recibo_id' => $recibo_id]
        )->with(
            "alert", Utilidades::getAlert("success", "Éxito", "Se ha agregado correctamente el periodo de facturación.")
        )->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function show(Recibo $recibo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function edit(Recibo $recibo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recibo $recibo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recibo $recibo)
    {
        //
    }
}
