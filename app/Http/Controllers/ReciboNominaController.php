<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Recibo;
use App\Models\Empleado;
use App\Models\RegistroNomina;
use App\Models\ReciboEmpleado;
use App\Models\RegistroNominaReciboEmpleado;

use App\OwnModels\Utilidades;
use App\OwnModels\OwnArrays;

use Auth;

class ReciboNominaController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::user()->cannot('index',Recibo::class)) {
            return redirect()->route('/');
        } 

        $cantidad = Utilidades::getWithDefault(filter_input(INPUT_GET, 'cantidad', FILTER_SANITIZE_NUMBER_INT), 15);
        $id_recibo = filter_input(INPUT_GET,'id_recibo',FILTER_SANITIZE_NUMBER_INT);


        $nominas = ReciboEmpleado::orderBy('id','asc');
        $recibos = Recibo::whereHas('recibosEmpleados')->orderBy('id','asc')->get();
        $niveles_instruccion = OwnArrays::$niveles_instruccion;
        $titulos_docentes = OwnArrays::$descripciones_titulos;
        $basados_en = OwnArrays::$basados_en_value;
        $editable = false;

        if($id_recibo){
            $nominas = $nominas->where('recibo_id',$id_recibo);
            $recibo_to_find = Recibo::find($id_recibo);
            if ($recibo_to_find->completo === 1) {
                $editable = true;
            }
        }

        return view('pages.gestionNomina.index', [
            'nominas' => $nominas->paginate($cantidad),
            'busqueda_cantidad' => $cantidad,
            'recibos' => $recibos,
            'id_recibo' => $id_recibo,
            'niveles_instruccion' => $niveles_instruccion,
            'titulos_docentes' => $titulos_docentes,
            'basados_en' => $basados_en,
            'editable' => $editable,
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
     * @param  \App\Models\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        /**
         * Buscar el empleado especificado
         */
        $recibo_to_find = ReciboEmpleado::with(['recibo', 'empleado', 'empleado.cargo',
            'registroNominasReciboEmpleado', 'registroNominasReciboEmpleado.registroNomina',
            'empleado.obrero', 'empleado.obrero.clasificacionObrero',
            'empleado.docente', 'empleado.docente.categoriaDocente',
            'empleado.administrativo', 'empleado.administrativo.clasificacionAdministrativo'])
            ->where('recibo_empleado.id', $id)
            ->first();

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
        if (Auth::user()->cannot('create',RegistroNominaReciboEmpleado::class)) {
            return redirect()->route('/');
        }

        $registros_nomina_manuales = RegistroNomina::where('determinado', OwnArrays::TIPO_MANUAL)->get();
        $empleados = Empleado::orderBy('id','asc');  
        $recibo = Recibo::find($id);  

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

        return view('pages.gestionNomina.storeManual2daQuincena', [
            'registros_nomina_manuales' => $registros_nomina_manuales,
            'recibo_id' => $id,
            'recibo' => $recibo,
            'empleados' => $empleados->get(),
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
