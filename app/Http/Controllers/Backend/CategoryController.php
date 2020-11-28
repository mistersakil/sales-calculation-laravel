<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Backend\ProductController;
use App\Model\Category;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Datatables;
use Str;
use File;

class CategoryController extends BackendController
{

    public function index()
    {
        $cat = Category::with('parent_category')->orderBy('id','asc')->get();
        return view('backend.pages.category.index');
    }


    public function create()
    {
        $categories = Category::where('parent_id',0)->get();
        return view('backend.pages.category.create',compact('categories'));
    }


    public function store(CategoryStoreRequest $request, Category $object)
    {

        $object->name       = $request->name;
        $object->body       = $request->body;
        $object->parent_id  = $request->parent_id;
        $object->published  = $request->published;
        $object->slug       = Str::slug($request->name);        

        if($request->hasFile('image')){
            $image_name     = $request->name.'-'.mt_rand(100000,999999);
            $object->image  = $this->image_upload($request->file('image'),$image_name,0, [1920,320],80);
        }        

        if($object->save()){
            session(['last_insert_id' => $object->id]);
            return redirect()->back()->with('alert_message',__('common.SUCCESS'));
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $category = Category::withCount('sub_categories')->find($id);
        if($category){
            $categories = Category::where(['parent_id' => null, 'parent_id' => 0])->get();
            return view('backend.pages.category.edit',compact(['categories','category']));            
        }else{
            return redirect()->route('admin.category.index')->with('alert_message',__('common.CATEGORY_DOES_NOT_EXIST'))->with('alert_class','alert-danger');
        }
    }


    public function update(CategoryUpdateRequest $request, $id)
    {
        
        $category               = Category::find($id);
        $category->name         = $request->name;
        $category->body         = $request->body;
        $category->slug         = !empty($request->slug) 
                                ? Str::slug($request->slug) 
                                : Str::slug($request->name);
        $category->parent_id    = $request->parent_id;
        $category->published    = $request->published;
        if($request->hasFile('image')){

            ## Delete current image from store for requested category 
            $year = $category->custom_date_time($category->updated_at,'Y');
            $month = strtolower($category->custom_date_time($category->updated_at,'F'));
            if(!empty($category->image)){
                $file_path = public_path('media/'.$year.'/'.$month.'/'.$category->image);
                if(File::exists($file_path)) File::delete($file_path);
            }
            ## Update new image for requested category

            $image_name         = $request->name.'-'.mt_rand(100000,999999);
            $category->image    = $this->image_upload($request->file('image'),$image_name,0, [1920,320],80);
        }   
        
        if($category->save()){
            return redirect()->back()->with('alert_message',__('common.UPDATED_SUCCESSFULLY'))->with('alert_class','alert-success');
        }

    }


    /* Delete Category */

    public function destroy($id){
        $category = Category::with(['sub_categories','products'])->find($id);
        if($category){                
            
            ## Delete sub category from db & image from directory
            if(count($category->sub_categories)){
                foreach ($category->sub_categories as $sub_category) {
                    ### Sub category products delete
                    if(count($sub_category->products)){
                        foreach ($sub_category->products as $product_sub_cat) {
                            ProductController::destroy($product_sub_cat->id);                    
                        }
                    }

                    ### Sub category image delete
                    $year_sub_cat = $sub_category->custom_date_time($sub_category->created_at,'Y');
                    $month_sub_cat = strtolower($sub_category->custom_date_time($sub_category->created_at,'F'));
                    if(!empty($sub_category->image)){
                        $file_path = public_path('media/'.$year_sub_cat.'/'.$month_sub_cat.'/'.$sub_category->image);
                        if(File::exists($file_path)) File::delete($file_path);
                    }
                    ### Sub category delete
                    $sub_category->delete();
                }
            }

            ## Delete products for requestd category
            if(count($category->products)){
                foreach ($category->products as $product) {
                    ProductController::destroy($product->id);                    
                }
            }


            ## Delete parent category image from directory
            $year = $category->custom_date_time($category->created_at,'Y');
            $month = strtolower($category->custom_date_time($category->created_at,'F'));
            if(!empty($category->image)){
                $file_path = public_path('media/'.$year.'/'.$month.'/'.$category->image);
                if(File::exists($file_path)) File::delete($file_path);
            }

            ## Delete parent category
            $category->delete();
            return redirect()->back()->with('alert_message',__('common.DELETED_SUCCESSFULLY'));

        }else{
            return redirect()->back()->with('alert_message',__('common.CATEGORY_DOES_NOT_EXIST'));            
        }
    }


     /* Category List Dispaly From AJAX Request */

    public function all(Request $request){
  
        if ($request->ajax()) {
            $query = Category::withCount(['products','sub_categories'])->with(['products','sub_categories'])->orderBy('name','asc')->get();
            return Datatables::of($query)
                ->editColumn('id', function($model) {
                    return $model->id;
                })
                ->editColumn('name', function($model) {
                    return '<span title="'.ucfirst($model->name).'">'.$model->custom_short_text($model->name,50).' </span>';
                })
                ->editColumn('body', function($model) {
                    return $model->custom_short_text($model->body, 50);
                })
                ->editColumn('created_at', function($model) {
                    return $model->custom_date_time($model->created_at);
                })
               
                ->editColumn('image', function ($model) {

                    if(isset($model->image) && !empty($model->image)){                     
                        $year = $model->custom_date_time($model->created_at,'Y');
                        $month = $model->custom_date_time($model->created_at,'F'); 
                        $image_url = url('public/media/'.$year.'/'.$month.'/'.$model->image);
                        return '<img src="'.$image_url.'" alt="'.$model->name.'" width="30" height="20" >';  
                    }
                    else{
                         return '<img src="'.url('/public/image/default.gif').'" alt="default-image" width="30" title="Default Image" >';
                    } 

                }) 
                ->addColumn('products',function($model){
                    return $model->products_count;
                })  
                ->addColumn('sub_category',function($model){
                    return $model->sub_categories_count;
                })                  
                ->addColumn('parent',function($model){
                    return isset($model->parent_category) ? $model->parent_category->name : 'No Parent' ;
                })           
                ->addColumn('action',function($model){
                    $published  = $model->published == 1 
                                ? '<a class="btn btn-default" title="'.__('common.PUBLISHED').'"><i class="fa fa-circle text-success" ></i></a>' 
                                : '<a class="btn btn-default" title="'.__('common.UNPUBLISHED').'"><i class="fa fa-circle text-danger" ></i></a>';
                    $edit = '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-sm" href="'.$model->edit($model->id).'"><i class="fa fa-pencil" title="'.__('common.EDIT').'"></i></a>';
                    $delete = '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-sm"  onclick="set_link($(this))" data-toggle="modal" data-target="#delete_model" data-id="'.$model->id.'" data-child="'.$model->sub_categories_count.'"><i class="fa fa-trash" title="'.__('common.DELETE').'"></i></a>';

                    return $published.' '.$edit.' '.$delete;

                })
                ->rawColumns(['published','action','name','image'])
                ->make(true);
        }
    }
}
