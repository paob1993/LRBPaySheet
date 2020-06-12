<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VariablesGlobalesPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isAdministradorDelSistema()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view all the global variables.
     *
     * @param  \App\User  $user
     * @return boolean
    */
    public function index(User $user){
        return $user->isNomina() || $user->isEstructuraDeCostos();
    }

    /**
     * Determine whether the user can view the global variables.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return boolean
    */
    public function view(User $user, User $user2){
        return $user->isNomina() || $user->isEstructuraDeCostos();
    }

    /**
     * Determine whether the user can create global variables.
     *
     * @param  \App\User  $user
     * @return boolean
    */
    public function create(User $user){
        return $user->isNomina();
    }

    /**
     * Determine whether the user can update the global variables.
     *
     * @param  \App\User  $user
     * @return boolean
    */
    public function update(User $user){
        return $user->isNomina();
    }
    
}
