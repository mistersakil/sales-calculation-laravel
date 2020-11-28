<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Datatables;

class Project extends MyModel
{
    protected $table = 'projects';

    ## Dynamic data for HTML ##

    public function set_vat_type(){
    	return $vat_type = [
    		'1' => 'Inclusive',
    		'2' => 'Exclusive'
    	];
    }
    public function get_vat_type(){
        return $this->set_vat_type();
    }
    ## Get all by AJAX request ##
    ## Get all by AJAX request ##

    public static function all_by_ajax($request){
        $progress_type = $request->progress_type ?? null;
        if ($request->ajax()) {
            $query = Project::with('client','product','collections','file')->get();
            if(isset($progress_type)){
                $query = $query->where('progress',$progress_type);
            }
            if( auth()->user()->can('edit', Project::class)  && auth()->user()->can('delete', Project::class) ){
                return Datatables::of($query)
                ->addColumn('name', function($model) {
                    $result = '';
                    $result .=  $model->client ? '<strong>Client:</strong> '.$model->client->name.'<br>' : '';
                    $result .=  $model->product ? '<strong>Product:</strong> '.$model->product->name.'<br>' : '';
                    $result .= '<strong>BIN:</strong>  <span class="badge">'.$model->unit.'</span><br>';                    
                    $result .= '<strong>P.O date:</strong> '.$model->agreement_date.'<br>';
                    return $result;
                })
                ->editColumn('advance_amount', function($model) {
                    $total_amount = $model->total_amount;
                    $advance_amount = $model->advance_amount;
                    $pending_amount = $total_amount - $advance_amount;
                    $advance_percentage = $total_amount 
                                        ? number_format(((100 * $advance_amount)/ $total_amount),0)
                                        : 0;
                    $result = '<strong>P.O value:</strong> <span class="label label-primary">'.number_format($total_amount) . '</span><br>';
                    $result .= '<strong>Advance:</strong> '.number_format($advance_amount) . ' ('.$advance_percentage.'%)<br>';
                    $result .= '<strong>Pending on PO:</strong> '.number_format($pending_amount).'<br>';
                    $result .= '<strong>Total Collection:</strong> '.number_format($model->collections()->selectRaw('sum(amount) as total_collection')->get()->toArray()[0]['total_collection']);
                    
                    return $result;
                })
                
                ->editColumn('status', function($model) {
                    $result = '<strong>Progress status:</strong> '.$model->custom_progress()[$model->progress].'<br>';
                    $result .= '<strong>Vat type:</strong> '.$model->get_vat_type()[$model->vat_type].'<br>';
                    $result .= $model->status == 1 
                            ? '<strong>Status:</strong> <span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
                            : '<strong>Status:</strong> <span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
                    $result .= '<br><strong>Last Modified:</strong> '.$model->updated_at->diffForHumans();                            
                    return $result ?? '';
                })
                ->addColumn('action',function($model){
                    $result = '';
                    $result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
                    $result  .= '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';
                    $result .= '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-xs btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';

                    if($model->file['file']){
                        $result .= '<br><img src="'.url('/').'/public/files/'.$model->file['file'].'" alt="P.O Scaned File" width="80" height="50"/>';
                    }

                    return $result;

                })
                
                ->rawColumns(['action','advance_amount','name','agreement_date','status'])
                ->make(true);
            }elseif( auth()->user()->can('edit', Project::class) ){
                return Datatables::of($query)
                ->addColumn('name', function($model) {
                    $result = '';
                    $result .=  $model->client ? '<strong>Client:</strong> '.$model->client->name.'<br>' : '';
                    $result .=  $model->product ? '<strong>Product:</strong> '.$model->product->name.'<br>' : '';
                    $result .= '<strong>BIN:</strong>  <span class="badge">'.$model->unit.'</span><br>';                    
                    $result .= '<strong>P.O date:</strong> '.$model->agreement_date.'<br>';
                    return $result;
                })
                ->editColumn('advance_amount', function($model) {
                    $total_amount = $model->total_amount;
                    $advance_amount = $model->advance_amount;
                    $pending_amount = $total_amount - $advance_amount;
                    $advance_percentage = $total_amount 
                                        ? number_format(((100 * $advance_amount)/ $total_amount),0)
                                        : 0;
                    $result = '<strong>P.O value:</strong> <span class="label label-primary">'.number_format($total_amount) . '</span><br>';
                    $result .= '<strong>Advance:</strong> '.number_format($advance_amount) . ' ('.$advance_percentage.'%)<br>';
                    $result .= '<strong>Pending on PO:</strong> '.number_format($pending_amount).'<br>';
                    $result .= '<strong>Total Collection:</strong> '.number_format($model->collections()->selectRaw('sum(amount) as total_collection')->get()->toArray()[0]['total_collection']);
                    
                    return $result;
                })
                
                ->editColumn('status', function($model) {
                    $result = '<strong>Progress status:</strong> '.$model->custom_progress()[$model->progress].'<br>';
                    $result .= '<strong>Vat type:</strong> '.$model->get_vat_type()[$model->vat_type].'<br>';
                    $result .= $model->status == 1 
                            ? '<strong>Status:</strong> <span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
                            : '<strong>Status:</strong> <span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
                    $result .= '<br><strong>Last Modified:</strong> '.$model->updated_at->diffForHumans();                            
                    return $result ?? '';
                })
                ->addColumn('action',function($model){
                    $result = '';
                    $result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
                    $result  .= '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';
                    if($model->file['file']){
                        $result .= '<br><img src="'.url('/').'/public/files/'.$model->file['file'].'" alt="P.O Scaned File" width="80" height="50"/>';
                    }

                    return $result;

                })
                
                ->rawColumns(['action','advance_amount','name','agreement_date','status'])
                ->make(true);

            }elseif( auth()->user()->can('delete', Project::class) ){
                return Datatables::of($query)
                ->addColumn('name', function($model) {
                    $result = '';
                    $result .=  $model->client ? '<strong>Client:</strong> '.$model->client->name.'<br>' : '';
                    $result .=  $model->product ? '<strong>Product:</strong> '.$model->product->name.'<br>' : '';
                    $result .= '<strong>BIN:</strong>  <span class="badge">'.$model->unit.'</span><br>';                    
                    $result .= '<strong>P.O date:</strong> '.$model->agreement_date.'<br>';
                    return $result;
                })
                ->editColumn('advance_amount', function($model) {
                    $total_amount = $model->total_amount;
                    $advance_amount = $model->advance_amount;
                    $pending_amount = $total_amount - $advance_amount;
                    $advance_percentage = $total_amount 
                                        ? number_format(((100 * $advance_amount)/ $total_amount),0)
                                        : 0;
                    $result = '<strong>P.O value:</strong> <span class="label label-primary">'.number_format($total_amount) . '</span><br>';
                    $result .= '<strong>Advance:</strong> '.number_format($advance_amount) . ' ('.$advance_percentage.'%)<br>';
                    $result .= '<strong>Pending on PO:</strong> '.number_format($pending_amount).'<br>';
                    $result .= '<strong>Total Collection:</strong> '.number_format($model->collections()->selectRaw('sum(amount) as total_collection')->get()->toArray()[0]['total_collection']);
                    
                    return $result;
                })
                
                ->editColumn('status', function($model) {
                    $result = '<strong>Progress status:</strong> '.$model->custom_progress()[$model->progress].'<br>';
                    $result .= '<strong>Vat type:</strong> '.$model->get_vat_type()[$model->vat_type].'<br>';
                    $result .= $model->status == 1 
                            ? '<strong>Status:</strong> <span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
                            : '<strong>Status:</strong> <span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
                    $result .= '<br><strong>Last Modified:</strong> '.$model->updated_at->diffForHumans();                            
                    return $result ?? '';
                })
                ->addColumn('action',function($model){
                    $result = '';
                    $result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
                    
                    $result .= '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-xs btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';
                    if($model->file['file']){
                        $result .= '<br><img src="'.url('/').'/public/files/'.$model->file['file'].'" alt="P.O Scaned File" width="80" height="50"/>';
                    }

                    return $result;

                })
                
                ->rawColumns(['action','advance_amount','name','agreement_date','status'])
                ->make(true);

            }else{
                return Datatables::of($query)
                ->addColumn('name', function($model) {
                    $result = '';
                    $result .=  $model->client ? '<strong>Client:</strong> '.$model->client->name.'<br>' : '';
                    $result .=  $model->product ? '<strong>Product:</strong> '.$model->product->name.'<br>' : '';
                    $result .= '<strong>BIN:</strong>  <span class="badge">'.$model->unit.'</span><br>';                    
                    $result .= '<strong>P.O date:</strong> '.$model->agreement_date.'<br>';
                    return $result;
                })
                ->editColumn('advance_amount', function($model) {
                    $total_amount = $model->total_amount;
                    $advance_amount = $model->advance_amount;
                    $pending_amount = $total_amount - $advance_amount;
                    $advance_percentage = $total_amount 
                                        ? number_format(((100 * $advance_amount)/ $total_amount),0)
                                        : 0;
                    $result = '<strong>P.O value:</strong> <span class="label label-primary">'.number_format($total_amount) . '</span><br>';
                    $result .= '<strong>Advance:</strong> '.number_format($advance_amount) . ' ('.$advance_percentage.'%)<br>';
                    $result .= '<strong>Pending on PO:</strong> '.number_format($pending_amount).'<br>';
                    $result .= '<strong>Total Collection:</strong> '.number_format($model->collections()->selectRaw('sum(amount) as total_collection')->get()->toArray()[0]['total_collection']);
                    
                    return $result;
                })
                
                ->editColumn('status', function($model) {
                    $result = '<strong>Progress status:</strong> '.$model->custom_progress()[$model->progress].'<br>';
                    $result .= '<strong>Vat type:</strong> '.$model->get_vat_type()[$model->vat_type].'<br>';
                    $result .= $model->status == 1 
                            ? '<strong>Status:</strong> <span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
                            : '<strong>Status:</strong> <span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
                    $result .= '<br><strong>Last Modified:</strong> '.$model->updated_at->diffForHumans();                            
                    return $result ?? '';
                })
                ->addColumn('action',function($model){
                    $result = '';
                    $result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
                    if($model->file['file']){
                        $result .= '<br><img src="'.url('/').'/public/files/'.$model->file['file'].'" alt="P.O Scaned File" width="80" height="50"/>';
                    }
                    
                    return $result;

                })
                
                ->rawColumns(['action','advance_amount','name','agreement_date','status'])
                ->make(true);

            }
            
        }        

   }
    ## PO all by AJAX request ##

    public static function po_details_ajax($request){
        $date_range['date_start'] = $request->date_start;
        $date_range['date_end'] = $request->date_end;
        $query  = self::with('client','product')->whereBetween('agreement_date',$date_range)->get();;        
        return  Datatables::of($query)   
                ->editColumn('unit', function($model) {
                    return $model->unit;
                })
                ->editColumn('client_id', function($model) {
                    return $model->client->name . ' ('.$model->product->code.')';
                })
                ->editColumn('total_amount', function($model) {
                    return number_format($model->total_amount);
                })
                ->editColumn('advance_amount', function($model) {
                    $advance_collection = $model->collections()->selectRaw('sum(amount) as amount')->where('collection_type',1)->get()->toArray();
                    return number_format($advance_collection[0]['amount']);

                })
                ->editColumn('agreement_date', function($model) {
                    return date_format(date_create($model->agreement_date),'d M, Y');

                })
                ->addColumn('advance_pending', function($model) {
                    $advance_on_po = $model->advance_amount;
                    $advance_collection = $model->collections()->selectRaw('sum(amount) as amount')->where('collection_type',1)->get()->toArray();

                    return number_format($model->advance_amount - $advance_collection[0]['amount']);
                })
                ->addColumn('pending_on_po', function($model) {
                    return number_format($model->total_amount - $model->advance_amount);
                })
                ->rawColumns(['product_id'])
                ->make(true);

    }
    ## Relationship ##

    public function client(){
    	return $this->belongsTo(Client::class);
    }

    public function service_charge(){
        return $this->hasOne(ServiceCharge::class);
    }

    public function product(){
    	return $this->belongsTo(Product::class);
    }

    public function collections(){
        return $this->hasMany(Collection::class);
    }


    public function file(){
        return $this->morphOne(File::class,'fileable');
    }
    
}
