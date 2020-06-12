<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegistroNominaPolicy {
    use HandlesAuthorization;
    
        public function before(User $user) {
            if ($user->isAdministradorDelSistema()) {
                return true;
            }
        }
    
        /**
         * Determine whether the user can view the registro nómina.
         *
         * @param  \App\User  $user
         * @return mixed
        */ 
        public function index(User $user){
            return  $user->isNomina();
        }
    
    
        /**
         * Determine whether the user can view the registro nómina.
         *
         * @param  \App\User  $user
         * @return mixed
        */
        public function view(User $user){
            return $user->isNomina();
        }
    
        /**
         * Determine whether the user can create registro nómina.
         *
         * @param  \App\User  $user
         * @return mixed
        */
        public function create(User $user){
            return  $user->isNomina();
        }
    
        /**
         * Determine whether the user can update the registro nómina.
         *
         * @param  \App\User  $user
         * @return mixed
        */
        public function update(User $user){
            return  $user->isNomina();
        }
    
        /**
         * Determine whether the user can delete the registro nómina.
         *
         * @param  \App\User  $user
         * @return mixed
         */
        public function delete(User $user){
            return  $user->isNomina();
        }
}
