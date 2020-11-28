<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\BrandStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;
use App\Model\Brand;
use Str;
use Datatables; 
use File;
class BrandController extends BackendController
{
    /* Brand list page */
    public function index()
    {
        return view('backend.pages.brand.index');
    }

    /* Brand create view on modal window*/
    public function create()
    {
        return view('backend.pages.brand.create');
    }

    /* Brand store process */

    public function store(BrandStoreRequest $request, Brand $object)
    {   
        // BrandStoreRequest

        $object->name           = $request->name;
        $object->body           = $request->body;
        $object->slug           = Str::slug($request->name);        
        $object->published      = $request->published;
        if($request->hasFile('image')){
            $image_name         = $request->name.'-'.mt_rand(100000,99999999);
            $object->image       = $this->image_upload($request->image,$image_name,[150,150],0,80);
        }        

        if($object->save()){
            return response()->json(['success' => 'true']);
        }else{
            return response()->json(['success' => 'false']);            
        }
    }


    /* Brand list display on Datatable by ajax request */
    public function all(Request $request){
        if ($request->ajax()) {
            $query = Brand::all();
            return Datatables::of($query)
                ->editColumn('id', function($model) {
                    return $model->id;
                })
                ->editColumn('name', function($model) {
                    return $model->custom_short_text($model->name,50);
                })
                ->editColumn('body', function($model) {
                    return $model->custom_short_text($model->body,150);
                })
                ->editColumn('slug', function($model) {
                    return $model->slug;
                })
                ->editColumn('image', function($model) {
                    if(isset($model->image) && !empty($model->image)){                     
                        $year = $model->custom_date_time($model->updated_at,'Y');

                        $month = $model->custom_date_time($model->updated_at,'F'); 

                        $month = strtolower($model->custom_date_time($model->updated_at,'F')); 

                        $image_url = url('public/media/'.$year.'/'.$month.'/'.$model->image);
                        return '<img src="'.$image_url.'" alt="'.$model->name.'" width="50"  title="'.$model->name.'">';  
                    }
                    else{
                         return '<img src="'.url('/public/image/default.gif').'" alt="'.$model->name.'" width="50" title="'.$model->name.'" >';
                    }
                })
                ->addColumn('action',function($model){
                    $published  = $model->published == 1 
                                ? '<a class="btn btn-default" title="'.__('common.PUBLISHED').'"><i class="fa fa-circle text-success" ></i></a>' 
                                : '<a class="btn btn-default" title="'.__('common.UNPUBLISHED').'"><i class="fa fa-circle text-danger" ></i></a>';
                    $edit  = '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-sm btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';
                    $delete = '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-sm btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';

                    return $published.' '.$edit.' '.$delete;

                })
                
                ->rawColumns(['action','name','image'])
                ->make(true);
        }
    }


    public function show(Brand $brand)
    {
        // $query = Brand::all();
        dd($brand);
        
    }


    public function edit($id)
    {
        // dd($id);
        $brand = Brand::findOrFail($id);
        return view('backend.pages.brand.edit', compact('brand'));
    }


    public function update(Request $request)
    {
        $object                 = Brand::findOrFail($request->id);
        $object->name           = $request->name;
        $object->body           = $request->body;
        $object->slug           = Str::slug($request->name);        
        $object->published      = $request->published;
        if($request->hasFile('image')){
            ## Delete current image from storage for requested brand 
            $year = $object->custom_date_time($object->updated_at,'Y');
            $month = strtolower($object->custom_date_time($object->updated_at,'F'));
            if(!empty($object->image)){
                $file_path = public_path('media/'.$year.'/'.$month.'/'.$object->image);
                if(File::exists($file_path)) File::delete($file_path);
            }
            ## Update new image for requested brand

            $image_name         = $request->name.'-'.mt_rand(100000,99999999);
            $object->image       = $this->image_upload($request->image,$image_name,[150,150],0,80);
        }        

        if($object->save()){
            return response()->json(['success' => 'true']);
        }else{
            return response()->json(['success' => 'false']);            
        }
    }

    /* Brand delete modal view */
    public function delete()
    {
        return view('backend.pages.brand.delete');
    }

    /* Brand destroy permanently */
    public function destroy(Brand $brand)    
    {
        if($brand)
        {
            if($brand->image){
                ## Delete brand image/logo if exist
                $file_path = public_path('media/'.$brand->custom_date_time($brand->created_at,'Y').'/'.$brand->custom_date_time($brand->created_at,'F').'/'.$brand->image);
                if(File::exists($file_path)) File::delete($file_path);
            }
            if($brand->delete()){
                return response()->json(['success' => 'true']);
            }else{
                return response()->json(['success' => 'false']);
            }
        }else{
            return response()->view('backend.404');
        }

    }



} /* End of the Brand class */
