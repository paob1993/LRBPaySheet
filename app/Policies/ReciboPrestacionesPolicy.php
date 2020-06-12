<?php

namespace App\Policies;

use App\User;
use App\Models\ReciboPrestacionesSociales;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReciboPrestacionesPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isAdministradorDelSistema()) {
                return true;
            }
        }


    public function index(User $user) {
        return $user->isNomina();
    }             

    /**
     * Determine whether the user can view the reciboPrestacionesSociales.
     *
     * @param  \App\User  $user
     * @param  \App\ReciboPrestacionesSociales  $reciboPrestacionesSociales
     * @return mixed
     */
    public function view(User $user) {
       return $user->isNomina();
    }

    /**
     * Determine whether the user can create reciboPrestacionesSociales.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->isNomina();
    }

    /**
     * Determine whether the user can update the reciboPrestacionesSociales.
     *
     * @param  \App\User  $user
     * @param  \App\ReciboPrestacionesSociales  $reciboPrestacionesSociales
     * @return mixed
     */
    public function update(User $user, ReciboPrestacionesSociales $reciboPrestacionesSociales) {
        return $user->isNomina();
    }

    /**
     * Determine whether the user can delete the reciboPrestacionesSociales.
     *
     * @param  \App\User  $user
     * @param  \App\ReciboPrestacionesSociales  $reciboPrestacionesSociales
     * @return mixed
     */
    public function delete(User $user, ReciboPrestacionesSociales $reciboPrestacionesSociales) {
        return $user->isNomina();
    }
}
