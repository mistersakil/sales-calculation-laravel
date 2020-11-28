<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;
use App\Model\Client;
use App\Http\Requests\ClientStoreRequest;
class ClientsController extends BackendController
{    
    ## List action ##
    public function index()
    {
        if (auth()->user()->can('view_all', Client::class)){
            return view('backend.pages.clients.index');
        }else{
            return redirect()->route('admin.403');
        }
    }

    ## List action by ajax ##
    public function all_by_ajax(Request $request){  
        if ($request->ajax()) return Client::all_by_ajax();        
    }
    
    ## Create action ##

    public function create()
    {
        return view('backend.pages.clients.create',$this->default_data())->with('client',new Client());
    }

    ## Store action ##
    public function store(ClientStoreRequest $request, Client $object)
    {
        $client = Client::where(['name' => $request->name, 'country_id' => $request->country_id])->get();
        if(count($client)){
            return response()->json(['success' => 'false','message' => __('common.client').' '.__('common.name').' '.__('common.exist')]);  
        }

        $this->process_data($request, $object);     

        if($object->save()){
            return response()->json(['success' => 'true', 'message' => __('common.Created').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
    }


    ## Process data action ##

    private function process_data($request, $object){
        $object->name                           = $request->name;         
        $object->contact_person                 = $request->contact_person;         
        $object->country_id                     = $request->country_id;         
        $object->status                         = $request->status;         
        $object->address                        = $request->address;         
        $object->email                          = $request->email;         
        $object->phone                          = $request->phone;         
        $object->website                        = $request->website; 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $result['model'] = Client::with('projects','projects.collections','projects.product')->findOrFail($request->id);
        // return($result['model']->projects->collections->count());
        return view('backend.pages.clients.show',$result);
    }

 
    ## Edit action ##
    public function edit(Request $request)
    {
        $client = Client::findOrFail($request->id);
        if (auth()->user()->can('edit', $client)){
            return view('backend.pages.clients.edit',$this->default_data())->with('client',$client);
        }else{
            return redirect()->route('admin.403');
        }
        
    }

    ## Update action ##
    public function update(ClientStoreRequest $request)
    {
        
        $object = Client::findOrFail($request->id);
        $this->process_data($request, $object);       

        if($object->save()){
            return response()->json(['success' => 'true', 'message' => __('common.Updated').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false', 'message' => __('common.invalid query or server error')]);            
        }
    }

    ## Delete action ##
    public function delete(Request $request){
        $id = $request->id; 
        return view('backend.pages.clients.delete',compact('id'));
    }

    ## Destroy action ##
    public function destroy(Request $request){
        if(Client::destroy($request->id)){
            return response()->json(['success' => 'true','message' => __('common.Deleted').' '.__('common.Successfully')]);
        }else{
            return response()->json(['success' => 'false','message' => __('common.invalid query or server error')]);
        }

    }


}
