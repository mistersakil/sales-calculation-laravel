<div class="modal fade" role="dialog">
    <!-- Modal: Create Brand -->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title text-center  text-info text-uppercase">@lang('common.Edit') @lang('common.Collection')</h4>
            </div>
            <div class="modal-footer">
                @isset($collection)
                <form method="post" action="" class="modal_form_edit form-horizontal form-label-left" enctype="multipart/form-data" style="margin-bottom: 0px">
                    <input type="hidden" name="id" id="id" value="{{ $collection->id }}">
                    @csrf
                    @method('post')
                    <div class="col-md-12 col-sm-12 col-xs-12">                        

                        <!-- project_id -->
                        <div class="form-group">
                            <select class="form-control select2" name="project_id" id="project_id">
                            @foreach($project as $single)
                            <option value="{{ $single->id }}" {{ $collection->project_id == $single->id ? 'selected' : ''}}>{{ $single->client['name'] . ' => '.$single->product->code }}</option>
                            @endforeach
                            </select>
                            <span class="help-block">
                                @lang('common.Client') (@lang('common.required'))
                            </span>
                        </div>

                         <!-- collection_type -->
                        <div class="form-group">
                            <select class="form-control select2" name="collection_type" id="collection_type">
                                @foreach($collection->collection_type() as $key => $value)
                                <option value="{{ $key }}" {{ $collection->collection_type == $key ? 'selected' : ''}}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">
                                @lang('common.Collection') @lang('common.Type') (@lang('common.required'))
                            </span>
                        </div>

                        <!-- amount -->
                        <div class="item form-group">
                            <input value="{{ $collection->amount }}" type="text" id="amount" name="amount" class="form-control"
                            />
                            <span class="help-block">
                                @lang('common.Collection') @lang('common.Amount') (@lang('common.required'))
                            </span>
                        </div>

                        <!-- collection_date -->
                        <div class="form-group">
                            <div class='input-group date' id='collection_date_datepicker'>
                                <input type='text' class="form-control" name="collection_date" id="collection_date" value="{{ $collection->collection_date }}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            
                            <span class="help-block">
                                @lang('common.Collection') @lang('common.date') 
                            </span>
                        </div>
                         <!-- remark -->
                        <div class="item form-group">
                            <input value="{{ $collection->remark['body'] }}" type="text" id="remark" name="remark" class="form-control"
                            />
                            <span class="help-block">
                                @lang('common.Remarks') (@lang('common.optional'))
                            </span>
                        </div>
                        
                        
                    </div>
                    <!-- /.col -->
                    <!-- Form footer button area -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <button id="save" type="submit" class="btn btn-primary btn-block" >
                                @lang('common.SAVE')</button>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <button type="reset" class="btn btn-warning btn-block"  data-dismiss="modal">
                                @lang('common.Close')</button>
                            </div>
                        </div>
                    </div>
                </form>
                @endisset
            </div>
        </div>
    </div>
    <!-- End: Brand Modal -->
</div>
<script>
    $('.select2').select2();    
    $('#collection_date_datepicker').datetimepicker({format: 'YYYY-MM-DD'});
</script>
