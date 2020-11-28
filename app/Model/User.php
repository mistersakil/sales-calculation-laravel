<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Datatables;
class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';

    protected $guarded = ['remember_token'];

    protected $hidden = [
        'password', 'remember_token',
    ];

   
    public function user_permission($permission_for, $permission_name){
        $user_logged_in = self::with('roles.permissions.permission_type')->where('id',auth()->user()->id)->first();
        /* Admin user can access all permissions without check */
        if($user_logged_in->name =='admin') return true;
        /* End: Admin user can access all permissions without check */
        $my_permissions = [];
        $my_permissions_final = [];
        $my_permission_types = [];
        $first_role = $user_logged_in->roles()->first();
        if($first_role){
            $permissions = $first_role->permissions;
            $permission_types = PermissionType::all()->toArray();
            foreach ($permissions as $permission) {
                $my_permissions[$permission->permission_type_id][] = strtolower($permission->name);
            }
            foreach ($permission_types as $permission_type) {
                $my_permission_types[$permission_type['id']] = strtolower($permission_type['name']);
            }
            foreach ($my_permissions as $key => $permission) {
                if(array_key_exists($key, $my_permission_types)){
                    $my_permissions_final[$my_permission_types[$key]] = $permission;
                }
            }
            if(array_key_exists($permission_for, $my_permissions_final)){
                $for = $my_permissions_final[$permission_for];
                if(in_array(strtolower($permission_name), $for)){
                    return true;
                }
            }
        }
        return false;
    }

    ## Set status ##
    public function custom_status(){     
         return [
            '1' => 'Active',
            '0' => 'Inactive',
        ];
    }
    ## Get all clients by AJAX request ##

   	public static function all_by_ajax(){
	   	$query = self::with('roles')->orderBy('id','desc')->get();
        if( auth()->user()->can('edit', User::class)  && auth()->user()->can('delete', User::class) ){
            return Datatables::of($query)
                ->editColumn('name', function($model) {
                    return ucfirst($model->name);
                })   
                ->addColumn('role_id', function($model) {
                    $result = '';
                    if($model->roles->count()){
                        $roles = $model->roles()->where('status',1)->get();
                        foreach ($roles as $role) {
                                $result .= $role->status 
                                        ? '<span class="label label_lightseagreen">'.ucfirst($role->name).'</span> '
                                        : '<span class="label label-default">'.ucfirst($role->name).'</span> ';
                        }
                    }else{
                        $result .= '<span class="label label-default">No Role</span>';
                    }
                    return $result;

                })   
                ->editColumn('updated_at', function($model) {
                    return $model->updated_at->diffForHumans();
                })  
                ->editColumn('created_at', function($model) {
                    return $model->created_at->diffForHumans();
                })    
                ->editColumn('status', function($model) {
                    $result = $model->status 
                            ? '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
                            : '<span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
                    return $result;
                })       
                ->addColumn('action',function($model){
                    $result   = '';
                    $result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
                    $result  .= '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';
                    if(strtolower($model->name) !== 'admin'){
                        $result  .= '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-xs btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';
                    }else{
                        $result  .= '<a  title="'.__('common.Can').' '.__('common.Not').' '.__('common.Delete').'" class="btn btn-dark btn-xs" data-id="'.$model->id.'"><i class="fa fa-exclamation-triangle"></i></a>';
                    }

                    return $result;

                })
                
                ->rawColumns(['action','status','role_id'])
                ->make(true);
        }elseif( auth()->user()->can('edit', User::class) ){
             return Datatables::of($query)
                ->editColumn('name', function($model) {
                    return ucfirst($model->name);
                })   
                ->addColumn('role_id', function($model) {
                    $result = '';
                    if($model->roles->count()){
                        $roles = $model->roles()->where('status',1)->get();
                        foreach ($roles as $role) {
                                $result .= $role->status 
                                        ? '<span class="label label_lightseagreen">'.ucfirst($role->name).'</span> '
                                        : '<span class="label label-default">'.ucfirst($role->name).'</span> ';
                        }
                    }else{
                        $result .= '<span class="label label-default">No Role</span>';
                    }
                    return $result;

                })   
                ->editColumn('updated_at', function($model) {
                    return $model->updated_at->diffForHumans();
                })  
                ->editColumn('created_at', function($model) {
                    return $model->created_at->diffForHumans();
                })    
                ->editColumn('status', function($model) {
                    $result = $model->status 
                            ? '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
                            : '<span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
                    return $result;
                })       
                ->addColumn('action',function($model){
                    $result   = '';
                    $result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
                    $result  .= '<a  title="'.__('common.EDIT').'" class="btn btn-warning btn-xs btn_edit" data-id="'.$model->id.'"><i class="fa fa-pencil"></i></a>';

                    return $result;

                })
                
                ->rawColumns(['action','status','role_id'])
                ->make(true);

        }elseif( auth()->user()->can('delete', User::class) ){
             return Datatables::of($query)
                ->editColumn('name', function($model) {
                    return ucfirst($model->name);
                })   
                ->addColumn('role_id', function($model) {
                    $result = '';
                    if($model->roles->count()){
                        $roles = $model->roles()->where('status',1)->get();
                        foreach ($roles as $role) {
                                $result .= $role->status 
                                        ? '<span class="label label_lightseagreen">'.ucfirst($role->name).'</span> '
                                        : '<span class="label label-default">'.ucfirst($role->name).'</span> ';
                        }
                    }else{
                        $result .= '<span class="label label-default">No Role</span>';
                    }
                    return $result;

                })   
                ->editColumn('updated_at', function($model) {
                    return $model->updated_at->diffForHumans();
                })  
                ->editColumn('created_at', function($model) {
                    return $model->created_at->diffForHumans();
                })    
                ->editColumn('status', function($model) {
                    $result = $model->status 
                            ? '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
                            : '<span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
                    return $result;
                })       
                ->addColumn('action',function($model){
                    $result   = '';
                    $result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';
                    $result  .= '<a  title="'.__('common.DELETE').'" class="btn btn-danger btn-xs btn_delete" data-id="'.$model->id.'"><i class="fa fa-trash"></i></a>';

                    return $result;

                })
                
                ->rawColumns(['action','status','role_id'])
                ->make(true);

        }else{
             return Datatables::of($query)
                ->editColumn('name', function($model) {
                    return ucfirst($model->name);
                })   
                ->addColumn('role_id', function($model) {
                    $result = '';
                    if($model->roles->count()){
                        $roles = $model->roles()->where('status',1)->get();
                        foreach ($roles as $role) {
                                $result .= $role->status 
                                        ? '<span class="label label_lightseagreen">'.ucfirst($role->name).'</span> '
                                        : '<span class="label label-default">'.ucfirst($role->name).'</span> ';
                        }
                    }else{
                        $result .= '<span class="label label-default">No Role</span>';
                    }
                    return $result;

                })   
                ->editColumn('updated_at', function($model) {
                    return $model->updated_at->diffForHumans();
                })  
                ->editColumn('created_at', function($model) {
                    return $model->created_at->diffForHumans();
                })    
                ->editColumn('status', function($model) {
                    $result = $model->status 
                            ? '<span class="label label-success">'.$model->custom_status()[$model->status].'</span>'
                            : '<span class="label label-default">'.$model->custom_status()[$model->status].'</span>';
                    return $result;
                })       
                ->addColumn('action',function($model){
                    $result   = '';
                    $result  .= '<a  title="'.__('common.View').'" class="btn btn-info btn-xs btn_view" data-id="'.$model->id.'"><i class="fa fa-eye"></i></a>';

                    return $result;

                })
                
                ->rawColumns(['action','status','role_id'])
                ->make(true);

        }
	   	

   }

   	## Relationship ##

   	public function roles(){
   		return $this->belongsToMany(Role::class,'user_roles','user_id','role_id')->withTimestamps();
   	}


   	public function image(){
   		return $this->morphTo(Image::class);
   	}




}
