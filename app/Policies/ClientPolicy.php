<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Client;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;
    
    ## View Single Acion
    public function view(User $user)
    {
        
    }

    ## View All Acion
    public function view_all(User $user)
    {
        if($user->user_permission('clients', 'index')){
            return true;
        }
        return false;
    }


    ## Create Acion
    public function create(User $user)
    {
        if($user->user_permission('clients', 'create')){
            return true;
        }
        return false;
    }


    ## Edit Acion
    public function edit(User $user)
    {
        if($user->user_permission('clients', 'edit')){
            return true;
        }
        return false;
    }


    ## Delete Acion
    public function delete(User $user)
    {
        if($user->user_permission('clients', 'delete')){
            return true;
        }
        return false;
    }

}
