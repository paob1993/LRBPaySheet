<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CodigoNominaPolicy
{
    use HandlesAuthorization;
    
        public function before(User $user) {
            if ($user->isAdministradorDelSistema()) {
                return true;
            }
        }
    
        /**
         * Determine whether the user can view the codigoNomina exists.
         *
         * @param  \App\User  $user
         * @return mixed
        */ 
        public function index(User $user){
            return  $user->isNomina() || $user->isEstructuraDeCostos();
        }

        /**
         * Determine whether the user can view the codigoNomina exists.
         *
         * @param  \App\User  $user
         * @return mixed
        */ 
        public function viewIfExist(User $user){
            return  $user->isNomina();
        }
    
        

}
