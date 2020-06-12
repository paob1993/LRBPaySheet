<?php

namespace App\Policies;

use App\User;
use App\Models\Cestaticket;
use Illuminate\Auth\Access\HandlesAuthorization;

class CestaticketPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isAdministradorDelSistema()) {
                return true;
            }
        }

    /**
     * Determine whether the user can view the cestaticket.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Cestaticket  $cestaticket
     * @return mixed
     */
    public function view(User $user) {
        return $user->isNomina();
    }


    /**
     * Determine whether the user can create cestatickets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user) {
        return  $user->isNomina();
    }

    /**
     * Determine whether the user can update the cestaticket.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Cestaticket  $cestaticket
     * @return mixed
     */
    public function update(User $user, Recibo $recibo) {
        return  $user->isNomina();
    }


    /**
     * Determine whether the user can delete the cestaticket.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Cestaticket  $cestaticket
     * @return mixed
     */
    public function delete(User $user, Recibo $recibo) {
        return  $user->isNomina();
    }
}
