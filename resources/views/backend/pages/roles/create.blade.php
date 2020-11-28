<div class="modal fade" role="dialog">
    <!-- Modal: Create Brand -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title text-center  text-info text-uppercase">@lang('common.Add') @lang('common.Role')</h4>
            </div>
            <div class="modal-footer">
                <form method="post" action="" class="modal_form_create form-horizontal form-label-left" enctype="multipart/form-data" style="margin-bottom: 0px">
                    @csrf
                    @method('post')
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                
                                <!-- Name -->
                                <div class="item form-group">
                                    <input type="text" id="name" name="name" class="form-control"
                                    />
                                    <span class="help-block">
                                        @lang('common.Role') @lang('common.name') (@lang('common.required'))
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <!-- description -->
                                <div class="item form-group">
                                    <input type="text" id="description" name="description" class="form-control"
                                    />
                                    <span class="help-block">
                                        @lang('common.Role') @lang('common.Description') (@lang('common.optional'))
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                
                                <!-- status -->
                                <div class="form-group">
                                    <select class="form-control" name="status" id="status">
                                        @isset($model)
                                        @foreach($model->custom_status() as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                    <span class="help-block">
                                        @lang('common.Status') (@lang('common.required'))
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        
                        <!-- Permission List -->
                        <div class="row">
                            <div class="x_title">
                                <h3 class="text-center">Select Permissions Below</h3>
                            </div>
                        </div>
                        <!-- /.row -->
                        @isset($permission_types)
                        @foreach($permission_types->chunk(4) as $chunk_permission_type)
                        <div class="row">
                            @foreach($chunk_permission_type as $permission_type)
                            <div class="col-sm-3 col-xs-6  text-left">
                                <h4 class="btn btn-info btn-block">{{ _sentence_case($permission_type->name,'ucwords') }}</h4>
                                <ul class="to_do">
                                    
                                    @foreach($permission_type->permissions()->where('status',1)->orderBy('name','asc')->get() as $permission)
                                    @if($permission->status == 1)
                                    @if(_sentence_case($permission->name,'strtolower') == 'index')
                                    <p>
                                        <label><input type="checkbox" name="permissions" value="{{ $permission->id }}" checked > {{ _sentence_case($permission->name,'ucwords') }}</label>
                                    </p>
                                    @else
                                    <p>
                                        <label><input type="checkbox" name="permissions" value="{{ $permission->id }}" > {{ _sentence_case($permission->name,'ucwords') }}</label>
                                    </p>

                                    @endif
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                        @endisset
                        <!-- End: Permission List -->
                        
                    </div>
                    <!-- /.col -->
                    
                    <!-- Form footer button area -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <hr>
                        <div class="form-group">
                            <button id="save" type="submit" class="btn btn-primary btn-block">
                            @lang('common.SAVE')</button>
                            <br>
                            <button type="button" class="btn btn-warning btn-block" data-dismiss="modal">
                            @lang('common.Close')</button>
                            
                        </div>
                    </div>
                    <!-- /.col -->
                </form>
            </div>
        </div>
    </div>
    <!-- End: Brand Modal -->
</div>