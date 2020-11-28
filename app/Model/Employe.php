<?php

namespace App\Model;

use Datatables;
class Employe extends MyModel
{
    protected $table = 'employees';


	## Get all employees by AJAX request ##

   	public static function all_by_ajax(){
   	$query = self::with('department')->get();
   	return Datatables::of($query)
            ->editColumn('name', function($model) {
                return $model->custom_short_text($model->name,50);
            })
            ->editColumn('join_date', function($model) {
            	return !empty($model->join_date)
                ? date_format(date_create($model->join_date),'d M Y')
                : 'Null';

            })  
            ->editColumn('department_id', function($model) {
                return $model->department->name;
            }) 
            ->editColumn('designation_id', function($model) {
                return $model->designation->name;
            })          
            ->addColumn('action',function($model){
                $status  = $model->status > 0 
                            ? '<a class="btn btn-default" title="'.__('common.PUBLISHED').'"><i class="fa fa-circle text-success" ></i></a>' 
                            : '<a class="btn btn-default" title="'.__('common.UNPUBLISHED').'"><i class="fa fa-circle text-danger" ></i></a>';
                $edit  = '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-sm btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';
                $delete = '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-sm btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';

                return $status.' '.$edit.' '.$delete;

            })
            
            ->rawColumns(['action'])
            ->make(true);

   }

    ## Relationship ##

    public function department(){
    	return $this->belongsTo(Department::class);
    }

    public function designation(){
    	return $this->belongsTo(Designation::class);
    }

}
