@extends('backend.layout.master')
@section('page_title',__('common.404'))
@section('main_content')
<div class="row">
	<div class="col-xs-12 text-center">
		<div class="col-md-12">
			<div class="col-middle">
				<div class="text-center text-center">
					<h1 class="error-number">@lang('common.404')</h1>
					<h1 class="text-danger">@lang('common.Not') @lang('common.Found')</h1>					
					<div class="mid_center">
						<h3>@lang('common.SEARCH')</h3>
						<form>
							<div class="col-xs-12 form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="{{  __('common.WRITE_HERE') }}...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">@lang('common.SUBMIT')</button>
									</span>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection