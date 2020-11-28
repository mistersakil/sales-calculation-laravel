<div class="modal fade" role="dialog">
    <!-- Modal: Create Brand -->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title text-center  text-info text-uppercase">@lang('common.add') @lang('common.client')</h4>
            </div>
            <div class="modal-footer">
                <form method="post" action="" class="modal_form form-horizontal form-label-left" enctype="multipart/form-data" style="margin-bottom: 0px">
                    @csrf
                    @method('post')
                    <!-- Left column  -->
                <div class="col-md-6 col-sm-12 col-xs-12">
                        
                    <!-- Name -->
                    <div class="col-xs-12">
                        <div class="item form-group">
                            <input type="text" id="name" name="name" class="form-control"
                             />
                            <span class="help-block">
                                @lang('common.client') @lang('common.name') (@lang('common.required'))
                            </span>
                        </div>
                    </div>    
                    <!-- contact_person -->
                    <div class="col-xs-12">
                        <div class="item form-group">
                            <input type="text" id="contact_person" name="contact_person" class="form-control"
                             />
                            <span class="help-block">
                                @lang('common.contact person') (@lang('common.required'))
                            </span>
                        </div>
                    </div>   
                    <!-- phone -->
                    <div class="col-xs-12">
                        <div class="item form-group">
                            <input type="text" id="phone" name="phone" class="form-control"
                             />
                            <span class="help-block">
                                @lang('common.client') @lang('common.phone') (@lang('common.optional'))
                            </span>
                        </div>
                    </div>   
                    <!-- email -->
                    <div class="col-xs-12">
                        <div class="item form-group">
                            <input type="text" id="email" name="email" class="form-control"
                             />
                            <span class="help-block">
                                @lang('common.client') @lang('common.email') (@lang('common.optional'))
                            </span>
                        </div>
                    </div>   
                       
                      
                </div>
                <!-- Right column  -->
                <div class="col-md-6 col-sm-12 col-xs-12">
                     
                    <!-- country_id -->
                    <div class="col-xs-12">
                        <div class="form-group">
                            <select class="form-control" name="country_id" id="country_id">
                                @isset($countries)
                                @foreach($countries as $single)
                                <option value="{{ $single->id }}">{{ $single->name }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                @lang('common.country') (@lang('common.required'))
                            </span>
                        </div>
                    </div>   

                    <!-- address -->
                    <div class="col-xs-12">
                        <div class="item form-group">
                            <textarea rows="2" id="address" name="address" class="form-control"></textarea>
                            <span class="help-block">
                               @lang('common.client') @lang('common.address') (@lang('common.optional'))
                            </span>
                        </div>
                    </div>
                    <!-- website -->
                    <div class="col-xs-12">
                        <div class="item form-group">
                            <input type="text" id="website" name="website" class="form-control"
                             />
                            <span class="help-block">
                                @lang('common.client') @lang('common.website') (@lang('common.optional'))
                            </span>
                        </div>
                    </div> 

                    <!-- status -->
                    <div class="col-xs-12">
                        <div class="form-group">
                            <select class="form-control" name="status" id="status">
                                @isset($client)
                                @foreach($client->custom_status() as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                @lang('common.publish type') (@lang('common.required'))
                            </span>
                        </div>
                    </div>  

                                      
                    
                </div>
                <!-- End: Right column  -->
                
                <!-- Form footer button area -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <hr>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-3 col-xs-12 col-md-offset-0">
                                    <button type="button" class="btn btn-danger btn-block"
                                    data-dismiss="modal">@lang('common.CANCEL')</button>
                                </div>
                                <div class="col-md-3 col-xs-12 col-md-offset-0">
                                    <button type="reset" class="btn btn-warning btn-block">
                                    @lang('common.CLEAR')</button>
                                </div>
                                <div class="col-md-3 col-xs-12 col-md-offset-0">
                                </div>
                                <div class="col-md-3 col-xs-12 col-md-offset-3">
                                    <button id="save" type="submit" class="btn btn-primary btn-block">
                                    @lang('common.SAVE')</button>
                                </div>
                            </div>
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
/** Form initialization **/
$('#agreement_datepicker').datetimepicker({format: 'YYYY-MM-DD'});
$('#start_datepicker').datetimepicker({format: 'YYYY-MM-DD'});
$('#end_datepicker').datetimepicker({format: 'YYYY-MM-DD'});
</script>