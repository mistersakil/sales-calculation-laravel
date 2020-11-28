<div class="modal fade" role="dialog">
<!-- Modal -->
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<h2 class="text-center text-info">@lang('common.ARE_YOU_SURE')?</h2>
				<hr>
          		<h5 class="text-center text-primary">@lang('common.items permanently deleted') </h5>
            </div>
			<div class="modal-footer">
				<form method="post" class="modal_form_delete">
					@csrf
					<input type="hidden" name="id" id="id" value="{{ $id }}">
					<button type="submit" class="btn btn-danger  btn-block btn_destroy">@lang('common.YES')</button>
				</form>
				<button type="button" class="btn btn-success btn-block " data-dismiss="modal">@lang('common.NO')</button>
				
			</div>
		</div>
	</div>
<!-- End: Modal -->
</div>