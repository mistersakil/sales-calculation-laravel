<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Role;

class UsersController extends BackendController
{    
    public function __construct(){
        $this->new_model = new User();
    }

    ## List action ##
    public function index()
    {
            return view('backend.pages.users.index');
        if (auth()->user()->can('view_all', User::class)){
        }else{
            return redirect()->route('admin.403');
        }
        
    }


    ## List action by ajax ##
    public function all_by_ajax(Request $request){  
        if ($request->ajax()) return User::all_by_ajax();  
    }
    

    ## Create action ##
    public function create()
    {
        return view('backend.pages.users.create',['model' => new User(), 'roles' => Role::where('status',1)->orderBy('name','asc')->get()]);
    }



    ## Store action ##
    public function store(Request $request, User $object)    
    {
        $this->validate($request,[
            'name'      => 'required|max:100',
            'email'     => 'required|unique:users|email|max:100',
            'password'  => 'required|max:30|min:5',
            'role'      => 'required|array|min:1',
        ]);

        $object->name             = $request->name;
        $object->email            = $request->email;
        $object->password         = bcrypt($request->password);  
        $object->status           = $request->status;  
        $role                     = $request->role;  

        if($object->save()){
            $object->roles()->sync($role);
            return response()->json(['success' => 'true', 'message' => __('common.Created').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
        
    }

  
    ## Edit action ##
    public function edit(Request $request)
    {
        $data['model'] = User::with('roles')->where('id',$request->id)->first();
        $data['roles'] = Role::where('status',1)->orderBy('name','asc')->get();

        return view('backend.pages.users.edit',$data);
    }

    ## Update action ##
    public function update(Request $request)
    {
        $this->validate($request,[
            'name'      => 'required|max:100',
            'email'     => 'required|email|max:100|unique:users,email,'.$request->id,
            'password'  => !empty($request->password) ? 'max:30|min:5' : '',
            'role'      => 'required|array|min:1',
        ]);
        $object                   = User::findOrFail($request->id);
        $object->name             = $request->name;
        $object->email            = $request->email;
        $object->password         = bcrypt($request->password);  
        $object->status           = $request->status;  
        $role                     = $request->role;  

        if($object->save()){
            $object->roles()->sync($role);
            return response()->json(['success' => 'true', 'message' => __('common.Updated').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
    }
   
    ## Delete action ##
    public function delete(Request $request){
        $data['id'] = $request->id; 
        return view('backend.pages.users.delete',$data);
    }

    ## Destroy action ##
    public function destroy(Request $request){
        $user = User::findOrFail($request->id);
        /* Delete realated roles */
        $user->roles()->sync([]);
        if($user->delete()){
            return response()->json(['success' => 'true','message' => __('common.Deleted').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false','message' => __('common.invalid query or server error')]);
        }

    }
}
