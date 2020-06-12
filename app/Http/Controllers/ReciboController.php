<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use App\Models\Cestaticket; 
use Illuminate\Http\Request;
use App\OwnModels\Utilidades;

use Auth;


class ReciboController extends Controller {


    public function index() {
        if (Auth::user()->cannot('index',Recibo::class)) {
            return redirect()->route('/');
        } 

        $cantidad = Utilidades::getWithDefault(filter_input(INPUT_GET, 'cantidad', FILTER_SANITIZE_NUMBER_INT), 15);
        $id_recibo = filter_input(INPUT_GET,'id_recibo',FILTER_SANITIZE_NUMBER_INT);

        $cestatickets = Cestaticket::orderBy('id','asc');
        $recibos = Recibo::orderBy('id','asc')->get();

        if($id_recibo){
            $cestatickets = $cestatickets->where('recibo_id',$id_recibo);
        }

        return view('pages.cestatickets.index', [
            'cestatickets' => $cestatickets->paginate($cantidad),
            'busqueda_cantidad' => $cantidad,
            'recibos' => $recibos,
            'id_recibo' => $id_recibo,
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
        return view('pages.cestatickets.recibos.store');       
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
            $cestaticket = Cestaticket::where('recibo_id', '=', $recibo->id)->get();
            if (!$cestaticket->isEmpty()) {
                return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "Este período de facturación ya fue creado."))->withInput();
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
            'CestaticketController@create', ['recibo_id' => $recibo_id]
        )->with(
            "alert", Utilidades::getAlert("success", "Éxito", "Se ha agregado correctamente el período de facturación.")
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
    public function update($id) {

    	if (Auth::user()->cannot('update',Recibo::class)) {
            return redirect()->route('/');
        }

    	$cestatickets = Cestaticket::with('empleado')->where('recibo_id',$id);
    	$periodo = Recibo::find($id);

    	$nombres=filter_input(INPUT_GET,'nombres',FILTER_SANITIZE_STRING);
        $apellidos=filter_input(INPUT_GET,'apellidos',FILTER_SANITIZE_STRING);
        $cedula=filter_input(INPUT_GET,'cedula',FILTER_SANITIZE_STRING);

        if ($nombres) {
        	$cestatickets = $cestatickets->whereHas('empleado', function($query)use($nombres) {
        		$query->where('nombres','LIKE',"%$nombres%");
        	});
        }

        if ($apellidos) {
        	$cestatickets = $cestatickets->whereHas('empleado', function($query)use($apellidos) {
        		$query->where('apellidos','LIKE',"%$apellidos%");
        	});        	
        }

        if ($cedula) {
        	$cestatickets = $cestatickets->whereHas('empleado', function($query)use($cedula) {
        		$query->where('cedula','LIKE',"%$cedula%");
        	});        	
        }

        return view('pages.cestatickets.recibos.update',[
        		'cestatickets' => $cestatickets->get(), 
        		'periodo' => $periodo,
        		'nombres' => $nombres, 
        		'apellidos' => $apellidos, 
        		'cedula' => $cedula
    	]);        
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
