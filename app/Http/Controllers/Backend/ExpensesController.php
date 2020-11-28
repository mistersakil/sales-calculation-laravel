<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use App\Model\Expense;

class ExpensesController extends BackendController
{


    ## List action ##
    public function index(Request $request)
    {
        if (auth()->user()->can('view_all', Expense::class)){            
            return view('backend.pages.expenses.index');           
        }else{
            return redirect()->route('admin.403');
        }
    }


    ## List action by ajax ##
    public function all_by_ajax(Request $request){
        if ($request->ajax()) return Expense::all_by_ajax($request);  
    }


    
    ## Create action ##
    public function create()
    {

        return view('backend.pages.expenses.create',['model' => new Expense]);
    }

    ## Store action ##
    public function store(Request $request, Expense $object)    
    {
        
        $json_array = $request->json()->all();

        if($request->acceptsJson()){
            foreach ($json_array as $value) {

                $object                 = new Expense();
                $object->title          = $value['title'];
                $object->type           = $value['type'];
                $object->amount         = $value['amount'];
                $object->date           = $value['date'];
                $object->status         = $value['status'];
                $object->save();

            }
            return response()->json(['success' => 'true', 'message' => __('common.Created').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
        
    }

    ## Edit action ##
    public function edit(Request $request)
    {
        return view('backend.pages.expenses.edit',['model' => Expense::findOrFail($request->id)]);
    }

    ## Update action ##
    public function update(Request $request)
    {
        $object                 = Expense::findOrFail($request->id);        
        $object->title          = $request['title'];
        $object->type           = $request['type'];
        $object->amount         = $request['amount'];
        $object->date           = $request['date'];
        $object->status         = $request['status'];

        if($object->save()){
            return response()->json(['success' => 'true', 'message' => __('common.Updated').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
    }

    ## Delete action ##
    public function delete(Request $request){
        $id = $request->id; 
        return view('backend.pages.expenses.delete',compact('id'));
    }

    ## Destroy action ##
    public function destroy(Request $request){
        if(Expense::destroy($request->id)){
            return response()->json(['success' => 'true','message' => __('common.Deleted').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false','message' => __('common.invalid query or server error')]);
        }

    }

    

}
