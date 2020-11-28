<div class="modal fade" role="dialog">
    <!-- Modal: Create Brand -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title text-center  text-info text-uppercase">@lang('common.Generate') @lang('common.Permissions')</h4>
            </div>
            <div class="modal-footer">
                <form method="post" action="" class="modal_form_permission_generate form-horizontal form-label-left" enctype="multipart/form-data" style="margin-bottom: 0px">
                    @csrf
                    @method('post')
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        @isset($permission_types)
                        @foreach($permission_types->chunk(4) as $chunk_permission_types)
                        <div class="row">
                            @foreach($chunk_permission_types as $type => $permissions)
                            <div class="col-sm-3 col-xs-6  text-left">
                                <h4 class="btn btn-info btn-block">{{ _sentence_case($type,'ucwords') }}</h4>
                                <ul class="to_do">
                                    @php sort($permissions) @endphp
                                    @foreach($permissions as $permission)
                                    <li>{{ _sentence_case($permission,'ucfirst') }}</li>
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