<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;
use App\Model\Product;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Support\Str;

class ProductsController extends BackendController{
  
    public function __construct(){
        $this->new_model = new Product();
    }

    ## List action ##
    public function index(Request $request)
    {        
        if (auth()->user()->can('view_all', $this->new_model)){            
            return view('backend.pages.products.index');           
        }else{
            return redirect()->route('admin.403');
        }

    }


    ## List action by ajax ##
    public function all_by_ajax(Request $request){
        if ($request->ajax()) return $this->new_model->all_by_ajax();  
    }

    
    ## Create action ##
    public function create()
    {
        $data['model'] = $this->new_model;
        return view('backend.pages.products.create',$data);
    }

    ## Store action ##
    public function store(ProductStoreRequest $request)    
    {

        $this->process_data($request, $this->new_model);

        if($this->new_model->save()){
            return response()->json(['success' => 'true', 'message' => __('common.Created').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
        
    }

    ## Process data action ##

    private function process_data($request, $model){
        $model->name           = $request->name;
        $model->code           = $request->code;
        $model->description    = $request->description;
        $model->status         = $request->status;
        $model->platform_id    = $request->platform_id;
    }


    ## Edit action ##
    public function edit(Request $request)
    {
        $data['model'] = $this->new_model->findOrFail($request->id);
        return view('backend.pages.products.edit',$data);
    }

    ## Update action ##
    public function update(ProductStoreRequest $request)
    {
        
        $model = $this->new_model->findOrFail($request->id);
        $this->process_data($request, $model);       

        if($model->save()){
            return response()->json(['success' => 'true', 'message' => __('common.Updated').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
    }

    ## Delete action ##
    public function delete(Request $request){
        $id = $request->id;
        return view('backend.pages.products.delete',compact('id'));
    }

    ## Destroy action ##
    public function destroy(Request $request){
        /* Delete realated models */
        $model = $this->new_model->findOrFail($request->id);
     
        if($model->delete()){
            return response()->json(['success' => 'true','message' => __('common.Deleted').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false','message' => __('common.invalid query or server error')]);
        }

    }
}
