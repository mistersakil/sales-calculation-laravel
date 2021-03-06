<div class="modal fade" role="dialog">
    <!-- Modal: Create Brand -->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title text-center  text-info text-uppercase">@lang('common.Add') @lang('common.Product')</h4>
            </div>
            <div class="modal-footer">
                <form method="post" action="" class="modal_form_create form-horizontal form-label-left" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">                                
                                <!-- Name -->
                                <div class="item form-group">
                                    <input type="text" id="name" name="name" class="form-control"
                                    />
                                    <span class="help-block">
                                        @lang('common.Product') @lang('common.name') (@lang('common.required'))
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">                                
                                <!-- Code -->
                                <div class="item form-group">
                                    <input type="text" id="code" name="code" class="form-control"
                                    />
                                    <span class="help-block">
                                        @lang('common.Product') @lang('common.Code') (@lang('common.required'))
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                
                                <!-- platform -->
                                <div class="form-group">
                                    <select class="form-control" name="platform_id" id="platform_id">
                                        @isset($model)
                                        @foreach($model->platforms() as $key => $value)
                                        <option value="{{ $key }}">{{ ucfirst($value) }}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                    <span class="help-block">
                                        @lang('common.Product') @lang('common.Platform') (@lang('common.required'))
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                
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

                            <div class="col-sm-12 col-xs-12">
                                <!-- description -->
                                <div class="item form-group">
                                    <textarea name="description" id="description"  rows="5" class="form-control"></textarea>
                                    <span class="help-block">
                                        @lang('common.Product') @lang('common.Description') (@lang('common.optional'))
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        
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