<div class="modal fade" id="modal" role="dialog">
    <!-- Modal: Create Brand -->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="text-center text-info text-uppercase">@lang('common.project edit')</h2>
            </div>
            <div class="modal-footer">
                <form method="post" action="" class="form-horizontal form-label-left modal_form_edit" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="{{ $model->id }}">
                    @csrf
                    @method('post')
                    @isset($model)
                    <div class="col-md-12 col-sm-12 col-xs-12">
                       

                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="item form-group">
                                    <input value="{{ $model->name }}" type="text" id="name" name="name" class="form-control"
                                    />
                                    <span class="help-block">
                                        @lang('common.User') @lang('common.name') (@lang('common.required'))
                                    </span>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="item form-group">
                                    <input value="{{ $model->email }}" type="email" id="email" name="email" class="form-control"
                                    />
                                    <span class="help-block">
                                        @lang('common.Email') (@lang('common.required'))
                                    </span>
                                </div>
                            </div>
                            <!-- Password -->
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="item form-group">
                                    <input value="" type="password" id="password" name="password" class="form-control"
                                    />
                                    <span class="help-block">
                                        @lang('common.Password') (@lang('common.required'))
                                    </span>
                                </div>
                            </div>
                            <!-- Status -->
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <select class="form-control" name="status" id="status">
                                        @foreach($model->custom_status() as $key => $value)
                                        <option value="{{ $key }}" {{ $key == $model->status ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">
                                        @lang('common.Status') (@lang('common.required'))
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Role -->
                        <div class="form-group">
                            @php                            
                                $user_roles = $model->roles->map(function ($item, $key) {
                                    return $item->id;
                                });
                            @endphp
                            <select class="form-control select2_multiple" name="role[]" id="role" multiple="multiple">
                                <option disabled>Select Role (Multiple Allowed)</option>
                                @isset($roles)
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ in_array($role->id,$user_roles->all()) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                @lang('common.Role') (@lang('common.required'))
                            </span>
                        </div>                     
                    </div>
                    @endisset
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
                    <!-- End: Form footer button area -->
                </form>
            </div>
        </div>
    </div>
    <!-- End: Brand Modal -->
</div>
<script>
</script>