<div class="modal fade" id="create_modal" role="dialog">
    <!-- Modal: Create Brand -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="text-center text-info text-uppercase">@lang('common.PROJECT_ADD')</h2>
            </div>
            <div class="modal-footer">
                <form method="post" action="" class="form-horizontal form-label-left" enctype="multipart/form-data"
                    id="create_form" style="margin-bottom: 50px">
                    @csrf
                    @method('post')
                    <!-- Left column  -->
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="item form-group">
                            <!-- Name -->
                            <div class="col-xs-12">
                                <input value="" type="text" id="name" name="name" class="form-control"
                                placeholder="{{ __('common.NAME') }}" />
                                <span class="help-block">
                                    {{ __('common.Project name required') }}
                                </span>
                            </div>
                            <!-- Total amount  -->
                            <div class="col-xs-12">
                                <input value="" type="number" id="total_amount" name="total_amount" class="form-control"
                                placeholder="{{ __('common.Total amount') }}">
                                <span class="help-block">
                                    {{ __('common.Total amount required') }}
                                </span>
                            </div>
                            <!-- Advance amount  -->
                            <div class="col-xs-12">
                                <input value="" type="number" id="advance_amount" name="advance_amount"
                                class="form-control" placeholder="{{ __('common.Advance amount') }}">
                                <span class="help-block">
                                    {{ __('common.Advance amount required') }}
                                </span>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="item form-group">
                            <div class="col-xs-12">
                                <textarea rows="3" id="body" name="body" class="form-control"
                                placeholder="{{ __('common.DESCRIPTION') }}"></textarea>
                                <span class="help-block">
                                    {{ __('common.Project description optional') }}
                                </span>
                            </div>
                        </div>
                        <!-- agreement_date -->
                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class='input-group date' id='agreement_datepicker'>
                                    <input type='text' class="form-control" name="agreement_date" id="agreement_date" value="{{ date('Y-m-d') }}" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                
                                <span class="help-block">
                                    {{ __('common.Agreement date required') }}
                                </span>
                            </div>
                        </div>
                        <!-- start_date -->
                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class='input-group date' id='start_datepicker'>
                                    <input type='text' class="form-control" name="start_date" id="start_date"  value="{{ date('Y-m-d') }}" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                
                                <span class="help-block">
                                    {{ __('common.Project strat date optional') }}
                                </span>
                            </div>
                        </div>
                        <!-- end_date -->
                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class='input-group date' id='end_datepicker'>
                                    <input type='text' class="form-control" name="end_date" id="end_date"  value="{{ date('Y-m-d') }}" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                
                                <span class="help-block">
                                    {{ __('common.Project end date optional') }}
                                </span>
                            </div>
                        </div>
                      
                </div>
                <!-- Right column  -->
                <div class="col-md-6 col-sm-12 col-xs-12">
                    
                    <!-- product_id -->
                    <div class="col-xs-12">
                        <div class="form-group">
                            <select class="form-control" name="product_id" id="product_id">
                                <option value="0">Choose product</option>
                                @isset($products)
                                @foreach($products as $single)
                                <option value="{{ $single->id }}">{{ $single->name }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                {{ __('common.Project product optional') }}
                            </span>
                        </div>
                    </div>    
                    <!-- client_id -->
                    <div class="col-xs-12">
                        <div class="form-group">
                            <select class="form-control" name="client_id" id="client_id">
                                <option value="0">Choose client</option>
                                @isset($clients)
                                @foreach($clients as $single)
                                <option value="{{ $single->id }}">{{ $single->name }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                {{ __('common.Project client required') }}
                            </span>
                        </div>
                    </div> 

                    <!-- discuss_member_id -->
                    <div class="col-xs-12">
                        <div class="form-group">
                            <select class="form-control" name="discuss_member_id" id="discuss_member_id">
                                <option value="0">Choose discuss member</option>
                                @isset($employees)
                                @foreach($employees as $single)
                                <option value="{{ $single->id }}">{{ $single->name }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                {{ __('common.Discuss member optional') }}
                            </span>
                        </div>
                    </div> 
                    <!-- support_person_id -->
                    <div class="col-xs-12">
                        <div class="form-group">
                            <select class="form-control" name="support_person_id" id="support_person_id">
                                <option value="0">Choose support person</option>
                                @isset($employees)
                                @foreach($employees as $single)
                                <option value="{{ $single->id }}">{{ $single->name }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                {{ __('common.Support person optional') }}
                            </span>
                        </div>
                    </div> 

                    <!-- project_status -->
                    <div class="col-xs-12">
                        <div class="form-group">
                            <select class="form-control" name="project_status" id="project_status">
                                <option value="0">Choose project status</option>
                                <option value="1">Live</option>
                                <option value="2">Ongoing</option>
                                <option value="3">Pendng</option>
                                <option value="4">Pendng</option>
                            </select>
                            <span class="help-block">
                                {{ __('common.Project status optional') }}
                            </span>
                        </div>
                    </div>
                    <!-- published -->
                    <div class="col-xs-12">
                        <div class="form-group">
                            <select class="form-control" name="published" id="published">
                                <option value="0">Choose project published type</option>
                                <option value="1">Published</option>
                                <option value="2">Unpublished</option>
                            </select>
                            <span class="help-block">
                                {{ __('common.Project published optional') }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- files -->
                    <div class="col-xs-12">
                        <div class="item form-group">
                            <input type="file" id="files" name="files" class="form-control">
                            <span class="help-block">
                                {{ __('common.Files optional') }}
                            </span>
                            
                        </div>
                    </div>                    
                    
                </div>
                <!-- End: Right column  -->
                
                <!-- Modal footer button area -->
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