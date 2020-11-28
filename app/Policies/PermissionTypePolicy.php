<?php

namespace App\Policies;

use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionTypePolicy
{
    use HandlesAuthorization;
    
    ## View Single Acion
    public function view(User $user)
    {
        
    }
    ## Check permission Acion
    protected function check_permisssion($user, $permission){
        if($user->user_permission('permission_types', $permission)){
            return true;
        }
        return false;
    }

    ## View All Acion
    public function view_all(User $user)
    {
        return $this->check_permisssion($user, 'index');
    }

    ## Delete Acion
    public function delete(User $user)
    {
        return $this->check_permisssion($user, 'delete');
    }

}
