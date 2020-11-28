<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Datatables;

class ServiceCharge extends MyModel
{
    protected $table = 'service_charges';

    public function pay_schedule(){
    	return [
    		1 => 'Monthly',
    		2 => 'Quarterly',
    		3 => 'Yearly'
    	];
    }
    public function service_status(){
    	return [
    		1 => 'Running',
    		2 => 'Expected',
    		3 => 'Close'
    	];
    }

	## Get all by AJAX request ##

   	public static function all_by_ajax($status = [1,2,3]){
	   	$query 	= self::with('project','project.product','project.client','project.collections')
	   			->whereIn('status',$status)
	   			->get();

		if( auth()->user()->can('edit', ServiceCharge::class)  && auth()->user()->can('delete', ServiceCharge::class) ){
			return 	Datatables::of($query)   
	   			->editColumn('project_id', function($model) {
	                $product 	= $model->project->product->code;
	                $client 	= $model->project->client['name'];
	                return $client . ' <sup><span class="label label-primary"> ' .$product .' </span></sup>';
	            })   
	            ->editColumn('amount', function($model) {
	                return number_format($model->amount);
	            })   
	            ->editColumn('status', function($model) {
	                return ($model->service_status()[$model->status]);
	            })    
	            ->editColumn('pay_schedule', function($model) {
	                return ($model->pay_schedule()[$model->pay_schedule]);
	            })    
	            ->editColumn('start_date', function($model) {
	                return date_format(date_create($model->start_date), 'F Y');
	            })    	                 
	            ->addColumn('action',function($model){
	            	$result   = '';
	            	$result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
	                $result  .= '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';
	                $result  .= '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-xs btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';

	                return $result;

	            })
	            
	            ->rawColumns(['project_id','action'])
	            ->make(true);
		}elseif( auth()->user()->can('edit', ServiceCharge::class) ){
			return 	Datatables::of($query)   
	   			->editColumn('project_id', function($model) {
	                $product 	= $model->project->product->code;
	                $client 	= $model->project->client['name'];
	                return $client . ' <sup><span class="label label-primary"> ' .$product .' </span></sup>';
	            })   
	            ->editColumn('amount', function($model) {
	                return number_format($model->amount);
	            })   
	            ->editColumn('status', function($model) {
	                return ($model->service_status()[$model->status]);
	            })    
	            ->editColumn('pay_schedule', function($model) {
	                return ($model->pay_schedule()[$model->pay_schedule]);
	            })    
	            ->editColumn('start_date', function($model) {
	                return date_format(date_create($model->start_date), 'F Y');
	            })     	                 
	            ->addColumn('action',function($model){
	            	$result = '';
	            	$result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
	                $result .= '<a  title="'.__('common.EDIT').'" class="btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';
	                
	                return $result;

	            })
	            
	            ->rawColumns(['project_id','action'])
	            ->make(true);

		}elseif( auth()->user()->can('delete', ServiceCharge::class) ){
			return 	Datatables::of($query)   
	   			->editColumn('project_id', function($model) {
	                $product 	= $model->project->product->code;
	                $client 	= $model->project->client['name'];
	                return $client . ' <sup><span class="label label-primary"> ' .$product .' </span></sup>';
	            })   
	            ->editColumn('amount', function($model) {
	                return number_format($model->amount);
	            })   
	            ->editColumn('status', function($model) {
	                return ($model->service_status()[$model->status]);
	            })    
	            ->editColumn('pay_schedule', function($model) {
	                return ($model->pay_schedule()[$model->pay_schedule]);
	            })    
	            ->editColumn('start_date', function($model) {
	                return date_format(date_create($model->start_date), 'F Y');
	            })     	                 
	            ->addColumn('action',function($model){
	            	$result = '';
	            	$result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
	               
	                $result .= '<a  title="'.__('common.DELETE').'" class="btn-danger btn-xs btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';

	                return $result;

	            })
	            
	            ->rawColumns(['project_id','action'])
	            ->make(true);

		}else{
			return 	Datatables::of($query)   
	   			->editColumn('project_id', function($model) {
	                $product 	= $model->project->product->code;
	                $client 	= $model->project->client['name'];
	                return $client . ' <sup><span class="label label-primary"> ' .$product .' </span></sup>';
	            })   
	            ->editColumn('amount', function($model) {
	                return number_format($model->amount);
	            })   
	            ->editColumn('status', function($model) {
	                return ($model->service_status()[$model->status]);
	            })    
	            ->editColumn('pay_schedule', function($model) {
	            	$result = '';
	            	if($model->pay_schedule == 1){
	            		$result .= '<span class="label label-primary">'.$model->pay_schedule()[$model->pay_schedule].'</span>';
	            	}elseif($model->pay_schedule == 2){
	            		$result .= '<span class="label label-danger">'.$model->pay_schedule()[$model->pay_schedule].'</span>';
	            	}else{
	            		$result .= '<span class="label label-success">'.$model->pay_schedule()[$model->pay_schedule].'</span>';
	            	}
	                return $result;
	            })    
	            ->editColumn('start_date', function($model) {
	                return date_format(date_create($model->start_date), 'F Y');
	            })     	                 
	            ->addColumn('action',function($model){
	            	$result = '';
	            	$result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';

	                return $result;

	            })
	            
	            ->rawColumns(['project_id','action','pay_schedule'])
	            ->make(true);

		}
	   	

   }


	## Get all by AJAX request ##

   	public static function currnt_month_ajax($status = [1]){
	   	$query 	= self::with('project','project.product','project.client','project.collections')
	   			->where('start_date','<=',date('Y-m-').'31')
	   			->whereIn('status',$status)
	   			->get();
	   	return 	Datatables::of($query)   
	   			->editColumn('project_id', function($model) {
	                $client 	= $model->project->client['name'];
	                $client 	= '<span title="'.$client.'">'._custom_short_text($client,20,true).'</span>';
	                return $client;
	            })   
	            ->editColumn('amount', function($model) {

	                $amount = number_format($model->amount);

	                return $amount;
	            })   
	            ->editColumn('start_date', function($model) {

	                $amount = _custom_date_time($model->start_date,'M Y');

	                return $amount;
	            })   
	            ->editColumn('pay_schedule', function($model) {
	                $result = '';
	            	if($model->pay_schedule == 1){
	            		$result .= '<span class="label label-primary">'.$model->pay_schedule()[$model->pay_schedule].'</span>';
	            	}elseif($model->pay_schedule == 2){
	            		$result .= '<span class="label label-success">'.$model->pay_schedule()[$model->pay_schedule].'</span>';
	            	}else{
	            		$result .= '<span class="label label-success">'.$model->pay_schedule()[$model->pay_schedule].'</span>';
	            	}
	                return $result;
	            })    
	            ->addColumn('collection_type', function($model) {
	            	
	            	$is_pending = 'Pending';
	            	if($model->pay_schedule == 1){
	            		$result = $model->project->collections->where('collection_type',3)->whereBetween('collection_date',[date('Y-m-').'01',date('Y-m-').'31'])->first();
		            	if($result){
		            		return _custom_date_time($result->collection_date,'d M, Y');
		            	}else{
		            		return $is_pending;
		            	}
	            	}elseif($model->pay_schedule == 3){
	            		$start_date                 = date_create($model->start_date);
			            $end_date                   = date_create(date('Y-m-d'));
			            $date_diff                  = date_diff($start_date, $end_date);
			            $number_of_days             = $date_diff->format("%a");
			            
			            /** Calculating pending cycle **/
			            $cycle_count                = ceil($number_of_days/365);
			            $collection_count           = $model->project->collections->where('collection_type',3)->count();
			            if($collection_count >= $cycle_count ){
			            	$result = $model->project->collections->where('collection_type',3)->whereBetween('collection_date',[$model->start_date,date('Y-m-').'31'])->first();
			            	if($result){
			            		return _custom_date_time($result->collection_date,'d M, Y');
			            	}else{
			            		return $is_pending;
			            	}
			            }else{
			            	return $is_pending;
			            }

	            	}elseif($model->pay_schedule == 2){
	            		$start_date                 = date_create($model->start_date);
			            $end_date                   = date_create(date('Y-m-d'));
			            $date_diff                  = date_diff($start_date, $end_date);
			            $number_of_days             = $date_diff->format("%a");
			            $pending_cycle              = []            ;

			            /** Calculating pending cycle **/
			            $cycle_count                 = ceil($number_of_days/91);
			            $collection_count           = $model->project->collections->where('collection_type',3)->count();
			            $pending_count       		= $cycle_count - $collection_count;
			            if( $pending_count == 0 ){
			            	$result = $model->project->collections->where('collection_type',3)->whereBetween('collection_date',[$model->start_date,date('Y-m-').'31'])->last();
			            	if($result){
			            		return _custom_date_time($result->collection_date,'d M, Y');
			            	}else{
			            		return $is_pending;
			            	}
			            }else{
			            	return $is_pending;
			            }

	            	}else{
	            		return $is_pending;
	            	}
	            })	               
	            ->addColumn('product', function($model) {
	            	$result = '<span title="'.$model->project->product->name.'">'.$model->project->product->code.'</span>';
	                return $result;
	            })	               
	            ->addColumn('total_pending', function($model) {
	            	$result = 0;
	            	/* Pending list on monthly scheduled for single AMC */
			        if($model->pay_schedule == 1){
			            $month_start    = (int) _custom_date_time($model->start_date,'m');             
			            $month_end      = (int) date('m');
			            $year_start     = (int) _custom_date_time($model->start_date,'Y');
			            $year_end       = (int) date('Y');
			            // $month_list     = [];
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
			            /* Collection list on monthly scheduled for single AMC */
			            $collections = $model->project->collections->where('collection_type',3);
			            $collection_month_list = [];
			            foreach ($collections as $collection) {
			                $collection_month_list[] = _custom_date_time($collection['collection_date'],'Y-m-'.'01');
			            }
			            if(count($collection_month_list)){  
			                $pending_months = array_diff($month_list, $collection_month_list);
			            }
			            $pending_count = isset($pending_months) ? count($pending_months) : count($month_list);
			            $result = '<span class="badge">'.$pending_count .'</span> * '.$model->amount.' = '.number_format($pending_count * $model->amount );

			        }elseif($model->pay_schedule == 3){
			            $start_date                 = date_create($model->start_date);
			            $end_date                   = date_create(date('Y-m-d'));
			            $date_diff                  = date_diff($start_date, $end_date);
			            $number_of_days             = $date_diff->format("%a");
			            $pending_cycle              = []            ;

			            /** Calculating pending cycle **/
			            $cycle_count                = ceil($number_of_days/365);
			            $collection_count           = $model->project->collections->where('collection_type',3)->count();
			            $pending_count       		= $cycle_count - $collection_count;
			            // $pending_cycle_count        = 1;
			            $result = '<span class="badge">'.$pending_count .'</span> * '.$model->amount.' = '.number_format($pending_count * $model->amount );

			        }else{
			        	$start_date                 = date_create($model->start_date);
			            $end_date                   = date_create(date('Y-m-d'));
			            $date_diff                  = date_diff($start_date, $end_date);
			            $number_of_days             = $date_diff->format("%a");
			            $pending_cycle              = []            ;

			            /** Calculating pending cycle **/
			            $cycle_count                 = ceil($number_of_days/91);
			            $collection_count           = $model->project->collections->where('collection_type',3)->count();
			            $pending_count       		= $cycle_count - $collection_count;
			            $result = '<span class="badge">'.$pending_count .'</span> * '.$model->amount.' = '.number_format($pending_count * $model->amount );
			        }
	                return $result;
	            }) 	                 
	            ->addColumn('action',function($model){
	            	$result = '';
	            	$is_collected = false;
	            	if($model->pay_schedule == 1){
	            		$is_collected = $model->project->collections->where('collection_type',3)->whereBetween('collection_date',[date('Y-m-').'01',date('Y-m-').'31'])->count();
	            	}elseif($model->pay_schedule == 3){
	            		$start_date                 = date_create($model->start_date);
			            $end_date                   = date_create(date('Y-m-d'));
			            $date_diff                  = date_diff($start_date, $end_date);
			            $number_of_days             = $date_diff->format("%a");
			            
			            /** Calculating pending cycle **/
			            $year_cycle                 = ceil($number_of_days/365);
			            $collection_count           = $model->project->collections->where('collection_type',3)->count();
			            if($collection_count >= $year_cycle ){
			            	$is_collected = true;
			            }

	            	}else{
	            		$is_collected = false;
	            	}
	            	
	               
	            	// $is_collected = false;
	                if($is_collected){
						$result .= '<a  title="'.__('common.Already').' '.__('common.Received').'" class="btn btn-success btn-xs"><i class="fa fa-check"></i> '.'</a>';
	                }else{
	                	$result .= '<a  title="'.__('common.Receive').'" class="btn btn-warning btn-xs btn_receive" data-id="'.$model->id.'"><i class="fa fa-check"></i> '.'</a>';
	                }
	                $result .= '<a  title="'.__('common.Pending').'" class="btn btn-info btn-xs btn_pending" data-id="'.$model->id.'"><i class="fa fa-anchor"></i> '.'</a>';

	                return $result;

	            })
	            
	            ->rawColumns(['project_id','action','pending','pay_schedule','product','total_pending'])
	            ->make(true);

   }

    ## Relationship ##

    public function project(){
    	return $this->belongsTo(Project::class);
    }

    public function alerts(){
    	return $this->hasMany(Alert::class);
    }
}
