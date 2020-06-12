<?php

namespace App\Policies;

use App\User;
use App\Models\ReciboEmpleado;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReciboEmpleadoPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isAdministradorDelSistema()) {
                return true;
            }
        }

    /**
     * Determine whether the user can view all the recibo.
     *
     * @param  \App\User  $user
     * @return boolean
    */
    public function index(User $user){
        return $user->isNomina();
    }        

    /**
     * Determine whether the user can view the recibo.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Recibo  $recibo
     * @return mixed
     */
    public function view(User $user, ReciboEmpleado $recibo) {
        return $user->isNomina() || $user->id === $recibo->empleado->user->id;
    }

    /**
     * Determine whether the user can create recibos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user) {
        return  $user->isNomina();
    }

    /**
     * Determine whether the user can update the recibo.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Recibo  $recibo
     * @return mixed
     */
    public function update(User $user) {
        return  $user->isNomina();
    }

    /**
     * Determine whether the user can delete the recibo.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Recibo  $recibo
     * @return mixed
     */
    public function delete(User $user) {
        return  $user->isNomina();
    }
}
