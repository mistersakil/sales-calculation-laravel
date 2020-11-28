<?php

namespace App\Model;

use Datatables;
class Client extends MyModel
{
   	
	## Get all clients by AJAX request ##

   	public static function all_by_ajax(){
   	$query = self::with('country')->get();
        if( auth()->user()->can('edit', Client::class)  && auth()->user()->can('delete', Client::class) ){
            return Datatables::of($query)
                ->editColumn('name', function($model) {
                    return $model->custom_short_text($model->name,50);
                })
                ->editColumn('country_id', function($model) {
                    return $model->country->name;
                }) 
                ->editColumn('created_at', function($model) {
                    return $model->created_at->diffForHumans();
                }) 
                ->editColumn('updated_at', function($model) {
                    return $model->updated_at->diffForHumans();
                }) 
                ->editColumn('status', function($model) {
                    if($model->status == 1){
                        return '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>';
                    }else{
                        return '<span class="label label-primary">'.$model->custom_status()[$model->status].'</span>';
                    }
                })          
                ->addColumn('action',function($model){
                    $result = '';
                    
                    $result .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';

                    $result  .= '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';                    

                    $result .= '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-xs btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';

                    return $result;

                })
                
                ->rawColumns(['action','status'])
                ->make(true);
        }elseif( auth()->user()->can('delete', Client::class) ){
            return Datatables::of($query)
                ->editColumn('name', function($model) {
                    return $model->custom_short_text($model->name,50);
                })
                ->editColumn('country_id', function($model) {
                    return $model->country->name;
                }) 
                ->editColumn('created_at', function($model) {
                    return $model->created_at->diffForHumans();
                }) 
                ->editColumn('updated_at', function($model) {
                    return $model->updated_at->diffForHumans();
                }) 
                ->editColumn('status', function($model) {
                    if($model->status == 1){
                        return '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>';
                    }else{
                        return '<span class="label label-primary">'.$model->custom_status()[$model->status].'</span>';
                    }
                })          
                ->addColumn('action',function($model){
                    $result = '';
                    
                    $result .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';

                    $result .= '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-xs btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';


                    return $result;

                })
                
                ->rawColumns(['action','status'])
                ->make(true);
        }elseif( auth()->user()->can('edit', Client::class) ){
            return Datatables::of($query)
                ->editColumn('name', function($model) {
                    return $model->custom_short_text($model->name,50);
                })
                ->editColumn('country_id', function($model) {
                    return $model->country->name;
                }) 
                ->editColumn('created_at', function($model) {
                    return $model->created_at->diffForHumans();
                }) 
                ->editColumn('updated_at', function($model) {
                    return $model->updated_at->diffForHumans();
                }) 
                ->editColumn('status', function($model) {
                    if($model->status == 1){
                        return '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>';
                    }else{
                        return '<span class="label label-primary">'.$model->custom_status()[$model->status].'</span>';
                    }
                })          
                ->addColumn('action',function($model){
                    $result = '';
                    
                    $result .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
                    
                    $result  .= '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';


                    return $result;

                })
                
                ->rawColumns(['action','status'])
                ->make(true);
        }else{
            return Datatables::of($query)
                ->editColumn('name', function($model) {
                    return $model->custom_short_text($model->name,50);
                })
                ->editColumn('country_id', function($model) {
                    return $model->country->name;
                }) 
                ->editColumn('created_at', function($model) {
                    return $model->created_at->diffForHumans();
                }) 
                ->editColumn('updated_at', function($model) {
                    return $model->updated_at->diffForHumans();
                }) 
                ->editColumn('status', function($model) {
                    if($model->status == 1){
                        return '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>';
                    }else{
                        return '<span class="label label-primary">'.$model->custom_status()[$model->status].'</span>';
                    }
                })          
                ->addColumn('action',function($model){
                    $result = '';
                    
                    $result .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';

                    return $result;

                })
                
                ->rawColumns(['action','status'])
                ->make(true);
        }
   	

   }

    ## Relationship ##

    public function country(){
    	return $this->belongsTo(Country::class);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }
}
