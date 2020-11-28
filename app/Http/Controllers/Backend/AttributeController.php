<?php

namespace App\Http\Controllers\Backend;

use App\Model\Attribute;
use App\Model\AttributeValue;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;
use App\Http\Requests\AttributeStoreRequest;
use Arr;
use Datatables;
class AttributeController extends BackendController
{

    public function index()
    {
        return view('backend.pages.attribute.index');
    }

    /* Attribute create */
    public function create()
    {
        return view('backend.pages.attribute.create');
    }

    /* Attribute store */
    public function store(AttributeStoreRequest $request)
    {
        // AttributeStoreRequest
        return response()->json($request->all());
        return response()->json(['success' => 'sakil']);
        dd($request->all());
        $attribute = Attribute::create(['name' => $request->name]);
        if($attribute){
            $this->store_attribute_values($attribute->id, $request->attribute_values);
            return redirect()->back()->with('alert_message',__('common.SUCCESS'));
        }else{
            return redirect()->back()->with('alert_message',__('common.FAILED'));            
        }
        
    }

    public function store_attribute_values(int $attribute_id, string $attribute_values)
    {
        $values = explode(',', trim($attribute_values));
        $filtered_value_arr = $this->custom_array_filter($values);
        array_walk($filtered_value_arr, function(&$value){
            $value = ucfirst(trim($value));
        });
        $filtered_value_arr = Arr::sort(array_unique($filtered_value_arr));
        $filtered_value_arr =  $this->custom_array_filter($filtered_value_arr);

        if(count($filtered_value_arr)){
            foreach ($filtered_value_arr as $value) {
                AttributeValue::create(['attribute_id' => $attribute_id, 'name' => $value]);
            }
        }

    }

    /* List Dispaly From AJAX Request */

    public function all(Request $request)
    {
        
        if ($request->ajax()) {
            $query = Attribute::with('values')->withCount('values')->get();
            return Datatables::of($query)
                ->editColumn('id', function($model) {
                    return $model->id;
                })
                ->editColumn('name', function($model) {
                    return '<span title="'.ucfirst($model->name).'">'.$model->custom_short_text($model->name,50).' </span>'. '<span class="label label-info">'.$model->values_count.'</span>';
                })
                ->addColumn('values', function($model) {
                    $attribute_values = '';
                    foreach ($model->values as $value) {
                        $attribute_values .= $value->name.', ';
                    }
                    $end = strripos($attribute_values, ',');
                    return substr($attribute_values, 0, $end);
                    
                })
                ->addColumn('action',function($model){
                    $published  = $model->published == 1 
                                ? '<a class="btn btn-default" title="'.__('common.PUBLISHED').'"><i class="fa fa-circle text-success" ></i></a>' 
                                : '<a class="btn btn-default" title="'.__('common.UNPUBLISHED').'"><i class="fa fa-circle text-danger" ></i></a>';
                    $edit = '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-sm" href="'.$model->edit($model->id).'"><i class="fa fa-pencil" title="'.__('common.EDIT').'"></i></a>';
                    $delete = '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-sm"  onclick="set_link($(this))" data-toggle="modal" data-target="#delete_model" data-id="'.$model->id.'"><i class="fa fa-trash" title="'.__('common.DELETE').'"></i></a>';

                    return $published.' '.$edit.' '.$delete;

                })
                
                ->rawColumns(['action','name'])
                ->make(true);
        }
    }

   
    public function show(Attribute $attribute)
    {
        $query = Attribute::with('values')->get();
        
        dd($query);
    }

   
    public function edit(Attribute $attribute)
    {
        //
    }


    public function update(Request $request, Attribute $attribute)
    {
        //
    }


    public function destroy(Attribute $attribute)
    {
        //
    }
}
