<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Datatables;
class Permission extends MyModel
{
    protected $table = 'permissions';
    protected $touches = ['permission_type','roles'];
    protected $fillable = ['name','permission_type_id','status'];

	## Get all by AJAX request ##

   	public static function all_by_ajax(){
	   	$query 	= self::with('permission_type','roles')->get();
	   	if( auth()->user()->can('edit', Permission::class)  && auth()->user()->can('delete', Permission::class) ){
	   	return 	Datatables::of($query)   
	   			->editColumn('name', function($model) {
	                return ucfirst($model->name);
	            })   
	   			->addColumn('roles_count', function($model) {
	                return $model->roles->count();
	            })   
	   			->addColumn('for', function($model) {
	                return ucfirst($model->permission_type->name);
	            })    
	            ->editColumn('created_at', function($model) {
	                return $model->created_at->diffForHumans();
	            })  
	            ->editColumn('updated_at', function($model) {
	                return $model->updated_at->diffForHumans();
	            })  
	            ->editColumn('status', function($model) {
	            	$result = $model->status 
	            			? '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
	            			: '<span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
	            	return $result;
	            })      	                 
	            ->addColumn('action',function($model){
	                $result   = '';
					$result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
					$result  .= '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';
					$result  .= '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-xs btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';

					return $result;

	            })
	            
	            ->rawColumns(['action','status'])
	            ->make(true);
		}elseif( auth()->user()->can('edit', Permission::class) ){
		   	return 	Datatables::of($query)   
	   			->editColumn('name', function($model) {
	                return ucfirst($model->name);
	            })   
	   			->addColumn('roles_count', function($model) {
	                return $model->roles->count();
	            })   
	   			->addColumn('for', function($model) {
	                return ucfirst($model->permission_type->name);
	            })    
	            ->editColumn('created_at', function($model) {
	                return $model->created_at->diffForHumans();
	            })  
	            ->editColumn('updated_at', function($model) {
	                return $model->updated_at->diffForHumans();
	            })  
	            ->editColumn('status', function($model) {
	            	$result = $model->status 
	            			? '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
	            			: '<span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
	            	return $result;
	            })      	                 
	            ->addColumn('action',function($model){
	                $result   = '';
					$result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
					$result  .= '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';

					return $result;

	            })
	            
	            ->rawColumns(['action','status'])
	            ->make(true);

		}elseif( auth()->user()->can('delete', Permission::class) ){
		   	return 	Datatables::of($query)   
	   			->editColumn('name', function($model) {
	                return ucfirst($model->name);
	            })   
	   			->addColumn('roles_count', function($model) {
	                return $model->roles->count();
	            })   
	   			->addColumn('for', function($model) {
	                return ucfirst($model->permission_type->name);
	            })    
	            ->editColumn('created_at', function($model) {
	                return $model->created_at->diffForHumans();
	            })  
	            ->editColumn('updated_at', function($model) {
	                return $model->updated_at->diffForHumans();
	            })  
	            ->editColumn('status', function($model) {
	            	$result = $model->status 
	            			? '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
	            			: '<span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
	            	return $result;
	            })      	                 
	            ->addColumn('action',function($model){
	                $result   = '';
					$result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
					$result  .= '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-xs btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';

					return $result;

	            })
	            
	            ->rawColumns(['action','status'])
	            ->make(true);

		}else{
	   	return 	Datatables::of($query)   
	   			->editColumn('name', function($model) {
	                return ucfirst($model->name);
	            })   
	   			->addColumn('roles_count', function($model) {
	                return $model->roles->count();
	            })   
	   			->addColumn('for', function($model) {
	                return ucfirst($model->permission_type->name);
	            })    
	            ->editColumn('created_at', function($model) {
	                return $model->created_at->diffForHumans();
	            })  
	            ->editColumn('updated_at', function($model) {
	                return $model->updated_at->diffForHumans();
	            })  
	            ->editColumn('status', function($model) {
	            	$result = $model->status 
	            			? '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
	            			: '<span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
	            	return $result;
	            })      	                 
	            ->addColumn('action',function($model){
	                $result   = '';
					$result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';

					return $result;

	            })
	            
	            ->rawColumns(['action','status'])
	            ->make(true);
		}	   	


   }
   	## Relationship ##

   	public function roles(){
   		return $this->belongsToMany(Role::class,'role_permissions','permission_id','role_id');
   	}

   	public function permission_type(){
   		return $this->belongsTo(PermissionType::class);		
   	}

}
