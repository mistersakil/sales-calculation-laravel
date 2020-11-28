<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use App\Model\Permission;
use App\Model\PermissionType;
use App\Model\Role;
use App\Services\RouteService;
class PermissionsController extends BackendController
{
    public function __construct(){
        $this->new_model = new Permission();           
                
    }
    ## List action ##
    public function index()
    {
        if (auth()->user()->can('view_all', Permission::class)){            
           return view('backend.pages.permissions.index');        
        }else{
            return redirect()->route('admin.403');
        }
    }


    ## List action by ajax ##
    public function all_by_ajax(Request $request){  
        if ($request->ajax()) return $this->new_model->all_by_ajax();  
    }
    

    ## Generate action by ajax ##
    public function generate(RouteService $routes)
    {
        return view('backend.pages.permissions.generate',['permission_types' => collect($routes->route_list())]);
    }

    ## Generating action ##
    public function generating(RouteService $routes)
    {
        $route_list = $routes->route_list();
        $created = [];
        $not_create = [];
        foreach ($route_list as $permission_type => $permissions) {
            $type_duplicate = PermissionType::where('name', $permission_type)->first();
            if($type_duplicate){
                $not_create[] = $permission_type;
                foreach ($permissions as $permission) {   
                    $permission_duplicate = Permission::where(['name' => $permission, 'permission_type_id' => $type_duplicate->id])->first();
                    if($permission_duplicate == null){
                        Permission::create(['name' => $permission, 'permission_type_id' => $type_duplicate->id, 'status' => 1]);
                    }
                    
                }
            }else{
                $p_type = PermissionType::create(['name' => $permission_type]);
                foreach ($permissions as $permission) {   
                    Permission::create(['name' => $permission, 'permission_type_id' => $p_type->id, 'status' => 1]);
                }
            }
        }       
        return response()->json(['success' => 'true', 'message' => __('common.Generate').' '.__('common.Successfully')]);        
    }

    ## Create action ##
    public function create()
    {
        return view('backend.pages.permissions.create',['model' => $this->new_model, 'permission_types' => PermissionType::where('status',1)->orderBy('name','asc')->get()]);
    }



    ## Store action ##
    public function store(Request $request)    
    {
        /* Check duplication */
        $duplicate = $this->new_model->where(['name' => $request->name, 'permission_type_id' => $request->permission_type_id])->get();
        if(count($duplicate)){
            return response()->json(['success' => 'false', 'message' => __('common.Already').' '.__('common.Exist')]);
        }
        /* Validation incoming data */
        $validattion_msg = [
            'name.required' => __('common.Permission').' '.__('common.Name').' '.__('common.Required'),
            'permission_type_id.required' => __('common.Permission').' '.__('common.For').' '.__('common.Required'),
        ];
        $this->validate($request,[
            'name'                  => 'required|max:100',
            'permission_type_id'    => 'required',
        ],$validattion_msg);
        
        /* Save data */
        $this->new_model->name               = $request->name;
        $this->new_model->permission_type_id = $request->permission_type_id;
        $this->new_model->status             = $request->status;  

        if($this->new_model->save()){
            return response()->json(['success' => 'true', 'message' => __('common.Created').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
        
    }

  
    ## Edit action ##
    public function edit(Request $request)
    {
        $data['model'] = $this->new_model->where('id',$request->id)->first();
        $data['permission_types'] = PermissionType::where('status',1)->orderBy('name','asc')->get();
        return view('backend.pages.permissions.edit',$data);
    }

    ## Update action ##
    public function update(Request $request)
    {
        /* Check duplication */
        $duplicate = $this->new_model->where(['name' => $request->name, 'permission_type_id' => $request->permission_type_id])->where('id','!=',$request->id)->get();
        if(count($duplicate)){
            return response()->json(['success' => 'false', 'message' => __('common.Already').' '.__('common.Exist')]);
        }
        /* Validation incoming data */
        $validattion_msg = [
            'name.required' => __('common.Permission').' '.__('common.Name').' '.__('common.Required'),
            'permission_type_id.required' => __('common.Permission').' '.__('common.For').' '.__('common.Required'),
        ];
        $this->validate($request,[
            'name'                  => 'required|max:100',
            'permission_type_id'    => 'required',
        ],$validattion_msg);

        /* Save data */
        $this->new_model                     = $this->new_model->findOrFail($request->id);
        $this->new_model->name               = $request->name;
        $this->new_model->permission_type_id = $request->permission_type_id;
        $this->new_model->status             = $request->status; 

        if($this->new_model->save()){
            return response()->json(['success' => 'true', 'message' => __('common.Updated').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
    }
   
    ## Delete action ##
    public function delete(Request $request){
        $data['id'] = $request->id; 
        return view('backend.pages.permissions.delete',$data);
    }

    ## Destroy action ##
    public function destroy(Request $request){
        $model = $this->new_model->findOrFail($request->id);
        $model->roles()->sync([]);
        if($model->delete()){
            return response()->json(['success' => 'true','message' => __('common.Deleted').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false','message' => __('common.invalid query or server error')]);
        }

    }
}
