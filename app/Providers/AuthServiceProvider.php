<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model\Client'              => 'App\Policies\ClientPolicy',
        'App\Model\Collection'          => 'App\Policies\CollectionPolicy',
        'App\Model\Expense'             => 'App\Policies\ExpensePolicy',
        'App\Model\Project'             => 'App\Policies\ProjectPolicy',
        'App\Model\Permission'          => 'App\Policies\PermissionPolicy',
        'App\Model\PermissionType'      => 'App\Policies\PermissionTypePolicy',
        'App\Model\Role'                => 'App\Policies\RolePolicy',
        'App\Model\ServiceCharge'       => 'App\Policies\ServiceChargePolicy',
        'App\Model\User'                => 'App\Policies\UserPolicy',
        'App\Model\Product'             => 'App\Policies\ProductPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('account_balance', 'App\Policies\OtherPolicy@account_balance');
        Gate::define('project_overview', 'App\Policies\OtherPolicy@project_overview');
        Gate::define('accumulated_revenue', 'App\Policies\OtherPolicy@accumulated_revenue');
        Gate::define('vms_revenue_summary', 'App\Policies\OtherPolicy@vms_revenue_summary');
        Gate::define('vms_po_summary', 'App\Policies\OtherPolicy@vms_po_summary');
        Gate::define('service_charge', 'App\Policies\OtherPolicy@service_charge');
        Gate::define('client_chart', 'App\Policies\OtherPolicy@client_chart');
    }
}
