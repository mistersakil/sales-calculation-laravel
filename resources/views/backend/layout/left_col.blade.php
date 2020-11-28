<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title"
            style=" margin-bottom: 30px; display: block; border-bottom: 0px solid #eee; z-index: 999;">
            <a href="{{ route('admin.dashboard') }}" class="site_title" style="height: auto; text-align: center; background: #fff">
                <img src="{{ asset('public/image/logo.svg') }}" title="Logo" alt="Logo">
            </a>
            <div class="clearfix"></div>
        </div>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li class="@if(isset($current_page) && $current_page == 'projects'){{ 'current-page' }}@endif">
                        <a class="text-uppercase" href="{{ $dashboard }}"><i class="fa fa-dashboard  text-success"></i> @lang('common.DASHBOARD')</a>
                    </li>
                    <li>
                        <a><i class="fa fa-edit text-warning"></i> @lang('common.Post') @lang('common.Sale') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            @can('view_all', App\Model\Client::class)
                            <li
                                class="@if(isset($current_page) && $current_page == 'clients'){{ 'current-page' }}@endif">
                                <a class="text-uppercase" href="{{ $clients_list_link }}"> @lang('common.Clients')</a>
                            </li>
                            @endcan
                            @can('view_all', App\Model\Project::class)
                            <li
                                class="@if(isset($current_page) && $current_page == 'projects'){{ 'current-page' }}@endif">
                                <a class="text-uppercase" href="{{ $projects_list_link }}"> @lang('common.PROJECTS')</a>
                            </li>
                            @endcan
                            @can('currnt_month', App\Model\ServiceCharge::class)
                            <li
                                class="@if(isset($current_page) && $current_page == 'service_charges'){{ 'current-page' }}@endif">
                                <a class="text-uppercase" href="{{ $service_charges_current_link }}"> @lang('common.Service Charges')</a>
                            </li>
                            @endcan
                            @can('view_all', App\Model\Collection::class)
                            <li
                                class="@if(isset($current_page) && $current_page == 'collections'){{ 'current-page' }}@endif">
                                <a class="text-uppercase" href="{{ $collections_list_link }}"> @lang('common.Collections')</a>
                            </li>
                            @endcan
                            @can('view_all', App\Model\Expense::class)
                            <li
                                class="@if(isset($current_page) && $current_page == 'expenses'){{ 'current-page' }}@endif">
                                <a class="text-uppercase" href="{{ $expenses_list_link }}"> @lang('common.Expenses')</a>
                            </li>
                            @endcan
                            @can('view_all', App\Model\Product::class)
                            <li
                                class="@if(isset($current_page) && $current_page == 'products'){{ 'current-page' }}@endif">
                                <a class="text-uppercase" href="{{ $products_list_link }}"> @lang('common.Products')</a>
                            </li>
                            @endcan
                            {{-- <li
                                class="@if(isset($current_page) && $current_page == ''){{ 'current-page' }}@endif">
                                <a class="text-uppercase" href="{{ $employees_list_link }}"> @lang('common.Inventories')</a>
                            </li> --}}
                            {{-- <li
                                class="@if(isset($current_page) && $current_page == ''){{ 'current-page' }}@endif">
                                <a class="text-uppercase" href="{{ $employees_list_link }}"> @lang('common.Team Managements')</a>
                            </li> --}}
                            {{-- <li
                                class="@if(isset($current_page) && $current_page == ''){{ 'current-page' }}@endif">
                                <a class="text-uppercase" href="{{ $employees_list_link }}"> @lang('common.Website References')</a>
                            </li> --}}
                        </ul>
                    </li>
                    
                    <!-- Management menu item section -->
                    <li>
                        <a>
                            <i class="fa fa-bomb text-danger"></i>
                            @lang('common.Top') @lang('common.Management')
                            <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            @can('account_balance', App\Model\Expense::class)
                            <li
                                class="@if(isset($current_page) && $current_page == 'account_balances'){{ 'current-page' }}@endif">
                                <a class="text-uppercase" href="{{ $account_balances_link }}">  @lang('common.Account') @lang('common.Balance')</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    <!-- End: Management menu item section -->
                    <!-- User Menu Item Section -->
                    <li>
                        <a><i class="fa fa-users  text-primary"></i> @lang('common.user management') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            @can('view_all', App\Model\User::class)
                            <li
                                class="@if(isset($current_page) && $current_page == 'users'){{ 'current-page' }}@endif">
                                <a class="text-uppercase" href="{{ $users_list_link }}"> @lang('common.users')</a>
                            </li>
                            @endcan
                            @can('view_all', App\Model\Role::class)
                            <li
                                class="@if(isset($current_page) && $current_page == 'roles'){{ 'current-page' }}@endif">
                                <a class="text-uppercase" href="{{ $roles_list_link }}"> @lang('common.Roles')</a>
                            </li>
                            @endcan
                            @can('view_all', App\Model\Permission::class)
                            <li
                                class="@if(isset($current_page) && $current_page == 'permissions'){{ 'current-page' }}@endif">
                                <a class="text-uppercase" href="{{ $permissions_list_link }}"> @lang('common.Permissions')</a>
                            </li>
                            @endcan
                            @can('view_all', App\Model\PermissionType::class)
                            <li
                                class="@if(isset($current_page) && $current_page == 'permission_types'){{ 'current-page' }}@endif">
                                <a class="text-uppercase" href="{{ $permission_types_list_link }}"> @lang('common.Permission') @lang('common.For')</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    <!-- End: User Menu Item Section -->
                    
                    {{-- <li>
                        <a><i class="fa fa-wrench text-success"></i> @lang('common.general settings') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            
                        </ul>
                    </li> --}}
                    
                </ul>
            </div>
        </div>
        <!-- /.main_menu_side -->
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <p class="text-center bg-warning">System Launched at 26 Sep, 2019</p>
            <a href="{{ route('admin.dashboard') }}" data-toggle="tooltip" data-placement="top" title="Dashboard">
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ $users_logout }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /.sidebar-footer -->
    </div>
</div>