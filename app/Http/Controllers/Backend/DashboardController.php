<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;
use App\Model\Product;
use App\Model\Project;
use App\Model\Collection;
use App\Model\ServiceCharge;
use App\Model\Client;
use DB;
class DashboardController extends BackendController
{
    /* Dashboard view */

    public function index()
    {
        $result = Project
                ::selectRaw('max(agreement_date) as date_max')
                ->selectRaw('min(agreement_date) as date_min')
                ->get()
                ->toArray()[0];
        $result['total_clients'] = Client::where('status',1)->count();
        $result['total_projects'] = Project::where('status',1)->count();
        $result = array_merge($result,$this->client_project_info());
        return view('backend.pages.dashboard.index',$result);
    }

    /* Client project info view */

    private function client_project_info()
    {
        $project = new Project();
        $projects = Project
                ::selectRaw('progress as progress_type, COUNT(progress) as total')
                ->where('status', 1)
                ->groupBy('progress')
                ->get()
                ->toArray();
        foreach ($projects as $key => $value) {
            $result[strtolower($project->custom_progress()[$value['progress_type']])] = $value['total'];
        }
        return $result;
    }

    /* Revenue collection sumery */

    public function vms_po_summary(Request $request){
        $date_range = $request->toArray();
        $result =  Project
                ::selectRaw('sum(total_amount) as po_total_value')
                ->selectRaw('sum(advance_amount) as po_total_advance')
                ->selectRaw('sum(unit) as po_total_unit')
                ->selectRaw('count(*) as total_company') 
                ->where('status','=','1')
                ->whereBetween('agreement_date',$date_range)
                ->get()
                ->toArray();
        return view('backend.pages.dashboard.ajax.po_summary',$result[0]);
    }


    /* Revenue collection sumery */

    public function vms_revenue_summary(Request $request){
        $result =  Project
                ::selectRaw('sum(total_amount) as po_value')
                ->selectRaw('sum(unit) as po_total_unit')           
                ->where('status',1)
                ->where('product_id',6)
                ->get()
                ->toArray()[0];

        $collection = Collection::selectRaw('sum(amount) as amount')
                    ->join('projects', 'projects.id', '=', 'collections.project_id')
                    ->join('products', 'products.id', '=', 'projects.product_id')
                    ->where('products.id','=',6)
                    ->whereBetween('collections.collection_type',[1,2])
                    ->get()[0]['amount'];
        
        $result['advance_postsale_collection']  = $collection;
        $result['advance_postsale_pending']     = $result['po_value'] - $collection;

        return view('backend.pages.dashboard.ajax.summary1_ajax',$result);
    }


    /* Revenue collection summary chart */

    public function revenue_collection_chart(Request $request){
        $year   = $request->year ?? date('Y'); 

        $json = array();

        $month_name = [
            '1' => 'Jan',
            '2' => 'Feb',
            '3' => 'Mar',
            '4' => 'Apr',
            '5' => 'May',
            '6' => 'Jun',
            '7' => 'Jul',
            '8' => 'Aug',
            '9' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec'
        ];
        for($month = 1; $month <= 12; $month++){
            $result = Project
            ::selectRaw('sum(total_amount) as po_value')
            ->selectRaw('count(*) as po_received')
            ->selectRaw('sum(total_amount) - sum( (now() > `advance_receive_date`) * advance_amount) as pending_amount')
            ->selectRaw('sum( (now() > `advance_receive_date`) * advance_amount) as received_amount')
            ->where('status','=',1)
            ->whereRaw("month(agreement_date) = {$month} AND year(agreement_date) = {$year} ")
            ->get();
            foreach ($result as $object) {
                $data_array['po_value'] = $object->po_value;
                $data_array['po_received'] = $object->po_received;
                $data_array['pending_amount'] = $object->pending_amount;
                $data_array['received_amount'] = $object->received_amount;
                $data_array['month'] = $month_name[$month];
                $json[] = $data_array;
            }
        }
        
        return ($json);
    }

    /* Client and BIN chart */

    public function client_chart(Request $request){
        $year   = $request->year ?? date('Y'); 

        $json = array();
        
        $month_name = [
            '1' => 'Jan',
            '2' => 'Feb',
            '3' => 'Mar',
            '4' => 'Apr',
            '5' => 'May',
            '6' => 'Jun',
            '7' => 'Jul',
            '8' => 'Aug',
            '9' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec'
        ];
        for($month = 1; $month <= 12; $month++){
            $date['start'] = "{$year}-{$month}-01";
            $date['end'] = "{$year}-{$month}-31";
            $result = Project
            ::selectRaw('count(*) as total_po')
            ->selectRaw('sum(unit) as total_bin')
            ->where('status','=',1)
            ->whereBetween("agreement_date",$date)
            ->get();
            foreach ($result as $object) {
                $data_array['total_po']     = $object->total_po ?? 0;
                $data_array['total_bin']    = $object->total_bin ?? 0;
                $data_array['month']        = $month_name[$month];
                $json[]                     = $data_array;
            }
        }
        return ($json);
    }
    /* Service charge summary */
    public function service_charge(){
        $date_range         = [date('Y-m-').'01', date('Y-m-').'31'];
        ## Total MMC 
        $mmc_total          = ServiceCharge::selectRaw('count(*) as counter')
                            ->whereBetween('status',[1,2])
                            ->get()
                            ->toArray()[0];
        $result['mmc_total'] = $mmc_total['counter'];

        ## Total MMC Value

        $mmc_value_monthly  = ServiceCharge::selectRaw('sum(amount) as amount')
                            ->whereBetween('status',[1,2])
                            ->where('pay_schedule',1)
                            ->get()
                            ->toArray()[0]['amount'];
        $mmc_value_yearly   = ServiceCharge::selectRaw('sum(amount) as amount')
                            ->whereBetween('status',[1,2])
                            ->where('pay_schedule',3)
                            ->get()
                            ->toArray()[0]['amount'];
        $mmc_value_quarterly= ServiceCharge::selectRaw('sum(amount) as amount')
                            ->whereBetween('status',[1,2])
                            ->where('pay_schedule',2)
                            ->get()
                            ->toArray()[0]['amount'];                            

        $result['mmc_total_value'] = ($mmc_value_yearly / 12) + ($mmc_value_quarterly / 3) + $mmc_value_monthly ;

        ## MMC Applicable current month

        $mmc_applicable     = ServiceCharge::selectRaw('count(*) as counter')
                            ->where('status',1)
                            ->where('start_date','<=',date('Y-m-').'31')
                            ->get()
                            ->toArray()[0];
        $result['mmc_applicable_current'] = $mmc_applicable['counter'];

        ## MMC Applicable Value current month

        $mmc_value_monthly  = ServiceCharge::selectRaw('sum(amount) as amount')
                            ->where('status',1)
                            ->where('pay_schedule',1)
                            ->where('start_date','<=',date('Y-m-').'31')
                            ->get()
                            ->toArray()[0]['amount'] ?? 0;
        $mmc_value_quarterly= ServiceCharge::selectRaw('sum(amount) as amount')
                            ->where('status',1)
                            ->where('pay_schedule',2)
                            ->where('start_date','<=',date('Y-m-').'31')
                            ->get()
                            ->toArray()[0]['amount'] ?? 0;  
        $mmc_value_yearly   = ServiceCharge::selectRaw('sum(amount) as amount')
                            ->where('status',1)
                            ->where('pay_schedule',3)
                            ->where('start_date','<=',date('Y-m-').'31')
                            ->get()
                            ->toArray()[0]['amount'] ?? 0;                          

        $result['mmc_value_current'] = ($mmc_value_yearly / 12) + ($mmc_value_quarterly / 3) + $mmc_value_monthly ;     

        ## MMC collection current month
        $mmc_received_current   = Collection::with('project.service_charge')
                                ->where('collection_type',3)
                                ->whereBetween('collection_date',$date_range)
                                ->get();

        $mmc_received_current_monthly = $mmc_received_current->where('project.service_charge.pay_schedule',1)->sum('project.service_charge.amount');
        $mmc_received_current_yearly = $mmc_received_current->where('project.service_charge.pay_schedule',3)->sum('project.service_charge.amount');
        $mmc_received_current = $mmc_received_current_monthly + ($mmc_received_current_yearly/12);
        

        $result['mmc_received_current'] = $mmc_received_current ?? 0;
        $result['mmc_pending_current'] = $result['mmc_value_current'] - ($mmc_received_current ?? 0);
        
        return view('backend.pages.dashboard.ajax.service_charge_ajax',$result);
    }

    /* Received Amount Summary */
    public function accumulated_revenue(){
        $result = [];
        $sum = 0;
        $collection_ob = new Collection();
        $collection    = Collection
                    ::selectRaw('sum(amount) as collection, collection_type')
                    ->groupBy('collection_type')
                    ->orderBy('collection_type', 'desc')
                    ->get()
                    ->toArray();
        foreach ($collection as $key => $row) {
            $collection_type = str_replace(' ','_',strtolower($collection_ob->collection_type()[$row['collection_type']]));
            $result[$collection_type] = $row['collection'];
            $sum += $row['collection'];
        }

        $result['total_amount'] = $sum;
        // dd($result);
        return view('backend.pages.dashboard.ajax.summary2_ajax',$result);
    }
}
