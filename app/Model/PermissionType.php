<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Datatables;
class PermissionType extends MyModel
{
    protected $table = 'permission_types';
    protected $fillable = ['name'];

	## Get all by AJAX request ##

   	public static function all_by_ajax(){
	   	$query 	= self::with('permissions')->get();
		if( auth()->user()->can('delete', self::class) ){
			return 	Datatables::of($query)   
	   			->editColumn('name', function($model) {
	                return ucfirst($model->name);
	            })
	            ->addColumn('permission_count', function($model) {
	                return $model->permissions()->count();
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
	            
	            ->rawColumns(['action','status','dates'])
	            ->make(true);

		}else{
			return 	Datatables::of($query)   
	   			->editColumn('name', function($model) {
	                return ucfirst($model->name);
	            })
	            ->addColumn('permission_count', function($model) {
	                return $model->permissions()->count();
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
	            
	            ->rawColumns(['action','status','dates'])
	            ->make(true);

		}


   }
   	## Relationship ##

   	public function permissions(){
   		return $this->hasMany(Permission::class);
   	}

}
