<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Requests\ProjectStoreRequest;
use App\Model\Client;
use App\Model\Product;
use App\Model\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Str;
use Datatables;

class ProjectsController extends BackendController
{
    ## List action ##
    public function index(Request $request, Project $project){

        if (auth()->user()->can('view_all', Project::class)){ 
            $result['progress_type'] = $request->progress_type ?? null;
            $result['progress_type_name'] = !empty($result['progress_type']) ? $project->custom_progress()[$request->progress_type] : '';
            return view('backend.pages.projects.index', $result);
        }else{
            return redirect()->route('admin.403');
        }
    }

    ## Create action ##
    public function create(){
        $datas = $this->default_data();
        $datas['project'] = new Project;
        return view('backend.pages.projects.create', $datas);
    }

    ## Store action ##

    public function store(ProjectStoreRequest $request, Project $model){   
        $project = Project::where([
                    'product_id' => $request->product_id,
                    'client_id' => $request->client_id,
                    ])
                    ->get();
        if(count($project)){
            return response()->json(['success' => 'false','message' => __('common.already exist with same product and client')]);  
        }

        $this->process_data($request, $model);  

        if($model->save()){
             /** Storage File **/
            if($request->hasFile('file')){
                $client = Client::findOrFail($request->client_id);
                $product = Product::findOrFail($request->product_id);
                $image_name         = $client->name.'_'.$product->code.'_po';
                $file               = $this->image_upload($request->file,$image_name,0,0,90);
                $model->file()->create(['file' => $file,'extension' => $request->file->getClientOriginalExtension()]);
            }   

            return response()->json(['success' => 'true', 'message' => __('common.Created').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
    }


    ## List display on Datatable by ajax request ##
    public function all_by_ajax(Request $request){
        if ($request->ajax()) return Project::all_by_ajax($request); 
        
    }


    public function show(){
            $project = Project::where([
                    'product_id' => 3,
                    'client_id' => 21
                    ])
                    ->get();
        dd(count($project));
        
    }

    ## Edit action ##
    public function edit(Request $request){
        $project = Project::findOrFail($request->id);
        return view('backend.pages.projects.edit', $this->default_data())->with('project',$project);
    }

    ## Update action ##
    public function update(ProjectStoreRequest $request){
        $project = Project::where([
                    'product_id'    => $request->product_id,
                    'client_id'     => $request->client_id,
                    ])
                    ->where('id', '!=' , $request->id)
                    ->get();
        if(count($project)){
            return response()->json(['success' => 'false','message' => __('common.already exist with same product and client')]);  
        }
        $model = Project::with('client','product')->findOrFail($request->id);
        $this->process_data($request, $model);

             

        if($model->save()){
            /** Storage File **/
            if($request->hasFile('file')){
                $image_name         = $model->client->name.'_'.$model->product->code.'_po';
                $file               = $this->image_upload($request->file,$image_name,0,0,90);
                if($model->file){
                    $model->file()->update(['file' => $file,'extension' => $request->file->getClientOriginalExtension()]);
                }else{
                    $model->file()->create(['file' => $file,'extension' => $request->file->getClientOriginalExtension()]);
                }
            }   
            

            return response()->json(['success' => 'true', 'message' => __('common.item updated successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
    }

    ## Delete action ##
    public function delete(Request $request){
        $id = $request->id; 
        return view('backend.pages.projects.delete',compact('id'));
    }

    ## Destroy action ##
    public function destroy(Request $request){
        $model = Project::findOrFail($request->delete_id);

        if($model){
            if($model->file){
                $file_path = public_path().'/files/'.$model->file->file;
                if (File::exists($file_path)) {
                    File::delete($file_path);
                }
            }
            $model->file()->delete();
            $model->delete();
            return response()->json(['success' => 'true','message' => __('common.item deleted successfully')]);
        }else{
            return response()->json(['success' => 'false','message' => __('common.invalid query or server error')]);
        }

    }

    ## Process data ##

    private function process_data($request, $object){
        $object->advance_amount       = $request->advance_amount ?? 0;
        $object->advance_receive_date = $request->advance_receive_date;
        $object->agreement_date       = $request->agreement_date;
        $object->client_id            = $request->client_id;
        $object->end_date             = $request->end_date;
        $object->unit                 = $request->unit;
        $object->product_id           = $request->product_id;
        $object->progress             = $request->progress;
        $object->status               = $request->status;
        $object->start_date           = $request->start_date;
        $object->total_amount         = $request->total_amount;
        $object->vat_amount           = $request->vat_amount ?? 0;
        $object->vat_type             = $request->vat_type;
        $object->user_id              = mt_rand(1,10);
    }

    ## Get single project amount ##

    public function get_amount(Request $request){
        $amount = Project::select('advance_amount')->where('id',$request->id)->first();
        if(!$amount){
            return response()->json(['success' => 'false','amount' => '']);
        }
        return response()->json(['success' => 'true','amount' => $amount->advance_amount]);

    }



    /* PO details */

    public function po_details($date_start = null, $date_end = null){
        $date['date_start'] = $date_start ?? date('Y-m-').'01';
        $date['date_end']   = $date_end ?? date('Y-m-').'31';
        return view('backend.pages.projects.po_details',$date);
    }

    ## List display on date range to Datatable by ajax request ##
    public function po_details_ajax(Request $request){
        if ($request->ajax()) return Project::po_details_ajax($request);  
    }



} 
## End of the class ##
