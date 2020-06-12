<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CargoPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isAdministradorDelSistema()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view all the charges.
     *
     * @param  \App\User  $user
     * @return boolean
    */
    public function index(User $user){
        return $user->isDirectivo() || $user->isNomina();
    }

    /**
     * Determine whether the user can view the charges.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return boolean
    */
    public function view(User $user, User $user2){
        return $user->isDirectivo() || $user->isNomina() || $user->isEstructuraDeCostos() || $user->id == $user2->id;
    }

    /**
     * Determine whether the user can create charges.
     *
     * @param  \App\User  $user
     * @return boolean
    */
    public function create(User $user){
        return $user->isNomina();
    }

    /**
     * Determine whether the user can update the charges.
     *
     * @param  \App\User  $user
     * @return boolean
    */
    public function update(User $user){
        return $user->isNomina();
    }

    /**
     * Determine whether the user can delete the charges.
     *
     * @param  \App\User  $user
     * @return boolean
    */
    public function delete(User $user){
        return $user->isNomina();
    }
    
}
