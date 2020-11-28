<?php

namespace App\Model;

use Datatables;

class Expense extends MyModel
{
    protected $table = 'expenses';
    

    ## Set Expense Type ##

    public function custom_expense_type(){     
         return [
            1 => 'Debit',
            2 => 'Credit',
        ];
    }

    ## Get all by AJAX request ##

    public static function all_by_ajax($request){
        $query  = self::get();
        if( auth()->user()->can('edit', Expense::class)  && auth()->user()->can('delete', Expense::class) ){
            return  Datatables::of($query) 
                    ->editColumn('title',function($model){
                       return ucfirst($model->title);                    
                    })                   
                    ->editColumn('date',function($model){
                       return ($model->custom_date_time($model->date,'d M, Y'));                    
                    })                   
                    ->editColumn('amount',function($model){
                       return number_format(($model->amount)); 
                    })                    
                    ->editColumn('type',function($model){
                        $type = $model->custom_expense_type()[$model->type];
                        $result = $model->type == 1
                        ? '<span class="label label-primary">'.$type.'</span>'
                        : '<span class="label label-info">'.$type.'</span>';
                         
                        return $result;
                    })                     
                    ->editColumn('status',function($model){
                        $status = $model->custom_status()[$model->status];
                        $result = $model->status 
                        ? '<span class="label label-success">'.$status.'</span>'
                        : '<span class="label label-danger">'.$status.'</span>';
                         
                        return $result;
                    })   
                    ->addColumn('action',function($model){
                        $result   = '';
                        $result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
                        $result  .= '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';
                        $result  .= '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-xs btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';

                        return $result;

                    })               
                    ->rawColumns(['action','status','type'])
                    ->make(true);
        }elseif( auth()->user()->can('edit', Expense::class) ){
            return  Datatables::of($query) 
                ->editColumn('title',function($model){
                   return ucfirst($model->title);                    
                })                   
                ->editColumn('date',function($model){
                   return ($model->custom_date_time($model->date,'d M, Y'));                    
                })                   
                ->editColumn('amount',function($model){
                   return number_format(($model->amount)); 
                })                    
                ->editColumn('type',function($model){
                    $type = $model->custom_expense_type()[$model->type];
                    $result = $model->type == 1
                    ? '<span class="label label-primary">'.$type.'</span>'
                    : '<span class="label label-info">'.$type.'</span>';
                     
                    return $result;
                })                     
                ->editColumn('status',function($model){
                    $status = $model->custom_status()[$model->status];
                    $result = $model->status 
                    ? '<span class="label label-success">'.$status.'</span>'
                    : '<span class="label label-danger">'.$status.'</span>';
                     
                    return $result;
                })   
                ->addColumn('action',function($model){
                    $result   = '';
                    $result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
                    $result  .= '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';

                    return $result;

                })               
                ->rawColumns(['action','status','type'])
                ->make(true);
        }elseif( auth()->user()->can('delete', Expense::class) ){
            return  Datatables::of($query) 
                ->editColumn('title',function($model){
                   return ucfirst($model->title);                    
                })                   
                ->editColumn('date',function($model){
                   return ($model->custom_date_time($model->date,'d M, Y'));                    
                })                   
                ->editColumn('amount',function($model){
                   return number_format(($model->amount)); 
                })                    
                ->editColumn('type',function($model){
                    $type = $model->custom_expense_type()[$model->type];
                    $result = $model->type == 1
                    ? '<span class="label label-primary">'.$type.'</span>'
                    : '<span class="label label-info">'.$type.'</span>';
                     
                    return $result;
                })                     
                ->editColumn('status',function($model){
                    $status = $model->custom_status()[$model->status];
                    $result = $model->status 
                    ? '<span class="label label-success">'.$status.'</span>'
                    : '<span class="label label-danger">'.$status.'</span>';
                     
                    return $result;
                })   
                ->addColumn('action',function($model){
                    $result   = '';
                    $result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
                   
                    $result  .= '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-xs btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';

                    return $result;

                })               
                ->rawColumns(['action','status','type'])
                ->make(true);

        }else{
            return  Datatables::of($query) 
                ->editColumn('title',function($model){
                   return ucfirst($model->title);                    
                })                   
                ->editColumn('date',function($model){
                   return ($model->custom_date_time($model->date,'d M, Y'));                    
                })                   
                ->editColumn('amount',function($model){
                   return number_format(($model->amount)); 
                })                    
                ->editColumn('type',function($model){
                    $type = $model->custom_expense_type()[$model->type];
                    $result = $model->type == 1
                    ? '<span class="label label-primary">'.$type.'</span>'
                    : '<span class="label label-info">'.$type.'</span>';
                     
                    return $result;
                })                     
                ->editColumn('status',function($model){
                    $status = $model->custom_status()[$model->status];
                    $result = $model->status 
                    ? '<span class="label label-success">'.$status.'</span>'
                    : '<span class="label label-danger">'.$status.'</span>';
                     
                    return $result;
                })   
                ->addColumn('action',function($model){
                    $result   = '';
                    $result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';

                    return $result;

                })               
                ->rawColumns(['action','status','type'])
                ->make(true);

        }


    }
    ## Relationship ##


    
}
