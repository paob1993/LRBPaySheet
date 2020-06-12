<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model'                                 =>      'App\Policies\ModelPolicy',
        'App\User'                                  =>      'App\Policies\UserPolicy',

        'App\Models\Cargo'                          =>      'App\Policies\CargoPolicy',
        'App\Models\CategoriaDocente'               =>      'App\Policies\CategoriaDocentePolicy',
        'App\Models\ClasificacionAdministrativo'    =>      'App\Policies\ClasificacionAdministrativoPolicy',
        'App\Models\ClasificacionObrero'            =>      'App\Policies\ClasificacionObreroPolicy',
        'App\Models\CodigoNomina'                   =>      'App\Policies\CodigoNominaPolicy',
        'App\Models\Empleado'                       =>      'App\Policies\EmpleadoPolicy',
        'App\Models\Prima'                          =>      'App\Policies\PrimaPolicy',
        'App\Models\Recordatorios'                  =>      'App\Policies\RecordatorioPolicy',
        'App\Models\ReciboEmpleado'                 =>      'App\Policies\ReciboEmpleadoPolicy',
        'App\Models\RegistroNomina'                 =>      'App\Policies\RegistroNominaPolicy',
        'App\Models\RegistroNominaReciboEmpleado'   =>      'App\Policies\RegistroNominaReciboEmpleadoPolicy',
        'App\Models\VariablesGlobales'              =>      'App\Policies\VariablesGlobalesPolicy',
        'App\Models\Recibo'                         =>      'App\Policies\ReciboPolicy',
        'App\Models\Cestaticket'                    =>      'App\Policies\CestaticketPolicy',
        'App\Models\ReciboPrestacionesSociales'     =>      'App\Policies\ReciboPrestacionesPolicy',
        'App\Models\PrestacionesSociales'           =>      'App\Policies\PrestacionesPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
