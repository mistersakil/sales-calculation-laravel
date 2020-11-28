<?php 
// In model


	   	if( auth()->user()->can('edit', Project::class)  && auth()->user()->can('delete', Project::class) ){

		}elseif( auth()->user()->can('edit', Project::class) ){

		}elseif( auth()->user()->can('delete', Project::class) ){

		}else{

		}

// in controller

if (auth()->user()->can('view_all', $this->new_model)){            
            return view('backend.pages.permission_types.index');           
        }else{
            return redirect()->route('admin.403');
        }



$result   = '';
$result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
$result  .= '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';
$result  .= '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-xs btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';

return $result;



    $start_date = (int) _custom_date_time($model->start_date,'m');
    $current_month = (int) date('m') ;
    $month_range = [];
    for($start_date; $start_date <= $current_month; $start_date++) {
    	$month_range[date('Y')][] = $start_date;
    }

function(){
        $month_start = (int) _custom_date_time('2019-10-01','m');
        $month_end = $month_start - 1;
        $year_start = (int) _custom_date_time('2019-10-01','Y');
        $year_start_cycle = 0;
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
}








    ## Yearly AMC calculation ##
    public function amc_yearly_calculation(){
        $service_charges = ServiceCharge::with('project','project.client','project.collections')->where('start_date','<=',date('Y-m-').'31')->where('status',1)->where('pay_schedule',3)->get();
        
        // return $service_charges;
        /* Loop through all monthly applicable amc */

        $amc_pending_amount_yearly      = 0;
        $amc_expcted_amount_yearly      = 0;
        $amc_collection_total_yearly    = 0;
        foreach ($service_charges as $service_charge) {
            $start_date         = $service_charge->start_date;
            $start_date         = '2018-10-10';
            $month_start        = (int) _custom_date_time($start_date,'m');
            $month_end          = $month_start - 1;
            $year_start         = (int) _custom_date_time($start_date,'Y');
            $year_start_cycle   = 0;
            $year_start         = $year_start + $year_start_cycle;
            $year_end           = $year_start + 1;
            $month_list         = [];
            $amc_charge         = $service_charge->amount;
            for($month_start; $month_start <= 12; $month_start++){
                if(strlen($month_start) == 1) {
                    $month_list[] = $year_start.'-0'.$month_start;
                }else{
                    $month_list[] = $year_start.'-'.$month_start;
                }

                if( ($year_start == $year_end) && ($month_start == $month_end) ) {
                    break;
                }
                if($month_start == 12) {
                    $month_start = 0;
                    $year_start++;
                }
            }
            $month_list[11] = _custom_date_time(end($month_list),'Y-m');
            // return in_array("2019-11-03", $month_list) ? 'already exist' : 'new insert';
            // return array_key_last($month_list);

            $amc_expected_amount = $amc_charge * (count($month_list)/12);
            $amc_expcted_amount_yearly += $amc_expected_amount;
            /* Find Amc collections that already collected */
            $amc_collection_total = $service_charge->project->collections()->where('collection_type',3)->sum('amount');
            $amc_collection_total_yearly += $amc_collection_total;
            $amc_pending_amount_yearly += $amc_expected_amount >= $amc_collection_total 
                                ? ($amc_expected_amount - $amc_collection_total) 
                                : $amc_expected_amount;
        }
        // dump($amc_expected_amount);

        dump( $month_list );
        return [
            'expected' => $amc_expcted_amount_yearly,
            'collected' => $amc_collection_total_yearly,
            'pending' => $amc_pending_amount_yearly,
        ];
    }


                ->addColumn('pending', function($model) {

     //             $start_month            = (int) _custom_date_time($model->start_date,'m');
                 //    $current_month           = (int) date('m') ;
                 //    $expected_month_range    = [];
                 //    $month_list          = [];
                 //    $current_year            = date('Y');
                 //    $pending_months_final = '';
                 //    for($start_month; $start_month <= $current_month; $start_month++) {
                 //     $expected_month_range[$current_year][] = strlen($start_month) == 1 ? '0'.$start_month : $start_month;
                 //     if(strlen($start_month) == 1){
                 //         $month_list["0{$start_month}"] = _custom_date_time("{$current_year}-0{$start_month}-01",'M Y');
                 //     }else{
                 //         $month_list["$start_month"] = _custom_date_time("{$current_year}-{$start_month}-01",'M Y');
                 //     }
                 //    }

        //             $collections = $model->project->collections;
        //             if($collections->count()){
           //              $collected_year = '';
           //           $collected_month_range = [];
                 //         foreach ($collections as $collection) {
                 //             if($collection->collection_type == 3){
                 //                 $collected_year = _custom_date_time($collection->collection_date,'Y');
                 //                 $collected_month = _custom_date_time($collection->collection_date,'m');
                 //                 $collected_month_range[$collected_year][]= $collected_month;
                 //             }
                 //         }
                 //         if(count($collected_month_range)){  
                    //      $pending_months = array_diff($expected_month_range[$collected_year], $collected_month_range[$collected_year]);                          
                    //      foreach ($pending_months as $key => $value) {
                    //          if(array_key_exists($value, $month_list)){
                    //              $pending_months_final .= '<span class="badge">'.$month_list[$value].'</span>';
                    //          }
                    //      }
                    //      return ($pending_months_final);
                 //         }
                 //     }
           //       foreach ($expected_month_range[$current_year] as  $value) {
                    //  $pending_months_final .= '<span class="badge">'.$month_list[$value].'</span>';
                    // }
                    // return ($pending_months_final);

                })  





         //         if($model->pay_schedule == 3){
         //             $amount = number_format($model->amount / 12);
         //         }elseif($model->pay_schedule == 2){
                        // $amount = number_format($model->amount / 3);
         //         }else{
         //             $amount = number_format($model->amount);
         //         }


















?>