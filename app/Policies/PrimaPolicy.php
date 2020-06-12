<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrimaPolicy {
    use HandlesAuthorization;
    
        public function before(User $user) {
            if ($user->isAdministradorDelSistema()) {
                return true;
            }
        }
    
        /**
         * Determine whether the user can view the registro prima.
         *
         * @param  \App\User  $user
         * @return mixed
        */ 
        public function index(User $user){
            return  $user->isNomina() || $user->isEstructuraDeCostos();
        }
    
    
        /**
         * Determine whether the user can view the registro prima.
         *
         * @param  \App\User  $user
         * @return mixed
        */
        public function view(User $user){
            return $user->isNomina() || $user->isEstructuraDeCostos();
        }
    
        /**
         * Determine whether the user can create registro prima.
         *
         * @param  \App\User  $user
         * @return mixed
        */
        public function create(User $user){
            return  $user->isNomina();
        }
    
        /**
         * Determine whether the user can update the registro prima.
         *
         * @param  \App\User  $user
         * @return mixed
        */
        public function update(User $user){

        }
    
        /**
         * Determine whether the user can delete the registro prima.
         *
         * @param  \App\User  $user
         * @return mixed
         */
        public function delete(User $user){
            return  $user->isNomina();
        }
}
