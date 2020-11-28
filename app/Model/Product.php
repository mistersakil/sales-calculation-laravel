<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Datatables;
class Product extends MyModel
{
    protected $table = 'products';

    public function platforms(){
    	return [
    		'1' => 'PHP',
    		'2' => '.NET',
    		'3' => 'VB.NET',
    		'4' => 'Others'
    	];	
    }


	## Get all by AJAX request ##

   	public static function all_by_ajax(){
	   	$query 	= self::with('projects')->get();
	   	if( auth()->user()->can('edit', self::class)  && auth()->user()->can('delete', self::class) ){
	   		return 	Datatables::of($query)   
	   			->editColumn('name', function($model) {
	                return $model->name;
	            })    
	            ->editColumn('platform_id', function($model) {
	            	if($model->platform_id){
	                	return $model->platforms()[$model->platform_id];	            		
	            	}else{
	                	return 'Unknown';	            		
	            	}
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
	            ->addColumn('projects_count', function($model) {
	                return $model->projects()->count();
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
		}elseif( auth()->user()->can('edit', self::class) ){
			return 	Datatables::of($query)   
	   			->editColumn('name', function($model) {
	                return $model->name;
	            })    
	            ->editColumn('platform_id', function($model) {
	            	if($model->platform_id){
	                	return $model->platforms()[$model->platform_id];	            		
	            	}else{
	                	return 'Unknown';	            		
	            	}
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

		}elseif( auth()->user()->can('delete', self::class) ){
			return 	Datatables::of($query)   
	   			->editColumn('name', function($model) {
	                return $model->name;
	            })    
	            ->editColumn('platform_id', function($model) {
	            	if($model->platform_id){
	                	return $model->platforms()[$model->platform_id];	            		
	            	}else{
	                	return 'Unknown';	            		
	            	}
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
	            ->editColumn('platform_id', function($model) {
	            	if($model->platform_id){
	                	return $model->platforms()[$model->platform_id];	            		
	            	}else{
	                	return 'Unknown';	            		
	            	}
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

    public function projects(){
    	return $this->hasMany(Project::class);
    }

}
