<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmpleadoPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isAdministradorDelSistema()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view all the employees.
     *
     * @param  \App\User  $user
     * @return boolean
    */
    public function index(User $user){
        return $user->isDirectivo() || $user->isNomina();
    }

    /**
     * Determine whether the user can view the employees.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return boolean
    */
    public function view(User $user, User $user2){
        return $user->isDirectivo() || $user->isNomina() || $user->isEstructuraDeCostos() || $user->id == $user2->id;
    }

    /**
     * Determine whether the user can create employees.
     *
     * @param  \App\User  $user
     * @return boolean
    */
    public function create(User $user){
        return $user->isNomina();
    }

    /**
     * Determine whether the user can update the employees.
     *
     * @param  \App\User  $user
     * @return boolean
    */
    public function update(User $user){
        return $user->isNomina();
    }

    /**
     * Determine whether the user can delete the employees.
     *
     * @param  \App\User  $user
     * @return boolean
    */
    public function delete(User $user){
        return $user->isNomina();
    }
    
}
