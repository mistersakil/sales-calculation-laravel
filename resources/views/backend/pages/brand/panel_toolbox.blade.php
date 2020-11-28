<ul class="nav navbar-right panel_toolbox">
	<a class="btn btn-primary" id="crate_brand_modal_btn"><i class="fa fa-plus"></i> {{ __('common.BRAND_ADD') }}</a>
	
	<a class="btn btn-success" href="{{ $brand_list_link }}"><i class="fa fa-th-list"></i> {{ __('common.BRAND_LIST') }}</a>
	@if(session()->has('last_attribute_id'))
	<a class="btn btn-danger" href="{{ $brand_edit_link(session('last_brand_id')) }}"><i class="fa fa-pencil"></i> {{ __('common.CATEGORY_LAST') }}</a>
	@endif
</ul>

<div class="clearfix"></div>