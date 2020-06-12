<?php

namespace App\Policies;

use App\User;
use App\Models\PrestacionesSociales;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrestacionesPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isAdministradorDelSistema()) {
                return true;
            }
        }    

    /**
     * Determine whether the user can view the prestacionesSociales.
     *
     * @param  \App\User  $user
     * @param  \App\PrestacionesSociales  $prestacionesSociales
     * @return mixed
     */
    public function view(User $user) {
       return $user->isNomina();
    }

    /**
     * Determine whether the user can create prestacionesSociales.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->isNomina();
    }

    /**
     * Determine whether the user can update the prestacionesSociales.
     *
     * @param  \App\User  $user
     * @param  \App\PrestacionesSociales  $prestacionesSociales
     * @return mixed
     */
    public function update(User $user, PrestacionesSociales $prestacionesSociales) {
        return $user->isNomina();
    }

    /**
     * Determine whether the user can delete the prestacionesSociales.
     *
     * @param  \App\User  $user
     * @param  \App\PrestacionesSociales  $prestacionesSociales
     * @return mixed
     */
    public function delete(User $user, PrestacionesSociales $prestacionesSociales) {
        return $user->isNomina();
    }
}
