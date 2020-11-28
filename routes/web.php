<?php
use Illuminate\Http\Request;

Route::get('admin/lang/{locale}','LocalizationController@index')->name('local');
Route::get('hash',function(){
	return bcrypt('sales2019');
});

/* Frontend routes */

Route::namespace('Users')->name('users.')->group(function(){

	Route::get('/', 'LoginController@show_login_form')->name('show_login_form');
	Route::post('/login', 'LoginController@login')->name('login');
	Route::get('/logout', 'LoginController@logout')->name('logout');

});

/* Backend routes */
Route::namespace('Backend')->middleware('localization','authenticated')->name('admin.')->prefix('admin')->group(function(){

	## Dashboard routes
	Route::get('/', 'DashboardController@index')->name('dashboard');
	Route::get('/dashboard/po_summary', 'DashboardController@vms_po_summary')->name('dashboard.po_summary');
	Route::get('/dashboard/summary1', 'DashboardController@vms_revenue_summary')->name('dashboard.summary1')->middleware('IsAjaxRequest');
	Route::get('/dashboard/revenue_collection_summery_chart_ajax', 'DashboardController@revenue_collection_chart')->name('dashboard.revenue_collection_summery_chart_ajax')->middleware('IsAjaxRequest');
	Route::get('/dashboard/client_bin_chart', 'DashboardController@client_chart')->name('dashboard.client_bin_chart')->middleware('IsAjaxRequest');
	Route::get('/dashboard/service_charge', 'DashboardController@service_charge')->name('dashboard.service_charge');
	Route::get('/dashboard/summary2', 'DashboardController@accumulated_revenue')->name('dashboard.summary2')->middleware('IsAjaxRequest');

	## Product routes
	Route::get('products/all_by_ajax','ProductsController@all_by_ajax')->name('products.all_by_ajax')->middleware('IsAjaxRequest');
	Route::get('products','ProductsController@index')->name('products.index');
	Route::get('products/create','ProductsController@create')->name('products.create')->middleware('IsAjaxRequest');
	Route::post('products/create','ProductsController@store')->name('products.store')->middleware('IsAjaxRequest');
	Route::get('products/edit','ProductsController@edit')->name('products.edit')->middleware('IsAjaxRequest');
	Route::post('products/edit','ProductsController@update')->name('products.update')->middleware('IsAjaxRequest');
	Route::get('products/delete','ProductsController@delete')->name('products.delete')->middleware('IsAjaxRequest');
	Route::post('products/delete','ProductsController@destroy')->name('products.destroy')->middleware('IsAjaxRequest');
	
	## Category routes
	Route::get('category/all','CategoryController@all')->name('category.all');	
	Route::resource('category','CategoryController');
	
	## Projects routes
	Route::get('projects/all_by_ajax','ProjectsController@all_by_ajax')->name('projects.all_by_ajax');
	Route::get('projects','ProjectsController@index')->name('projects.index');
	Route::get('projects/create','ProjectsController@create')->name('projects.create')->middleware('IsAjaxRequest');
	Route::post('projects/create','ProjectsController@store')->name('projects.store');
	Route::post('projects/delete','ProjectsController@delete')->name('projects.delete');
	Route::post('projects/destroy','ProjectsController@destroy')->name('projects.destroy');
	Route::get('projects/edit','ProjectsController@edit')->name('projects.edit');
	Route::post('projects/update','ProjectsController@update')->name('projects.update');
	Route::post('projects/get_amount','ProjectsController@get_amount')->name('projects.get_amount');
	Route::get('projects/po_details/{date_start?}/{date_end?}','ProjectsController@po_details')->name('projects.po_details');
	Route::get('projects/po_details_ajax','ProjectsController@po_details_ajax')->name('projects.po_details_ajax');
	
	## Clients routes
	Route::get('clients/all_by_ajax','ClientsController@all_by_ajax')->name('clients.all_by_ajax')->middleware('IsAjaxRequest');
	Route::get('clients','ClientsController@index')->name('clients.index');
	Route::get('clients/create','ClientsController@create')->name('clients.create')->middleware('IsAjaxRequest');
	Route::post('clients/create','ClientsController@store')->name('clients.store')->middleware('IsAjaxRequest');
	Route::get('clients/edit','ClientsController@edit')->name('clients.edit')->middleware('IsAjaxRequest');
	Route::post('clients/update','ClientsController@update')->name('clients.update')->middleware('IsAjaxRequest');
	Route::get('clients/delete','ClientsController@delete')->name('clients.delete')->middleware('IsAjaxRequest');
	Route::post('clients/destroy','ClientsController@destroy')->name('clients.destroy')->middleware('IsAjaxRequest');
	Route::get('clients/show','ClientsController@show')->name('clients.show');
	
	## Employee routes
	Route::get('employees/all_by_ajax','EmployeesController@all_by_ajax')->name('employees.all_by_ajax');
	Route::get('employees','EmployeesController@index')->name('employees.index');
	Route::get('employees/create','EmployeesController@create')->name('employees.create')->middleware('IsAjaxRequest');
	Route::post('employees/create','EmployeesController@store')->name('employees.store');


	## Admin-user routes
	Route::get('users/all_by_ajax','UsersController@all_by_ajax')->name('users.all_by_ajax')->middleware('IsAjaxRequest');
	Route::get('users','UsersController@index')->name('users.index');
	Route::get('users/create','UsersController@create')->name('users.create')->middleware('IsAjaxRequest');
	Route::post('users/create','UsersController@store')->name('users.store')->middleware('IsAjaxRequest');
	Route::get('users/edit','UsersController@edit')->name('users.edit')->middleware('IsAjaxRequest');
	Route::post('users/edit','UsersController@update')->name('users.update')->middleware('IsAjaxRequest');
	Route::get('users/delete','UsersController@delete')->name('users.delete')->middleware('IsAjaxRequest');
	Route::post('users/delete','UsersController@destroy')->name('users.destroy')->middleware('IsAjaxRequest');

	## Role routes
	Route::get('roles/all_by_ajax','RolesController@all_by_ajax')->name('roles.all_by_ajax')->middleware('IsAjaxRequest');
	Route::get('roles','RolesController@index')->name('roles.index');
	Route::get('roles/create','RolesController@create')->name('roles.create')->middleware('IsAjaxRequest');
	Route::post('roles/create','RolesController@store')->name('roles.store')->middleware('IsAjaxRequest');
	Route::get('roles/edit','RolesController@edit')->name('roles.edit')->middleware('IsAjaxRequest');
	Route::post('roles/edit','RolesController@update')->name('roles.update')->middleware('IsAjaxRequest');
	Route::get('roles/delete','RolesController@delete')->name('roles.delete')->middleware('IsAjaxRequest');
	Route::post('roles/delete','RolesController@destroy')->name('roles.destroy')->middleware('IsAjaxRequest');
	
	
	## collections routes
	Route::get('collections/all_by_ajax','CollectionsController@all_by_ajax')->name('collections.all_by_ajax');
	Route::get('collections','CollectionsController@index')->name('collections.index');
	Route::get('collections/create','CollectionsController@create')->name('collections.create')->middleware('IsAjaxRequest');
	Route::post('collections/create','CollectionsController@store')->name('collections.store')->middleware('IsAjaxRequest');
	Route::get('collections/edit','CollectionsController@edit')->name('collections.edit')->middleware('IsAjaxRequest');
	Route::post('collections/edit','CollectionsController@update')->name('collections.update')->middleware('IsAjaxRequest');
	Route::get('collections/delete','CollectionsController@delete')->name('collections.delete')->middleware('IsAjaxRequest');
	Route::post('collections/delete','CollectionsController@destroy')->name('collections.destroy')->middleware('IsAjaxRequest');
	Route::get('collections/pending','CollectionsController@pending')->name('collections.pending');
	Route::get('collections/collect','CollectionsController@collect')->name('collections.collect');

	## Service charges routes
	Route::get('service_charges/all_by_ajax','ServiceChargesController@all_by_ajax')->name('service_charges.all_by_ajax')->middleware('IsAjaxRequest');
	Route::get('service_charges','ServiceChargesController@index')->name('service_charges.index');
	Route::get('service_charges/current','ServiceChargesController@currnt_month')->name('service_charges.currnt_month');
	Route::get('service_charges/currnt_month_ajax','ServiceChargesController@currnt_month_ajax')->name('service_charges.currnt_month_ajax')->middleware('IsAjaxRequest');	
	Route::get('service_charges/create','ServiceChargesController@create')->name('service_charges.create')->middleware('IsAjaxRequest');
	Route::post('service_charges/create','ServiceChargesController@store')->name('service_charges.store')->middleware('IsAjaxRequest');
	Route::get('service_charges/edit','ServiceChargesController@edit')->name('service_charges.edit')->middleware('IsAjaxRequest');
	Route::post('service_charges/edit','ServiceChargesController@update')->name('service_charges.update')->middleware('IsAjaxRequest');
	Route::get('service_charges/delete','ServiceChargesController@delete')->name('service_charges.delete')->middleware('IsAjaxRequest');
	Route::post('service_charges/delete','ServiceChargesController@destroy')->name('service_charges.destroy')->middleware('IsAjaxRequest');
	Route::get('service_charges/receive','ServiceChargesController@receive')->name('service_charges.receive');
	Route::get('service_charges/pending','ServiceChargesController@pending')->name('service_charges.pending');
	Route::get('service_charges/pending_single','ServiceChargesController@pending_single')->name('service_charges.pending_single');

	## Expense routes
	Route::get('expenses/all_by_ajax','ExpensesController@all_by_ajax')->name('expenses.all_by_ajax');
	Route::get('expenses','ExpensesController@index')->name('expenses.index');
	Route::get('expenses/create','ExpensesController@create')->name('expenses.create')->middleware('IsAjaxRequest');
	Route::post('expenses/create','ExpensesController@store')->name('expenses.store')->middleware('IsAjaxRequest');
	Route::get('expenses/edit','ExpensesController@edit')->name('expenses.edit')->middleware('IsAjaxRequest');
	Route::post('expenses/edit','ExpensesController@update')->name('expenses.update');
	Route::get('expenses/delete','ExpensesController@delete')->name('expenses.delete')->middleware('IsAjaxRequest');
	Route::post('expenses/delete','ExpensesController@destroy')->name('expenses.destroy')->middleware('IsAjaxRequest');

	## Account Balance routes
	Route::get('account_balances','AccountBalancesController@index')->name('account_balances.index');	

	## Permissions routes
	Route::get('permissions/all_by_ajax','PermissionsController@all_by_ajax')->name('permissions.all_by_ajax')->middleware('IsAjaxRequest');
	Route::get('permissions','PermissionsController@index')->name('permissions.index');
	Route::get('permissions/generate','PermissionsController@generate')->name('permissions.generate')->middleware('IsAjaxRequest');
	Route::post('permissions/generate','PermissionsController@generating')->name('permissions.generating')->middleware('IsAjaxRequest');
	Route::get('permissions/create','PermissionsController@create')->name('permissions.create')->middleware('IsAjaxRequest');
	Route::post('permissions/create','PermissionsController@store')->name('permissions.store')->middleware('IsAjaxRequest');
	Route::get('permissions/edit','PermissionsController@edit')->name('permissions.edit')->middleware('IsAjaxRequest');
	Route::post('permissions/edit','PermissionsController@update')->name('permissions.update')->middleware('IsAjaxRequest');
	Route::get('permissions/delete','PermissionsController@delete')->name('permissions.delete')->middleware('IsAjaxRequest');
	Route::post('permissions/delete','PermissionsController@destroy')->name('permissions.destroy')->middleware('IsAjaxRequest');	

	## Permissions routes
	Route::get('permission_types/all_by_ajax','PermissionTypesController@all_by_ajax')->name('permission_types.all_by_ajax')->middleware('IsAjaxRequest');
	Route::get('permission_types','PermissionTypesController@index')->name('permission_types.index');
	Route::get('permission_types/delete','PermissionTypesController@delete')->name('permission_types.delete')->middleware('IsAjaxRequest');
	Route::post('permission_types/delete','PermissionTypesController@destroy')->name('permission_types.destroy')->middleware(['IsAjaxRequest']);
	
	## Error routes

	Route::get('/403',function(){
		return view('backend.403');
	})->name('403');

	## Checking Route List
	Route::get('test',function(Request $request){





		$month_start = (int) _custom_date_time('2018-10-01','m');
		$month_end = $month_start - 1;
		$year_start = (int) _custom_date_time('2018-10-01','Y');
		$year_start_cycle = 2;
		$year_start = $year_start + $year_start_cycle;
		$year_end = $year_start + 1;
		$month_list = [];
		for($month_start; $month_start <= 12; $month_start++){
			if(strlen($month_start) == 1) {
				$month_list[] = $year_start.'-0'.$month_start.'-01';
			}else{
				$month_list[] = $year_start.'-'.$month_start.'-01';
			}

			if( ($year_start == $year_end) && ($month_start == $month_end) ) {
				break;
			}
			if($month_start == 12) {
				$month_start = 0;
				$year_start++;
			}
		}
		$month_list[11] = _custom_date_time(end($month_list),'Y-m').'-31';
		// return in_array("2019-11-03", $month_list) ? 'already exist' : 'new insert';
		// return array_key_last($month_list);
		return ($month_list);

		return $month_list;
	});



});
