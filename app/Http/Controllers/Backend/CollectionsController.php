<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use App\Model\Collection;
use App\Model\Project;
use App\Model\Remark;
use App\Http\Requests\CollectionStoreRequest;

class CollectionsController extends BackendController
{


    ## List action ##
    public function index(Request $request)
    {
        if (auth()->user()->can('view_all', Collection::class)){            
            $result['collection_total'] = Collection::sum('amount');
            $result['collection_advance'] = Collection::where('collection_type',1)->sum('amount');
            $result['collection_postsale'] = Collection::where('collection_type',2)->sum('amount');
            $result['collection_mmc'] = Collection::where('collection_type',3)->sum('amount');
            $result['ctype'] = $request->ctype ?? 0;
            if($request->ctype){
                $result['collection_type'] = Collection::collection_type()[$request->ctype];
            }
            return view('backend.pages.collections.index',$result);
        }else{
            return redirect()->route('admin.403');
        }
    }


    ## List action by ajax ##
    public function all_by_ajax(Request $request){
        if ($request->ajax()) return Collection::all_by_ajax($request);  
    }


    
    ## Create action ##
    public function create()
    {
        return view('backend.pages.collections.create',['projects' => Project::with('product','client')->get(),'collection' => new Collection() ]);
    }

    ## Store action ##
    public function store(CollectionStoreRequest $request, Collection $object)    
    {
        
        /* MMC existing check */
        if($this->mmc_exist($request)){
            return response()->json(['success' => 'false', 'message' => __('common.Mmc').' '.__('common.Already').' '.__('common.Received')]); 
        }
        /* Processing data */
        $this->process_data($request, $object);    

        /* Save data */
        if($object->save()){
            if(!empty($request->remark)){
                $object->remark()->save(new Remark(['body' => $request->remark]));
            }

            return response()->json(['success' => 'true', 'message' => __('common.Created').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
        
    }

    ## Process data action ##

    private function process_data($request, $object){
        $object->project_id             = $request->project_id;
        $object->amount                 = $request->amount;
        $object->collection_date        = $request->collection_date ?? date('Y-m-d');
        $object->collection_type        = $request->collection_type;
    }


    ## MMC Exist action ##

    private function mmc_exist($request){
        $collection_month = date_format(date_create($request->collection_date),'m');
        /* MMC Collectoin existance checking */
        $mmc_collection_exist = Collection
                                ::where(['project_id' => $request->project_id, 'collection_type' => 3])
                                ->whereBetween('collection_date',[date("Y-$collection_month-").'01',date("Y-$collection_month-").'31'])
                                ->count();
        if($request->id){
            $mmc_collection_exist = Collection
                                ::where(['project_id' => $request->project_id, 'collection_type' => 3])
                                ->where('id','!=',$request->id)
                                ->whereBetween('collection_date',[date("Y-$collection_month-").'01',date("Y-$collection_month-").'31'])
                                ->count();
        }
        return $mmc_collection_exist ? true : false;
    }

    
    ## Show action ##
    
    public function show($id)
    {
        //
    }

    ## Edit action ##
    public function edit(Request $request)
    {
        $collection = Collection::findOrFail($request->id);
        $projects = Project::with('product','client')->get();
        return view('backend.pages.collections.edit',['collection' => $collection,'project' => $projects]);
    }

    ## Update action ##
    public function update(CollectionStoreRequest $request)
    {
        
        $object = Collection::findOrFail($request->id);
        /* MMC existing check */
        if($this->mmc_exist($request)){
            return response()->json(['success' => 'false', 'message' => __('common.Mmc').' '.__('common.Already').' '.__('common.Received')]); 
        }
        $this->process_data($request, $object);       

        if($object->save()){
            /* Update remark */
            if(!empty($request->remark)){
                $object->remark()->update(['body' => $request->remark]);
            }
            return response()->json(['success' => 'true', 'message' => __('common.Updated').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
    }

    ## Delete action ##
    public function delete(Request $request){
        $id = $request->id; 
        return view('backend.pages.collections.delete',compact('id'));
    }

    ## Destroy action ##
    public function destroy(Request $request){
        Collection::find($request->id)->remark()->delete();
        if(Collection::destroy($request->id)){
            return response()->json(['success' => 'true','message' => __('common.Deleted').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false','message' => __('common.invalid query or server error')]);
        }

    }

    ## Collection pending action ##
    public function pending(){
        $projects = Project::with('collections','client','product')->where('status',1)->get();
        return view('backend.pages.collections.pending',compact('projects'));
    }

    ## Collection collect action ##
    public function collect(Request $request){
        return view('backend.pages.collections.collect',$request->all());
    }

}
