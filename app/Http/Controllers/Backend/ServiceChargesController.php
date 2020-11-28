<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use App\Model\ServiceCharge;
use App\Model\Project;
use App\Http\Requests\ServiceChargeStoreRequest;

class ServiceChargesController extends BackendController
{


    ## List action ##
    public function index()
    {
        if (auth()->user()->can('view_all', ServiceCharge::class)){            
           return view('backend.pages.service_charges.index');
        }else{
            return redirect()->route('admin.403');
        }
        
    }


    ## List action by ajax ##
    public function all_by_ajax(Request $request){
        if ($request->ajax()) return ServiceCharge::all_by_ajax();  
    }

    ## List action ##
    public function currnt_month()
    {
        if (auth()->user()->can('currnt_month', ServiceCharge::class)){            
            return view('backend.pages.service_charges.currnt_month');           
        }else{
            return redirect()->route('admin.403');
        }

    }


    ## List action by ajax ##
    public function currnt_month_ajax(Request $request){
        if ($request->ajax()) return ServiceCharge::currnt_month_ajax();  
    }

    
    ## Create action ##
    public function create()
    {
        return view('backend.pages.service_charges.create',[ 
            'project'           => Project::with('product','client')->get(),
            'service_charge'    => new ServiceCharge() 
        ]);
    }

    ## Store action ##
    public function store(ServiceChargeStoreRequest $request, ServiceCharge $object)    
    {
        $this->process_data($request, $object);    

        if($object->save()){
            return response()->json(['success' => 'true', 'message' => __('common.Created').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
        
    }

    ## Process data action ##

    private function process_data($request, $object){
        $object->project_id             = $request->project_id;
        $object->amount                 = $request->amount;
        $object->pay_schedule           = $request->pay_schedule;
        $object->status                 = $request->status;
        $object->start_date             = $request->start_date;
        $object->remarks                = $request->remarks;
    }

    ## Process data action ##
    public function show($id)
    {
        //
    }

    ## Edit action ##
    public function edit(Request $request)
    {
        $object = ServiceCharge::findOrFail($request->id);
        $projects = Project::with('product','client')->get();
        return view('backend.pages.service_charges.edit',['object' => $object, 'projects' => $projects]);
    }

    ## Update action ##
    public function update(ServiceChargeStoreRequest $request)
    {
        
        $object = ServiceCharge::findOrFail($request->id);
        $this->process_data($request, $object);       

        if($object->save()){
            return response()->json(['success' => 'true', 'message' => __('common.Updated').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
    }

    ## Delete action ##
    public function delete(Request $request){
        $id = $request->id; 
        return view('backend.pages.service_charges.delete',compact('id'));
    }

    ## Destroy action ##
    public function destroy(Request $request){
        if(ServiceCharge::destroy($request->id)){
            return response()->json(['success' => 'true','message' => __('common.Deleted').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false','message' => __('common.invalid query or server error')]);
        }

    }

    ## Receive MMC action ##
    public function receive(Request $request){
        $service_charge = ServiceCharge::with('project','project.client','project.product')->where('id',$request->id)->get()[0];
        return view('backend.pages.service_charges.receive',compact('service_charge'));
    }

    ## Pending AMC action ##
    public function pending(Request $request){
        $collection = collect([
            $this->amc_yearly_calculation(),
            $this->amc_monthly_calculation(),
            $this->amc_quarterly_calculation(),
        ]);
        $result['expected'] = $collection->sum('expected');
        $result['collected'] = $collection->sum('collected');
        $result['pending'] = $collection->sum('pending');
        $result['pending_list'] = $this->amc_pending_list();
        // return $result['pending_list'];
        return view('backend.pages.service_charges.pending',$result);
        
    }
    
    ## Yearly AMC calculation ##
    public function pending_single(Request $request){
        $id = $request->id;
        $model = ServiceCharge::with('project','project.client','project.collections','project.product')->where('id', $id)->first();
        $result['client_name'] = $model->project->client->name;
        $result['amc_start_date'] = $model->start_date;
        $month_list = [];
        /* Pending list on monthly scheduled for single AMC */
        if($model->pay_schedule == 1){
            $month_start    = (int) _custom_date_time($model->start_date,'m');             
            $month_end      = (int) date('m');
            $year_start     = (int) _custom_date_time($model->start_date,'Y');
            $year_end       = (int) date('Y');
            $month_list     = [];            
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

            $result['pending_month_list'] = $pending_months ?? $month_list; 
            $result['received_month_list'] = $collections; 
        }

        /* Pending list on yearly scheduled for single AMC */
        if($model->pay_schedule == 3){
            $start_date                 = date_create($model->start_date);
            $end_date                   = date_create(date('Y-m-d'));
            $date_diff                  = date_diff($start_date, $end_date);
            $number_of_days             = $date_diff->format("%a");
            $pending_cycle              = []            ;

            /** Calculating pending cycle **/
            $year_cycle                 = ceil($number_of_days/365);
            $collection_count           = $model->project->collections->where('collection_type',3)->count();
            $pending_cycle_count        = $year_cycle - $collection_count;
            // $pending_cycle_count        = 1;

            for($i=1; $i <= $pending_cycle_count; $i++){
                if($i == 1){
                    $month_start = $model->start_date;
                    $month_end = date("Y-m-d", strtotime("+11 month", strtotime($model->start_date)));                
                }else{
                    $month_start = date("Y-m-d", strtotime("+1 month", strtotime($month_end))); 
                    $month_end = date("Y-m-d", strtotime("+12 month", strtotime($month_end))); 
                }
                $pending_cycle[] = _custom_date_time($month_start, 'F Y') . ' - '. _custom_date_time($month_end,'F Y');
            }

            $result['pending_cycle'] = $pending_cycle;
            $result['collections'] = $model->project->collections->where('collection_type',3);
            return view('backend.pages.service_charges.pending_single_yearly', $result);
        }
        return view('backend.pages.service_charges.pending_single', $result);
        

    }

    ## Yearly AMC calculation ##
    public function amc_pending_list(){
        $amc_list = ServiceCharge::with('project','project.client','project.collections','project.product')->where('start_date','<=',date('Y-m-').'31')->where('status',1)->whereBetween('pay_schedule',[1,3])->get();
        return $amc_list;
    }

    ## Yearly AMC calculation ##
    public function amc_quarterly_calculation(){
        $service_charges = ServiceCharge::with('project','project.client','project.collections')->where('start_date','<=',date('Y-m-').'31')->where('status',1)->where('pay_schedule',2)->get();
        
        /* Loop through all monthly applicable amc */

        $amc_pending_amount_quarterly      = 0;
        $amc_expcted_amount_quarterly      = 0;
        $amc_collection_total_quarterly    = 0;
        foreach ($service_charges as $service_charge) {
            $start_date                 = date_create($service_charge->start_date);
            $end_date                   = date_create(date('Y-m-d'));
            $date_diff                  = date_diff($start_date, $end_date);
            $amc_charge                 = $service_charge->amount;
            
            $amc_expected_amount = $amc_charge * (ceil($date_diff->format("%a")/91));
            $amc_expcted_amount_quarterly += $amc_expected_amount;
            /* Find Amc collections that already collected */
            $amc_collection_total = $service_charge->project->collections->where('collection_type',3)->sum('amount');
            $amc_collection_total_quarterly += $amc_collection_total;
            $amc_pending_amount_quarterly   += $amc_expected_amount >= $amc_collection_total 
                                ? ($amc_expected_amount - $amc_collection_total) 
                                : $amc_expected_amount;
        }
        return [
            'expected' => $amc_expcted_amount_quarterly,
            'collected' => $amc_collection_total_quarterly,
            'pending' => $amc_pending_amount_quarterly,
        ];

    }


    ## Yearly AMC calculation ##
    public function amc_yearly_calculation(){
        $service_charges = ServiceCharge::with('project','project.client','project.collections')->where('start_date','<=',date('Y-m-').'31')->where('status',1)->where('pay_schedule',3)->get();
        
        /* Loop through all monthly applicable amc */

        $amc_pending_amount_yearly      = 0;
        $amc_expcted_amount_yearly      = 0;
        $amc_collection_total_yearly    = 0;
        foreach ($service_charges as $service_charge) {
            $start_date                 = date_create($service_charge->start_date);
            $end_date                   = date_create(date('Y-m-d'));
            $date_diff                  = date_diff($start_date, $end_date);
            $amc_charge                 = $service_charge->amount;
            
            $amc_expected_amount = $amc_charge * (ceil($date_diff->format("%a")/365));
            $amc_expcted_amount_yearly += $amc_expected_amount;
            /* Find Amc collections that already collected */
            $amc_collection_total = $service_charge->project->collections->where('collection_type',3)->sum('amount');
            $amc_collection_total_yearly += $amc_collection_total;
            $amc_pending_amount_yearly   += $amc_expected_amount >= $amc_collection_total 
                                ? ($amc_expected_amount - $amc_collection_total) 
                                : $amc_expected_amount;
        }
        return [
            'expected' => $amc_expcted_amount_yearly,
            'collected' => $amc_collection_total_yearly,
            'pending' => $amc_pending_amount_yearly,
        ];
    }

    ## Monthly AMC calculation ##
    public function amc_monthly_calculation(){
        $service_charges = ServiceCharge::with('project','project.client','project.collections')->where('start_date','<=',date('Y-m-').'31')->where('status',1)->where('pay_schedule',1)->get();
        /* Loop through all monthly applicable amc */

        $amc_pending_amount_monthly = 0;
        $amc_expcted_amount_monthly = 0;
        $amc_collection_total_monthly = 0;
        foreach ($service_charges as $service_charge) {
            $month_start = (int) _custom_date_time($service_charge->start_date,'m');
            $last_month = 12;
            $amc_expected_month_list = [];
            $amc_monthly_charge = $service_charge->amount;
            /* Amc applicable month list generate */
            for($month_start; $month_start <= $last_month; $month_start++){
                if(strlen($month_start) == 1) {
                    $amc_expected_month_list[] = date('Y').'-0'.$month_start;
                }else{
                    $amc_expected_month_list[] = date('Y').'-'.$month_start;                    
                }                
            }

            $amc_expected_amount = $amc_monthly_charge * count($amc_expected_month_list);
            $amc_expcted_amount_monthly += $amc_expected_amount;
            /* Find Amc collections that already collected */
            $amc_collection_total = $service_charge->project->collections->where('collection_type',3)->sum('amount');
            $amc_collection_total_monthly += $amc_collection_total;
            $amc_pending_amount_monthly += $amc_expected_amount >= $amc_collection_total 
                                ? ($amc_expected_amount - $amc_collection_total) 
                                : $amc_expected_amount;
        }
        return [
            'expected' => $amc_expcted_amount_monthly,
            'collected' => $amc_collection_total_monthly,
            'pending' => $amc_pending_amount_monthly,
        ];
    }


}
