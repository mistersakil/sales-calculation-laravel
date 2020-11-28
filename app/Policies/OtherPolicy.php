<?php

namespace App\Policies;

use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OtherPolicy
{
    use HandlesAuthorization;

    ## Check permission Acion
    public function account_balance(User $user){
        if($user->user_permission('account_balances', 'index')){
            return true;
        }
        return false;
    }

    ## Check permission Acion
    public function project_overview(User $user){
        if($user->user_permission('dashboard', 'index')){
            return true;
        }
        return false;
    }

    ## accumulated_revenue
    public function accumulated_revenue(User $user){
        if($user->user_permission('dashboard', 'accumulated_revenue')){
            return true;
        }
        return false;
    }

    ## vms_revenue_summary
    public function vms_revenue_summary(User $user){
        if($user->user_permission('dashboard', 'vms_revenue_summary')){
            return true;
        }
        return false;
    }
    
    ## vms_revenue_summary
    public function vms_po_summary(User $user){
        if($user->user_permission('dashboard', 'vms_po_summary')){
            return true;
        }
        return false;
    }

    ## service_charge
    public function service_charge(User $user){
        if($user->user_permission('dashboard', 'service_charge')){
            return true;
        }
        return false;
    }

    ## service_charge
    public function client_chart(User $user){
        if($user->user_permission('dashboard', 'client_chart')){
            return true;
        }
        return false;
    }
}
