<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Datatables;
class Role extends MyModel
{
    protected $table = 'roles';

	## Get all by AJAX request ##

   	public static function all_by_ajax(){
	   	$query 	= self::with('users')->get();
	   	if( auth()->user()->can('edit', Role::class)  && auth()->user()->can('delete', Role::class) ){
	   		return 	Datatables::of($query)   
	   			->editColumn('name', function($model) {
	                return $model->name;
	            })   
	            ->editColumn('description', function($model) {
	                return $model->description;
	            })    
	            ->addColumn('user_count', function($model) {
	                return $model->users()->where('status',1)->count();
	            })     
	            ->addColumn('permission_count', function($model) {
	                return $model->permissions()->where('status',1)->count();
	            })   
	            ->editColumn('status', function($model) {
	            	$result = $model->status 
	            			? '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
	            			: '<span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
	            	return $result;
	            }) 	              
	            ->editColumn('updated_at', function($model) {
	                return !empty($model->updated_at) ? $model->updated_at->diffForHumans() : '';
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
		}elseif( auth()->user()->can('edit', Role::class) ){
			return 	Datatables::of($query)   
	   			->editColumn('name', function($model) {
	                return $model->name;
	            })   
	            ->editColumn('description', function($model) {
	                return $model->description;
	            })    
	            ->addColumn('user_count', function($model) {
	                return $model->users()->where('status',1)->count();
	            })     
	            ->addColumn('permission_count', function($model) {
	                return $model->permissions()->where('status',1)->count();
	            })   
	            ->editColumn('status', function($model) {
	            	$result = $model->status 
	            			? '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
	            			: '<span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
	            	return $result;
	            }) 	              
	            ->editColumn('updated_at', function($model) {
	                return !empty($model->updated_at) ? $model->updated_at->diffForHumans() : '';
	            })      	                 
	            ->addColumn('action',function($model){
	                $result   = '';
					$result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
					$result  .= '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';

					return $result;

	            })
	            
	            ->rawColumns(['action','status'])
	            ->make(true);

		}elseif( auth()->user()->can('delete', Role::class) ){
			return 	Datatables::of($query)   
	   			->editColumn('name', function($model) {
	                return $model->name;
	            })   
	            ->editColumn('description', function($model) {
	                return $model->description;
	            })    
	            ->addColumn('user_count', function($model) {
	                return $model->users()->where('status',1)->count();
	            })     
	            ->addColumn('permission_count', function($model) {
	                return $model->permissions()->where('status',1)->count();
	            })   
	            ->editColumn('status', function($model) {
	            	$result = $model->status 
	            			? '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
	            			: '<span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
	            	return $result;
	            }) 	              
	            ->editColumn('updated_at', function($model) {
	                return !empty($model->updated_at) ? $model->updated_at->diffForHumans() : '';
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
	                return $model->name;
	            })   
	            ->editColumn('description', function($model) {
	                return $model->description;
	            })    
	            ->addColumn('user_count', function($model) {
	                return $model->users()->where('status',1)->count();
	            })     
	            ->addColumn('permission_count', function($model) {
	                return $model->permissions()->where('status',1)->count();
	            })   
	            ->editColumn('status', function($model) {
	            	$result = $model->status 
	            			? '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
	            			: '<span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
	            	return $result;
	            }) 	              
	            ->editColumn('updated_at', function($model) {
	                return !empty($model->updated_at) ? $model->updated_at->diffForHumans() : '';
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

   	public function users(){
   		return $this->belongsToMany(User::class,'user_roles','role_id','user_id');
   	}

   	public function permissions(){
   		return $this->belongsToMany(Permission::class,'role_permissions','role_id','permission_id')->withTimestamps();
   	}

}
