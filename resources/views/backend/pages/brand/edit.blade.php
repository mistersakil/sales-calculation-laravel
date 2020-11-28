<div class="modal fade" id="edit_modal" role="dialog">
<!-- Modal: Edit Brand -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<h2 class="text-center text-info text-uppercase">@lang('common.BRAND_EDIT')</h2>
			</div>
			<div class="modal-footer">
				<form action="" method="post"  class="form-horizontal form-label-left" enctype="multipart/form-data" id="edit_form" style="margin-bottom: 50px">
					@csrf
					<input type="hidden" id="id" name="id" value="{{ $brand->id }}">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<!-- Name & Slug -->
						<div class="item form-group">
							<div class="col-xs-12 col-md-6">
								<input value="{{ $brand->name }}" type="text" id="name" name="name" class="form-control" placeholder="{{ __('common.NAME') }}" />
								<span class="help-block">
									{{ __('common.BRAND_NAME_REQUIRED') }}
								</span>
							</div>

							<!-- Slug -->
							<div class="col-xs-12 col-md-6">
								<input value="{{ $brand->slug }}" type="text" id="slug" name="slug" class="form-control" placeholder="{{ __('common.SLUG') }}">
								<span class="help-block">
									{{ __('common.BRAND_SLUG_OPTIONAL') }}
								</span>
							</div>
						</div>
						
						<!-- Description -->
						<div class="item form-group">
							<div class="col-xs-12">
								<textarea rows="3" id="body" name="body" class="form-control" placeholder="{{ __('common.DESCRIPTION') }}">{{ $brand->body }}</textarea>
								<span class="help-block">
									{{ __('common.BRAND_DESCRIPTION_OPTIONAL') }}
								</span>
							</div>
						</div>

						<!-- Image -->
						<div class="item form-group">
							<div class="col-sm-6 col-xs-12">
								<input type="file" id="image" name="image" class="form-control">
								<span class="help-block">
									{{ __('common.BRAND_IMAGE_OPTIONAL') }}
								</span>
							</div>
							<div class="col-sm-6 col-sm-offset-0 col-xs-12 text-left">
								<p style="border: 1px solid #ddd; padding: 3px 20px; cursor: pointer;">
									<strong>@lang('common.PUBLISHED')</strong>
									
									<input type="radio" name="published" id="pub_yes" value="1" @if($brand->published == 1){{ 'checked' }}@endif /> <label for="pub_yes"> @lang('common.YES')</label>
									<input type="radio" name="published" id="pub_no" value="0" @if($brand->published == 0){{ 'checked' }}@endif/> <label for="pub_no"> @lang('common.NO')</label>
								</p>
							</div>
						</div>
						
					</div>
					
					<div class="col-md-12 col-sm-12 col-xs-12">

						
						<hr>
						<div class="form-group">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-md-3 col-xs-12 col-md-offset-0">
										<button type="button" class="btn btn-warning btn-block" data-dismiss="modal">@lang('common.CANCEL')</button>
									</div>
									<div class="col-md-3 col-xs-12 col-md-offset-0">
										<button type="reset" class="btn btn-danger btn-block"> @lang('common.DELETE')</button>
									</div>
									<div class="col-md-3 col-xs-12 col-md-offset-0">
										
									</div>
									<div class="col-md-3 col-xs-12 col-md-offset-3">
										<button id="save" type="submit" class="btn btn-primary btn-block"> @lang('common.UPDATE')</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

<!-- End: Edit Brand Modal -->
</div>
