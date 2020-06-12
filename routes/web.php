<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return redirect()->route("login");
})->name('/');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth'], function() {

    Route::group(['prefix' => 'cargos'], function(){
        Route::get('tipoEmpleado/{cargoId}','CargoController@obtenerTipoEmpleado');
        Route::get('/','CargoController@index')->name('cargos');
        Route::post('','CargoController@store');
        Route::get('/{id}','CargoController@show');
        Route::put('/{id}','CargoController@update');
        Route::delete('/{id}','CargoController@destroy');
    });

    Route::group(['prefix' => 'cestatickets'], function(){
        Route::get('/ver/{recibo_id}','CestaticketController@index')->name('cestatickets');
        Route::get('/calcular/{recibo_cestaticket_id}','CestaticketController@create');
        Route::post('','CestaticketController@store');
        Route::get('/{id}','CestaticketController@show');
        Route::put('/{id}','CestaticketController@update');
    });

    Route::group(['prefix' => 'categoriasDocentes'], function(){
        Route::get('/','CategoriaDocenteController@index')->name('categoriasDocentes');
        Route::get('/{id}','CategoriaDocenteController@show');
        Route::put('/{id}','CategoriaDocenteController@update');
    });

    Route::group(['prefix' => 'clasificacionObreros'], function(){
        Route::post('/updateAll','ClasificacionObreroController@updateAll')->name('clasificacionObreros');
        Route::get('/','ClasificacionObreroController@index');
        Route::get('/{id}','ClasificacionObreroController@show');
        Route::put('/{id}','ClasificacionObreroController@update');
    });

    Route::group(['prefix' => 'clasificacionAdministrativos'], function(){
        Route::post('/updateAll','ClasificacionAdministrativoController@updateAll')->name('clasificacionAdministrativos');
        Route::get('/','ClasificacionAdministrativoController@index');
        Route::get('/{id}','ClasificacionAdministrativoController@show');
        Route::put('/{id}','ClasificacionAdministrativoController@update');
    });

    Route::group(['prefix' => 'registroNominas'], function(){
        Route::get('/verificar/{codigo}','RegistroNominaController@validarCodigo')->name('registroNominas');        
        Route::get('/','RegistroNominaController@index');
        Route::post('','RegistroNominaController@store'); 
        Route::get('/{id}','RegistroNominaController@show');
        Route::put('/{id}','RegistroNominaController@update');
    });

    Route::group(['prefix' => 'clasificacionAdministrativos'], function(){
        Route::get('/','ClasificacionAdministrativoController@index');
        Route::get('/{id}','ClasificacionAdministrativoController@show');
        Route::put('/{id}','ClasificacionAdministrativoController@update');
    });

    Route::group(['prefix' => 'empleados'], function(){
        Route::get('/','EmpleadoController@index')->name('empleados');
        Route::post('','EmpleadoController@store');
        Route::get('/{id}','EmpleadoController@show');
        Route::put('/{id}','EmpleadoController@update');
        Route::delete('/{id}','EmpleadoController@destroy');
    });

    Route::group(['prefix' => 'prestaciones'], function(){
           Route::get('/','ReciboPrestacionesController@index');
           Route::get('/{id}','PrestacionesController@create');
    //     Route::get('/calcular/{recibo_prestaciones_sociales_id}','PrestacionesSocialesController@create');
           Route::post('','PrestacionesController@store');
    //     Route::get('/{id}','PrestacionesSocialesController@show');
    //       Route::put('/{id}','PrestacionesController@update');
    //     Route::delete('/{id}','PrestacionesSocialesController@destroy');
     });

    Route::group(['prefix' => 'recibos'], function(){
        Route::get('/verificar/{mes}/{anio}','ReciboController@validarRecibo')->name('recibos');
        Route::get('/','ReciboController@index');
        Route::get('/crear','ReciboController@create');
        Route::get('/{id}','ReciboController@update');
        Route::post('/','ReciboController@store');
    });

    Route::group(['prefix' => 'recibosEmpleados'], function(){
        Route::get('/verificar/{mes}/{anio}','ReciboEmpleadoController@validarRecibo')->name('recibosEmpleados');
        Route::get('/crear','ReciboEmpleadoController@create');
        Route::get('/{id}','ReciboEmpleadoController@update');
        Route::get('/recibo/segunda/{recibo_id}','ReciboEmpleadoController@indexSegunda');
        Route::get('/recibo/{recibo_id}','ReciboEmpleadoController@index');
        Route::post('/','ReciboEmpleadoController@store');
    });

     Route::group(['prefix' => 'recibosPrestaciones'], function(){
        Route::get('listar/{recibo_id}','ReciboPrestacionesController@listarPrestaciones')->name('recibosPrestaciones');
        Route::get('/crear','ReciboPrestacionesController@create');
        Route::get('/{id}','ReciboPrestacionesController@show');
    //  Route::get('/{id}','ReciboPrestacionesSocialesContoller@update');
        Route::post('/','ReciboPrestacionesController@store');
     });

     Route::group(['prefix' => 'recibosNomina'], function(){
        Route::get('/editar/{id}','ReciboNominaController@update')->name('recibosNomina');
        Route::get('/','ReciboNominaController@index');
        Route::get('/{id}','ReciboNominaController@show');
     });

    Route::group(['prefix' => 'recordatorios'], function(){
        Route::get('/','RecordatoriosController@index')->name('recordatorios');
        Route::post('/','RecordatoriosController@store');
        Route::get('/{id}','RecordatoriosController@show');
        Route::put('/{id}','RecordatoriosController@update');
        Route::delete('/{id}','RecordatoriosController@destroy');
    });

    Route::group(['prefix' => 'gestionNomina'], function(){
        Route::get('/manual/{recibo_id}','RegistroNominaReciboEmpleadoController@createManual')->name('gestionNomina');
        Route::get('/calcular/{recibo_id}','RegistroNominaReciboEmpleadoController@create');
        Route::get('/{recibo_id}/{empleado_id}','RegistroNominaReciboEmpleadoController@findRegistro');
        Route::post('primeraQuincena','RegistroNominaReciboEmpleadoController@primeraQuincena');
        Route::post('segundaQuincena','RegistroNominaReciboEmpleadoController@segundaQuincena');
        Route::post('registro','RegistroNominaReciboEmpleadoController@storeManual');
        Route::get('{recibo_id}','RegistroNominaReciboEmpleadoController@index');
        Route::post('/','RegistroNominaReciboEmpleadoController@store');
        Route::get('/{id}','RegistroNominaReciboEmpleadoController@show');
        Route::put('/{id}','RegistroNominaReciboEmpleadoController@update');
        Route::delete('/{id}','RegistroNominaReciboEmpleadoController@destroy');
    });

    Route::group(['prefix' => 'variablesGlobales'], function(){
        Route::get('/','VariablesGlobalesController@index')->name('variablesGlobales');
        Route::get('/{id}','VariablesGlobalesController@show');
        Route::put('/{id}','VariablesGlobalesController@update');
    });

    Route::group(['prefix' => 'usuarios'], function() {
        Route::get('/', 'UserController@index')->name('usuarios');
        Route::post('', 'UserController@store');
        Route::get('/{id}', 'UserController@show');
        Route::put('/{id}', 'UserController@update');
        Route::delete('/{id}', 'UserController@destroy');
    });

    Route::group(['prefix' => 'exportar'], function() {
        Route::get('/{id}', 'ExportController@exportar')->name('exportar');
        Route::get('/cestatickets/{id}', 'ExportController@exportarCestatickets');
        Route::get('/nomina/{id}', 'ExportController@exportarNomina');
        // Individuales
        Route::get('/reciboEmpleado/{id}', 'ExportController@exportarReciboEmpleado');
        Route::get('/reciboPrestacionesEmpleado/{id}', 'ExportController@exportarReciboPrestacionesEmpleado');
        // Archivos de Banco
        Route::get('/archivoBanco/primeraQuincena/{id}', 'ExportController@exportarArchivoDeBancoPrimeraQuincena');
        Route::get('/archivoBanco/segundaQuincena/{id}', 'ExportController@exportarArchivoDeBancoSegundaQuincena');
        Route::get('/archivoBanco/prestaciones/{id}', 'ExportController@exportarArchivoDeBancoPrestaciones');
        Route::get('/archivoBanco/cestatickets/{id}', 'ExportController@exportarArchivoDeBancoCestatickets');
        // Errores
        Route::get('/cestatickets', 'ExportController@errorToExport');
        Route::get('/nomina', 'ExportController@errorToExport');
    });
});