<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use App\Model\Permission;
use App\Model\PermissionType;
use App\Model\Role;

class PermissionTypesController extends BackendController
{
    public function __construct(){
        $this->new_model = new PermissionType();
    }
    ## List action ##
    public function index()
    {
        if (auth()->user()->can('view_all', PermissionType::class)){            
            return view('backend.pages.permission_types.index');           
        }else{
            return redirect()->route('admin.403');
        }
    }


    ## List action by ajax ##
    public function all_by_ajax(Request $request){  
        if ($request->ajax()) return $this->new_model->all_by_ajax();  
    }
    
   
    ## Delete action ##
    public function delete(Request $request){
        $data['id'] = $request->id; 
        return view('backend.pages.permission_types.delete',$data);
    }

    ## Destroy action ##
    public function destroy(Request $request){
        $model = $this->new_model->findOrFail($request->id);
        foreach ($model->permissions as $permission) {
            $permission->roles()->sync([]);
        }
        $model->permissions()->delete();

        if($model->delete()){
            return response()->json(['success' => 'true','message' => __('common.Deleted').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false','message' => __('common.invalid query or server error')]);
        }

    }
}
