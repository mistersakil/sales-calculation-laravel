<div class="modal fade" role="dialog">
    <!-- Modal: Create Brand -->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title text-center  text-info text-uppercase">@lang('common.Add') @lang('common.Amc')</h4>
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
                                @isset($project)
                                @foreach($project as $single)
                                <option value="{{ $single->id }}">{{ $single->client['name'] . ' => '.$single->product->code }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                @lang('common.Client') (@lang('common.required'))
                            </span>
                        </div>

                        <!-- pay_schedule -->
                        <div class="form-group">
                            <select class="form-control select2" name="pay_schedule" id="pay_schedule">
                                @isset($service_charge)
                                @foreach($service_charge->pay_schedule() as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                @lang('common.Pay') @lang('common.Schedule') (@lang('common.required'))
                            </span>
                        </div>  

                        <!-- status -->
                        <div class="form-group">
                            <select class="form-control select2" name="status" id="status">
                                @isset($service_charge)
                                @foreach($service_charge->service_status() as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                @lang('common.Amc') @lang('common.Status') (@lang('common.required'))
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

                        <!-- start_date -->
                        <div class="form-group">
                            <div class='input-group date' id='start_date_datepicker'>
                                <input type='text' class="form-control" name="start_date" id="start_date" value="{{ date('Y-m-d') }}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            
                            <span class="help-block">
                                @lang('common.Start') @lang('common.Date')
                            </span>
                        </div>


                        <!-- remarks -->
                        <div class="item form-group">
                            <textarea rows="3" id="remarks" name="remarks" class="form-control"
                            ></textarea>
                            <span class="help-block">
                                @lang('common.Amc') @lang('common.Remarks')
                            </span>
                        </div>
                        
                        
                    </div>
                    <!-- /.col -->
                    <!-- Form footer button area -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <hr>
                        <div class="form-group">                            
                            <button id="save" type="submit" class="btn btn-primary btn-block" >
                            @lang('common.SAVE')</button>                                       
                            <br>
                            <button type="reset" class="btn btn-warning btn-block"  data-dismiss="modal">
                            @lang('common.Close')</button>                            
                                    
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
    $('#start_date_datepicker').datetimepicker({format: 'YYYY-MM-DD'});
</script>