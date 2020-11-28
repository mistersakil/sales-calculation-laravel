<div class="modal fade" role="dialog">
<!-- Modal -->
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<h2 class="text-center text-info">@lang('common.ARE_YOU_SURE')?</h2>
				<hr>
          		<h5 class="text-center text-primary" style="width: 30%; margin: 0 auto; border-bottom: 2px solid darkblue; padding-bottom: 15px; margin-bottom: 15px;">@lang('common.Summary') </h5>
          		
          		<p><strong>@lang('common.Client'):</strong> {{ $client ?? 0 }} </p>
          		<p><strong>@lang('common.Product'): </strong> {{ $product ?? 0 }}</p>
          		<p><strong>@lang('common.Advance') @lang('common.Amount'):</strong> {{ number_format($amount ?? 0) }} </p>
            </div>
			<div class="modal-footer">
				<form method="post" class="modal_form_collect">
					@csrf

					<input type="hidden" name="amount" id="amount" value="{{ $amount ?? 0 }}">
					<input type="hidden" name="collection_type" id="collection_type" value="{{ 1 }}">
					<input type="hidden" name="project_id" id="project_id" value="{{ $project_id }}">

					<button type="submit" class="btn btn-danger  btn-block">@lang('common.YES')</button>
				</form>
				<button type="button" class="btn btn-success btn-block " data-dismiss="modal">@lang('common.NO')</button>
				
			</div>
		</div>
	</div>
<!-- End: Modal -->
</div>