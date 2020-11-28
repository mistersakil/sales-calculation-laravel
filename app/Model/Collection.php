<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Datatables;

class Collection extends MyModel
{
    protected $table = 'collections';

    public static function collection_type(){
    	return [
    		1 => 'Advance',
    		2 => 'After Implementation',
    		3 => 'Service Charge',
    		4 => 'Customization Charge',
    		5 => 'Other Charges',
    	];
    }

	## Get all by AJAX request ##

   	public static function all_by_ajax($request){
	   	$query = self::with('project.product','project.client','project','remark')->get();
	   	$query = $request->ctype ? $query->where('collection_type',$request->ctype) : $query;
	   	
	   	if( auth()->user()->can('edit', Collection::class)  && auth()->user()->can('delete', Collection::class) ){
			return 	Datatables::of($query)   
	   			->editColumn('project_id', function($model) {
	                $product 	= $model->project->product->code;
	                $client 	= $model->project->client->name;
	                return $client . ' <sup><span class="label label-primary"> ' .$product .' </span></sup>';
	            })   
	            ->editColumn('amount', function($model) {
	                return number_format($model->amount);
	            })    
	            ->editColumn('collection_type', function($model) {
	                return ($model->collection_type()[$model->collection_type]);
	            })      
	            ->editColumn('collection_date', function($model) {
	                return date_format(date_create($model->collection_date),'d F, Y');
	            })  

	            ->addColumn('remark', function($model) {
	                return $model->remark['body'];
	            })   	                 
	            ->addColumn('action',function($model){
	            	$result   = '';
	            	$result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
	                $result  .= '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';
	                $result  .= '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-xs btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';

	                return $result;

	            })
	            
	            ->rawColumns(['project_id','action'])
	            ->with('sum_of_all_rows', self::sum('amount'))
	            ->make(true);

	   	}elseif( auth()->user()->can('edit', Collection::class) ){
			return 	Datatables::of($query)   
	   			->editColumn('project_id', function($model) {
	                $product 	= $model->project->product->code;
	                $client 	= $model->project->client->name;
	                return $client . ' <sup><span class="label label-primary"> ' .$product .' </span></sup>';
	            })   
	            ->editColumn('amount', function($model) {
	                return number_format($model->amount);
	            })    
	            ->editColumn('collection_type', function($model) {
	                return ($model->collection_type()[$model->collection_type]);
	            })      
	            ->editColumn('collection_date', function($model) {
	                return date_format(date_create($model->collection_date),'d F, Y');
	            })  

	            ->addColumn('remark', function($model) {
	                return $model->remark['body'];
	            })   	                 
	            ->addColumn('action',function($model){
	            	$result = '';
	            	$result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
	                $result .= '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';

	                return $result;

	            })
	            
	            ->rawColumns(['project_id','action'])
	            ->with('sum_of_all_rows', self::sum('amount'))
	            ->make(true);

	   	}elseif( auth()->user()->can('delete', Collection::class) ){
			return 	Datatables::of($query)   
	   			->editColumn('project_id', function($model) {
	                $product 	= $model->project->product->code;
	                $client 	= $model->project->client->name;
	                return $client . ' <sup><span class="label label-primary"> ' .$product .' </span></sup>';
	            })   
	            ->editColumn('amount', function($model) {
	                return number_format($model->amount);
	            })    
	            ->editColumn('collection_type', function($model) {
	                return ($model->collection_type()[$model->collection_type]);
	            })      
	            ->editColumn('collection_date', function($model) {
	                return date_format(date_create($model->collection_date),'d F, Y');
	            })  

	            ->addColumn('remark', function($model) {
	                return $model->remark['body'];
	            })   	                 
	            ->addColumn('action',function($model){
	                $result  = '';
	                $result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
	                $result  .= '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-xs btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';

	                return $result;

	            })
	            
	            ->rawColumns(['project_id','action'])
	            ->with('sum_of_all_rows', self::sum('amount'))
	            ->make(true);

	   	}else{
			return 	Datatables::of($query)   
	   			->editColumn('project_id', function($model) {
	                $product 	= $model->project->product->code;
	                $client 	= $model->project->client->name;
	                return $client . ' <sup><span class="label label-primary"> ' .$product .' </span></sup>';
	            })   
	            ->editColumn('amount', function($model) {
	                return number_format($model->amount);
	            })    
	            ->editColumn('collection_type', function($model) {
	                return ($model->collection_type()[$model->collection_type]);
	            })      
	            ->editColumn('collection_date', function($model) {
	                return date_format(date_create($model->collection_date),'d F, Y');
	            })  

	            ->addColumn('remark', function($model) {
	                return $model->remark['body'];
	            })   	                 
	            ->addColumn('action',function($model){
	                $result  = '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';

	                return $result;

	            })
	            
	            ->rawColumns(['project_id','action'])
	            ->with('sum_of_all_rows', self::sum('amount'))
	            ->make(true);
	   	}

	   	

   }

    ## Relationship ##

    public function project(){
    	return $this->belongsTo(Project::class);
    }

    public function remark(){
    	return $this->morphOne(Remark::class,'remarkable');
    }
}
