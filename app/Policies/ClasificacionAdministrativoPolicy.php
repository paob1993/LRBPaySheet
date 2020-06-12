<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClasificacionAdministrativoPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isAdministradorDelSistema()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view all the administrative classification.
     *
     * @param  \App\User  $user
     * @return boolean
    */
    public function index(User $user){
        return $user->isDirectivo() || $user->isNomina();
    }

    /**
     * Determine whether the user can view the administrative classification.
     *
     * @param  \App\User  $user
     * @return boolean
    */
    public function view(User $user){
        return $user->isDirectivo() || $user->isNomina();
    }

    /**
     * Determine whether the user can update the administrative classification.
     *
     * @param  \App\User  $user
     * @return boolean
    */
    public function update(User $user){
        return $user->isNomina();
    }
    
}
