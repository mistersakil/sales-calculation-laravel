<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;
use Illuminate\Http\Request;
class LinkServiceProvider extends ServiceProvider{

    public function boot(){
        
        ViewFacade::composer('backend.layout.left_col', function (View $view) {
            $view->with(['current_page' => request()->segment(2)]);
        });
        ViewFacade::composer('*', function (View $view) {
            $defaults_for_all_view = [
            ## Login Link
            'users_login'                    => route("users.login"),            
            'users_logout'                   => route("users.logout"),            

            ## Dashboard Link
            'dashboard'                      => route("admin.dashboard"),            
            'po_summary'                     => route("admin.dashboard.po_summary"),            
            'revenue_collection_group_chart' => route("admin.dashboard.revenue_collection_summery_chart_ajax"),            
            'dashboard_summary1'             => route("admin.dashboard.summary1"),            
            'client_bin_chart_link'          => route("admin.dashboard.client_bin_chart"),            
            'dashboard_service_charge'       => route("admin.dashboard.service_charge"),            
            'dashboard_summary2'             => route("admin.dashboard.summary2"),            
           
            ## Project Links
            'projects_list_link'             => route("admin.projects.index"),
            'projects_list_ajax_link'        => route("admin.projects.all_by_ajax"),
            'projects_create_link'           => route("admin.projects.create"),
            'projects_store_link'            => route("admin.projects.store"),
            'projects_delete_link'           => route("admin.projects.delete"),
            'projects_destroy_link'          => route("admin.projects.destroy"),
            'projects_edit_link'             => route("admin.projects.edit"),
            'projects_update_link'           => route("admin.projects.update"),
            'projects_get_amount_link'       => route("admin.projects.get_amount"),
            'projects_po_details_link'       => url("admin/projects/po_details"),         
            'projects_po_details_ajax_link'  => route("admin.projects.po_details_ajax"),            

            ## Client Links
            'clients_list_link'              => route("admin.clients.index"),
            'clients_list_ajax_link'         => route("admin.clients.all_by_ajax"),
            'clients_create_link'            => route("admin.clients.create"),
            'clients_store_link'             => route("admin.clients.store"),
            'clients_edit_link'              => route("admin.clients.edit"),
            'clients_update_link'            => route("admin.clients.update"),
            'clients_delete_link'            => route("admin.clients.delete"),
            'clients_destroy_link'           => route("admin.clients.destroy"),
            'clients_show_link'              => route("admin.clients.show"),
                 
            ## Employee Links
            'employees_list_link'            => route("admin.employees.index"),
            'employees_list_ajax_link'       => route("admin.employees.all_by_ajax"),

            ## User Links
            'users_list_link'                => route("admin.users.index"),
            'users_list_ajax_link'           => route("admin.users.all_by_ajax"),
            'users_create_link'              => route("admin.users.create"),
            'users_store_link'               => route("admin.users.store"),
            'users_edit_link'                => route("admin.users.edit"),
            'users_update_link'              => route("admin.users.update"),
            'users_delete_link'              => route("admin.users.delete"),
            'users_destroy_link'             => route("admin.users.destroy"),

            ## Role Links
            'roles_list_link'                => route("admin.roles.index"),
            'roles_list_ajax_link'           => route("admin.roles.all_by_ajax"),
            'roles_create_link'              => route("admin.roles.create"),
            'roles_store_link'               => route("admin.roles.store"),
            'roles_edit_link'                => route("admin.roles.edit"),
            'roles_update_link'              => route("admin.roles.update"),
            'roles_delete_link'              => route("admin.roles.delete"),
            'roles_destroy_link'             => route("admin.roles.destroy"),

            ## Collection Links
            'collections_list_link'          => route("admin.collections.index"),
            'collections_list_ajax_link'     => route("admin.collections.all_by_ajax"),
            'collections_create_link'        => route("admin.collections.create"),
            'collections_store_link'         => route("admin.collections.store"),
            'collections_edit_link'          => route("admin.collections.edit"),
            'collections_update_link'        => route("admin.collections.update"),
            'collections_delete_link'        => route("admin.collections.delete"),
            'collections_destroy_link'       => route("admin.collections.destroy"),
            'collections_pending_link'       => route("admin.collections.pending"),
            'collections_collect_link'       => route("admin.collections.collect"),

            ## Service charges Links
            'service_charges_list_link'      => route("admin.service_charges.index"),
            'service_charges_list_ajax_link' => route("admin.service_charges.all_by_ajax"),
            'service_charges_current_link'   => route("admin.service_charges.currnt_month"),
            'service_charges_current_ajax'   => route("admin.service_charges.currnt_month_ajax"),
            'service_charges_create_link'    => route("admin.service_charges.create"),
            'service_charges_store_link'     => route("admin.service_charges.store"),
            'service_charges_edit_link'      => route("admin.service_charges.edit"),
            'service_charges_update_link'    => route("admin.service_charges.update"),
            'service_charges_delete_link'    => route("admin.service_charges.delete"),
            'service_charges_destroy_link'   => route("admin.service_charges.destroy"),
            'service_charges_receive_link'   => route("admin.service_charges.receive"),
            'service_charges_pending_link'   => route("admin.service_charges.pending"),
            'service_charges_pending_single' => route("admin.service_charges.pending_single"),

            ## Collection Links
            'expenses_list_link'             => route("admin.expenses.index"),
            'expenses_list_ajax_link'        => route("admin.expenses.all_by_ajax"),
            'expenses_create_link'           => route("admin.expenses.create"),
            'expenses_store_link'            => route("admin.expenses.store"),
            'expenses_edit_link'             => route("admin.expenses.edit"),
            'expenses_update_link'           => route("admin.expenses.update"),
            'expenses_delete_link'           => route("admin.expenses.delete"),
            'expenses_destroy_link'          => route("admin.expenses.destroy"),
            
            ## Account Balance Links
            'account_balances_link'          => route("admin.account_balances.index"),

            ## Permissions Links
            'permissions_list_link'          => route("admin.permissions.index"),
            'permissions_list_ajax_link'     => route("admin.permissions.all_by_ajax"),
            'permissions_generate_link'      => route("admin.permissions.generate"),
            'permissions_generating_link'    => route("admin.permissions.generating"),
            'permissions_create_link'        => route("admin.permissions.create"),
            'permissions_store_link'         => route("admin.permissions.store"),
            'permissions_edit_link'          => route("admin.permissions.edit"),
            'permissions_update_link'        => route("admin.permissions.update"),
            'permissions_delete_link'        => route("admin.permissions.delete"),
            'permissions_destroy_link'       => route("admin.permissions.destroy"),
            
            ## Permission Type Links
            'permission_types_list_link'     => route("admin.permission_types.index"),
            'permission_types_list_ajax_link'=> route("admin.permission_types.all_by_ajax"),
            'permission_types_delete_link'   => route("admin.permission_types.delete"),
            'permission_types_destroy_link'  => route("admin.permission_types.destroy"),            
            
            ## Product Links
            'products_list_link'          => route("admin.products.index"),
            'products_list_ajax_link'     => route("admin.products.all_by_ajax"),   
            'products_create_link'        => route("admin.products.create"),
            'products_store_link'         => route("admin.products.store"),
            'products_edit_link'          => route("admin.products.edit"),
            'products_update_link'        => route("admin.products.update"),
            'products_delete_link'        => route("admin.products.delete"),
            'products_destroy_link'       => route("admin.products.destroy"),


            ## Variables
            'taka'                           => 'ট',

            
            ];
            $view->with($defaults_for_all_view);
        });

    }
}
