<div class="modal fade" role="dialog">
    <!-- Modal: Create Brand -->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title text-center  text-info text-uppercase">@lang('common.Add') @lang('common.Collection')</h4>
            </div>
            <div class="modal-footer">
                <form method="post" action="" class="modal_form_create form-horizontal form-label-left" enctype="multipart/form-data" style="margin-bottom: 0px">
                    @csrf
                    @method('post')
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- project_id -->
                        <div class="form-group">
                            <select class="form-control select2" name="project_id" id="project_id">
                                <option value="" disabled selected>@lang('common.Please') @lang('common.Select')</option>
                                @isset($projects)
                                @foreach($projects as $single)
                                <option value="{{ $single->id }}" data-advance="{{ $single->advance_amount }}">{{ $single->client['name'] . ' => '.$single->product->code }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                @lang('common.Client') (@lang('common.required'))
                            </span>
                        </div>
                        <!-- collection_type -->
                        <div class="form-group">
                            <select class="form-control select2" name="collection_type" id="collection_type">
                                @isset($collection)
                                @foreach($collection->collection_type() as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                @lang('common.Collection') @lang('common.Type') (@lang('common.required'))
                            </span>
                        </div>
                        <!-- amount -->
                        <div class="item form-group">
                            <input type="text" id="amount" name="amount" class="form-control"
                            />
                            <span class="help-block">
                                @lang('common.Amount') (@lang('common.required'))
                            </span>
                        </div>
                        <!-- collection_date -->
                        <div class="form-group">
                            <div class='input-group date' id='collection_date_datepicker'>
                                <input type='text' class="form-control" name="collection_date" id="collection_date" value="{{ date('Y-m-d') }}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            
                            <span class="help-block">
                                @lang('common.For') @lang('common.Which') @lang('common.Day')  (@lang('common.required'))
                            </span>
                        </div>
                        <!-- remark -->
                        <div class="item form-group">
                            <input placeholder="Date time or any reason of collection " type="text" id="remark" name="remark" class="form-control"
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
            </div>
        </div>
    </div>
    <!-- End: Brand Modal -->
</div>
<script>
$('.select2').select2();
$('#collection_date_datepicker').datetimepicker({format: 'YYYY-MM-DD'});
</script>