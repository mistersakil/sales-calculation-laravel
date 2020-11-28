<div class="modal fade" role="dialog">
    <!-- Modal: Create Brand -->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title text-center  text-info text-uppercase">@lang('common.Add') @lang('common.User')</h4>
            </div>
            <div class="modal-footer">
                <form method="post" action="" class="modal_form_create form-horizontal form-label-left" enctype="multipart/form-data" style="margin-bottom: 0px">
                    @csrf
                    @method('post')
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="item form-group">
                                    <input type="text" id="name" name="name" class="form-control"
                                    />
                                    <span class="help-block">
                                        @lang('common.User') @lang('common.name') (@lang('common.required'))
                                    </span>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="item form-group">
                                    <input type="email" id="email" name="email" class="form-control"
                                    />
                                    <span class="help-block">
                                        @lang('common.Email') (@lang('common.required'))
                                    </span>
                                </div>
                            </div>
                            <!-- Password -->
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="item form-group">
                                    <input type="password" id="password" name="password" class="form-control"
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
                        
                        <!-- Role -->
                        <div class="form-group">
                            <select class="form-control select2_multiple" name="role[]" id="role" multiple="multiple">
                                <option disabled>Select Role (Multiple Allowed)</option>
                                @isset($roles)
                                @foreach($roles as $single)
                                <option value="{{ $single->id }}">{{ ucfirst($single->name) }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                @lang('common.Role') (@lang('common.required'))
                            </span>
                        </div>
                        
                        
                        
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
                </form>
            </div>
        </div>
    </div>
    <!-- End: Brand Modal -->
</div>