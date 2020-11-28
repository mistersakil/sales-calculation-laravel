<div class="modal fade" role="dialog">
<!-- Modal -->
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<h2 class="text-center text-info">@lang('common.ARE_YOU_SURE')?</h2>
          		<h6 class="text-center text-primary"> @lang('common.Receive') @lang('common.Current') @lang('common.Month') @lang('common.Mmc') @lang('common.For')</h6>
				<hr>
          		@if($service_charge)
					<p><strong>Client:</strong> {{ $service_charge->project->client->name }}</p>
					<p><strong>Product:</strong> {{ $service_charge->project->product->name }}</p>
					<p><strong>MMC Amount:</strong> <span class="label label-primary">{{ number_format($service_charge->amount) }}</span></p>
          		@endif
            </div>
			<div class="modal-footer">
				<form method="post" class="modal_form_receive">
					@csrf
					<!-- collection_date -->
                    <div class="form-group">
                        <div class='input-group date' id='collection_date_datepicker'>
                            <input type='text' class="form-control" name="collection_date" id="collection_date" value="{{ date('Y-m-d') }}" required />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        
                        <span class="help-block">
                            @lang('common.Collection') @lang('common.date')  (@lang('common.required'))
                        </span>
                    </div>

					<input type="hidden" name="id" id="id" value="{{ $service_charge }}">
					<input type="hidden" name="project_id" id="project_id" value="{{ $service_charge->project_id }}">
					<input type="hidden" name="amount" id="amount" value="{{ $service_charge->amount }}">
					<input type="hidden" name="collection_type" id="collection_type" value="3">
					<input type="hidden" name="remark" id="remark" value="{{ date('F').' MMC' }}">
					

					<button type="submit" class="btn btn-success  btn-block btn_receive">@lang('common.YES')</button>
				</form>
				<button type="button" class="btn btn-danger btn-block " data-dismiss="modal">@lang('common.NO')</button>
				
			</div>
		</div>
	</div>
<!-- End: Modal -->
</div>
<script>
$('#collection_date_datepicker').datetimepicker({format: 'YYYY-MM-DD'});
</script>