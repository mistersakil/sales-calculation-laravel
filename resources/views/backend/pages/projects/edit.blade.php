<div class="modal fade" id="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="text-center text-info text-uppercase">@lang('common.project edit')</h2>
            </div>
            <div class="modal-footer">
                <form method="post" action="" class="form-horizontal form-label-left" enctype="multipart/form-data" id="modal_form" style="margin-bottom: 50px">
                    @csrf
                    @method('post')
                    <input type="hidden" name="id" id="id" value="{{ $project->id }}">
                    <!-- Left column  -->
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        
                        <!-- product_id -->
                        <div class="form-group">
                            <div class="col-md-12 col-xs-12">
                                <select class="form-control select2_single" name="product_id" id="product_id">
                                    <option value="" selected disabled>{{ __('common.choose product') }}</option>
                                    @isset($products)
                                    @foreach($products as $single)
                                    <option value="{{ $single->id }}" {{ $single->id == $project->product_id ? 'selected' : '' }}>{{ $single->name }}</option>
                                    @endforeach
                                    @endisset
                                </select>
                                <span class="help-block">
                                    {{ __('common.Project product required') }}
                                </span>
                            </div>
                        </div>
                        <!-- client_id -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <select class="form-control select2_single" name="client_id" id="client_id">
                                    <option value="" selected disabled>{{ __('common.choose client') }}</option>
                                    @isset($clients) 
                                    @foreach($clients as $single)
                                    <option value="{{ $single->id }}" {{ $single->id == $project->client_id ? 'selected' : '' }}>{{ $single->name }}</option>
                                    @endforeach
                                    @endisset
                                </select>
                                <span class="help-block">
                                    {{ __('common.Project client required') }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- unit -->
                        <div class="col-xs-12">
                            <input value="{{ $project->unit }}" type="text" id="unit" name="unit" class="form-control"
                            placeholder="{{ __('common.bin') }}" />
                            <span class="help-block">
                                {{ __('common.number of unit') }} (@lang('common.required'))
                            </span>
                        </div>
                        <!-- agreement_date -->
                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class='input-group date' id='agreement_date_datepicker'>
                                    <input type='text' class="form-control" name="agreement_date" id="agreement_date" value="{{ old('agreement_date') ?? $project->agreement_date }}" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                
                                <span class="help-block">
                                    {{ __('common.po date required') }}
                                </span>
                            </div>
                        </div>
                        <!-- Total amount  -->
                        <div class="col-xs-12">
                            <input value="{{ old('total_amount') ?? $project->total_amount }}" type="number" id="total_amount" name="total_amount" class="form-control"
                            placeholder="{{ __('common.Total amount') }}">
                            <span class="help-block">
                                {{ __('common.po value required') }}
                            </span>
                        </div>
                        <!-- Advance amount  -->
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <div class="checkbox has_advance">
                                    <label>
                                        <input type="checkbox" class="flat" > Has Advance
                                    </label>
                                </div>                                
                            </div>
                        </div>
                        <div class="col-xs-12" id="po_advance">
                            <div class="form-group">                            
                                <input value="{{ old('advance_amount') ?? $project->advance_amount }}" type="number" id="advance_amount" name="advance_amount"
                                class="form-control" placeholder="{{ __('common.Advance amount') }}">
                                <span class="help-block">
                                    {{ __('common.Advance amount required') }}
                                </span>
                                <span class="po_advance_percent">0%</span>
                            </div>
                        </div>
                        
                        <!-- advance_receive_date -->
                        <div class="col-xs-12" id="advance_receive_date_box">
                            <div class="form-group">
                                <div class='input-group date' id='advance_receive_date_datepicker'>
                                    <input type='text' class="form-control" name="advance_receive_date" id="advance_receive_date" value="{{ old('advance_receive_date') ?? $project->advance_receive_date }}" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                
                                <span class="help-block">
                                    {{ __('common.Advance receive date required') }}
                                </span>
                            </div>
                        </div>                        
                        
                    </div>
                    <!-- Right column  -->
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        
                        <!-- start_date -->
                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class='input-group date' id='start_date_datepicker'>
                                    <input type='text' class="form-control" name="start_date" id="start_date"  value="{{ old('start_date') ?? $project->start_date }}" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                
                                <span class="help-block">
                                    {{ __('common.tentative start date optional') }}
                                </span>
                            </div>
                        </div>
                        <!-- end_date -->
                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class='input-group date' id='end_date_datepicker'>
                                    <input  type='text' class="form-control" name="end_date" id="end_date"  value="{{ old('end_date') ?? $project->end_date }}" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                
                                <span class="help-block">
                                    {{ __('common.tentative end date optional') }}
                                </span>
                            </div>
                        </div>

                        <!-- progress -->
                        <div class="col-xs-12">
                            <div class="form-group">
                                <select class="form-control select2_single" name="progress" id="progress">                                   
                                    @if(count($progress = $project->custom_progress()))
                                    @foreach($progress as $key => $value)
                                    <option value="{{ $key }}"  {{ $key == $project->progress ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <span class="help-block">
                                    @lang('common.progress') @lang('common.status') (@lang('common.required'))
                                </span>
                            </div>
                        </div>
                        <!-- status -->
                        <div class="col-xs-12">
                            <div class="form-group">
                                <select class="form-control select2_single" name="status" id="status">
                                    @if(count($status = $project->custom_status()))
                                    @foreach($status as $key => $value)
                                    <option value="{{ $key }}"  {{ $key == $project->status ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <span class="help-block">
                                    @lang('common.status') (@lang('common.required'))
                                </span>
                            </div>
                        </div>
                        
                        <!-- files -->
                        <div class="col-xs-12">
                            <div class="item form-group">
                                <input type="file" id="file" name="file" class="form-control">
                                <span class="help-block">
                                    {{ __('common.Files optional') }}
                                </span>
                                
                            </div>
                        </div>

                        <!-- VAT Applicable -->
                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class="col-md-7 col-xs-12">
                                    <select class="form-control select2_single" name="vat_type" id="vat_type">
                                      
                                        @isset($project)
                                        @foreach($project->set_vat_type() as $key => $vat_type)
                                            <option value="{{ $key }}" {{ $key == $project->vat_type ? 'selected' : '' }}>{{ $vat_type }}</option>
                                        @endforeach
                                        @endisset

                                    </select>

                                    <span class="help-block">
                                        {{ __('common.vat applicable required') }}
                                    </span>
                                        
                                    
                                </div>
                                <div class="col-md-5 col-xs-12">
                                    <input value="{{ old('vat_amount') ?? $project->vat_amount }}" type="number" id="vat_amount" name="vat_amount" class="form-control" placeholder="VAT Amount">
                                    <span class="help-block">
                                        {{ __('common.vat value optional') }}
                                    </span>
                                </div>
                                    
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
                                    <div class="col-md-3 col-xs-12 col-md-offset-6">
                                        <button type="button" class="btn btn-danger btn-block"
                                        data-dismiss="modal">@lang('common.Close')</button>
                                    </div>
                                    <div class="col-md-3 col-xs-12 col-md-offset-0">
                                        <button id="save" type="submit" class="btn btn-primary btn-block">
                                        @lang('common.UPDATE')</button>
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


$('#advance_receive_date_datepicker').datetimepicker({format: 'YYYY-MM-DD'});
$('#agreement_date_datepicker').datetimepicker({format: 'YYYY-MM-DD'});
$('#start_date_datepicker').datetimepicker({format: 'YYYY-MM-DD'});
$('#end_date_datepicker').datetimepicker({format: 'YYYY-MM-DD'});
$('.select2_single').select2();
calculate_percent();
if($('#total_amount').val() > 0){
    $('.has_advance :checkbox').attr('checked','checked')
}
$('#total_amount').on('change',function() {
    calculate_percent();
    if ($(this).val() != '' && $(this).val() > 0 ) {
        $('.has_advance').show();
        if($('.has_advance :checkbox').attr('checked')){
            $('#po_advance').show();   
            $('#advance_receive_date_box').show();         
        }
    } else {
        $('.has_advance').hide();
        $('#po_advance').hide();
        $('#po_advance #advance_amount').val('');
        $('#po_advance .po_advance_percent').text('');
        $('#advance_receive_date_box').hide();

    }
});

$('.has_advance :checkbox').change(function() {
    if (this.checked) {
        $(this).attr('checked','checked');
        $('#po_advance').show();
        $('#advance_receive_date_box').show();
    } else {
        $('#po_advance').hide();
        $('#advance_receive_date_box').hide();
        $('#po_advance #advance_amount').val('');
        $('#po_advance .po_advance_percent').text('');       

    }
});

$('#advance_amount').change(calculate_percent);
function calculate_percent() {
    var po_value  = $('#total_amount').val();
    var advance_amount  = $('#advance_amount').val();
    var advance_percent  = ((advance_amount * 100) / po_value).toFixed(2);
    var pending_amount = po_value - advance_amount;
    $('.po_advance_percent').text(advance_percent + '% (Pending: ' +pending_amount + ')');
    if(advance_amount <=0) {
       $('#advance_receive_date_box').hide();  
    }else{
        $('#advance_receive_date_box').show();  
    }
}
</script>