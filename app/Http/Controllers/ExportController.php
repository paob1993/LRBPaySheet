<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recibo;
use App\Models\Cestaticket;
use Maatwebsite\Excel\Facades\Excel;
use App\OwnModels\Utilidades;

class ExportController extends Controller  {


  public function exportar($recibo_id) {

    $recibo = Recibo::where('id', $recibo_id)->get()->first();
    $cestatickets = Cestaticket::where('recibo_id', $recibo_id)->get();
    $periodo = "Recibo "."$recibo->mes"."-"."$recibo->ano";

    Excel::create($periodo, function($excel) use($cestatickets, $periodo) {

      $excel->sheet($periodo, function($sheet) use ($cestatickets) {
        $sheet->setStyle(array
          ('font' => array(
            'name'      =>  'Calibri',
            'size'      =>  12
          ))
        );
        $sheet->row(1, ['Empleado','Cédula','Cargo', 'Monto Mensual', 'Depositado', 'Descontado']);
        foreach($cestatickets as $index => $cestaticket) {
          $sheet->row($index + 2, [
            $cestaticket->empleado->nombres." ".$cestaticket->empleado->apellidos, $cestaticket->empleado->cedula, $cestaticket->empleado->cargo->descripcion, $cestaticket->tickets_mes, $cestaticket->asignacion, $cestaticket->faltas
          ]); 
        }
      });
    })->download('xlsx');

  }

  public function errorToExport() {
    return redirect()->back()->with("alert", Utilidades::getAlert("danger", "Error", "Selecione y busque el período a exportar."))->withInput();
  }

  public function exportarCestatickets($recibo_id) {

    $recibo = Recibo::where('id', $recibo_id)->get()->first();
    $cestatickets = Cestaticket::where('recibo_id', $recibo_id)->get();
    $periodo = "Recibo "."$recibo->mes"."-"."$recibo->ano";

    Excel::create($periodo, function($excel) use($cestatickets, $periodo) {

      $excel->sheet($periodo, function($sheet) use ($cestatickets) {
        $sheet->setStyle(array
          ('font' => array(
            'name'      =>  'Calibri',
            'size'      =>  12
          ))
        );
        $sheet->row(1, ['Empleado','Cédula','Cargo', 'Monto Mensual', 'Depositado', 'Descontado']);
        foreach($cestatickets as $index => $cestaticket) {
          $sheet->row($index + 2, [
            $cestaticket->empleado->nombres." ".$cestaticket->empleado->apellidos, $cestaticket->empleado->cedula, $cestaticket->empleado->cargo->descripcion, $cestaticket->tickets_mes, $cestaticket->asignacion, $cestaticket->faltas
          ]); 
        }
      });
    })->download('xlsx');

  }

  public function exportarNomina($id) {
    dd($id);
  }

  public function exportarReciboEmpleado($id) {
    dd($id);
  }

  public function exportarReciboPrestacionesEmpleado($id) {
    dd($id);
  }

  public function exportarArchivoDeBancoPrimeraQuincena($id) {
    dd($id);
  }

  public function exportarArchivoDeBancoSegundaQuincena($id) {
    dd($id);
  }

  public function exportarArchivoDeBancoPrestaciones($id) {
    dd($id);
  }

  public function exportarArchivoDeBancoCestatickets($id) {
    dd($id);
  }

}
