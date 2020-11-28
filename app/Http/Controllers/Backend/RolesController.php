<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use App\Model\Role;
use App\Model\PermissionType;
use App\Http\Requests\RoleStoreRequest;

class RolesController extends BackendController
{
    public function __construct(){
        $this->new_model = new Role();
    }

    ## List action ##
    public function index(Request $request)
    {        
        if (auth()->user()->can('view_all', Role::class)){            
            return view('backend.pages.roles.index');           
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
        $data['permission_types'] = PermissionType::with('permissions')->where('status',1)->orderBy('name','asc')->get();
        return view('backend.pages.roles.create',$data);
    }

    ## Store action ##
    public function store(RoleStoreRequest $request)    
    {

        $this->process_data($request, $this->new_model);

        if($this->new_model->save()){
            $this->new_model->permissions()->sync($request->permission_id);
            return response()->json(['success' => 'true', 'message' => __('common.Created').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
        
    }

    ## Process data action ##

    private function process_data($request, $model){
        $model->name           = $request->name;
        $model->description    = $request->description;
        $model->status         = $request->status;
    }


    ## Edit action ##
    public function edit(Request $request)
    {
        $data['model'] = $this->new_model->findOrFail($request->id);
        $data['permission_types'] = PermissionType::with('permissions')->where('status',1)->orderBy('name','asc')->get();
        return view('backend.pages.roles.edit',$data);
    }

    ## Update action ##
    public function update(RoleStoreRequest $request)
    {
        
        $model = $this->new_model->findOrFail($request->id);
        $this->process_data($request, $model);       

        if($model->save()){
            /* Update related model */
            $model->permissions()->sync($request->permission_id);
            return response()->json(['success' => 'true', 'message' => __('common.Updated').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
    }

    ## Delete action ##
    public function delete(Request $request){
        $id = $request->id;
        return view('backend.pages.roles.delete',compact('id'));
    }

    ## Destroy action ##
    public function destroy(Request $request){
        /* Delete realated models */
        $model = $this->new_model->findOrFail($request->id);
        $model->users()->sync([]);
        $model->permissions()->sync([]);
        if($model->delete()){
            return response()->json(['success' => 'true','message' => __('common.Deleted').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false','message' => __('common.invalid query or server error')]);
        }

    }
}
