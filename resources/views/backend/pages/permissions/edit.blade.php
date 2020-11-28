<div class="modal fade" id="modal" role="dialog">
    <!-- Modal: Create Brand -->
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="text-center text-info text-uppercase">@lang('common.Edit') @lang('common.Permission')</h2>
            </div>
            <div class="modal-footer">
                <form method="post" action="" class="form-horizontal form-label-left modal_form_edit" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="{{ $model->id }}">
                    @csrf
                    @method('post')
                    @isset($model)
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <!-- Name -->                        
                        <div class="item form-group">
                            <input value="{{ $model->name }}" type="text" id="name" name="name" class="form-control"
                            />
                            <span class="help-block">
                                @lang('common.Permission') @lang('common.name') (@lang('common.required'))
                            </span>
                        </div>

                        <!-- permission_type_id -->
                        <div class="form-group">
                            <select class="form-control select2_multiple" name="permission_type_id" id="permission_type_id">
                                <option disabled selected>Select Permission For</option>
                                @isset($permission_types)
                                @foreach($permission_types as $single)
                                <option value="{{ $single->id }}" {{ $single->id == $model->permission_type_id ? 'selected' : '' }} >{{ ucfirst($single->name) }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                @lang('common.Permission') @lang('common.For') (@lang('common.required'))
                            </span>
                        </div>
                        
                        <!-- Status -->
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