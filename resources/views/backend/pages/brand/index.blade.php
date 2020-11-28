@extends('backend.layout.master')
@section('page_title',__('common.BRAND_LIST'))
@section('main_content')
<div class="row" id="view_container">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2 class="text-capitalize">{{ __('common.BRAND_LIST') }}</h2>
				@includeIf('backend.pages.brand.panel_toolbox')
			</div>
			<div class="x_content">
				<div class="row">
					<div class="col-xs-12">
						
						@if(session('alert_message'))
						@includeIf('backend.pages.partials.alert_message')
						@endif
						<div class="card-box table-responsive">
							<table id="report_table" class="table table-striped table-responsive ">
								<thead>
									<tr>
										<th width="10%">ID</th>
										<th width="15%">Name</th>
										<th width="15%">Slug</th>
										<th width="30%">Description</th>
										<th width="10%">Logo</th>
										<th width="20%">Action</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')

@includeIf('backend.pages.brand.js.brand_list_js')
@includeIf('backend.pages.brand.js.brand_create_js')
@includeIf('backend.pages.brand.js.brand_edit_js')
@includeIf('backend.pages.brand.js.brand_delete_js')

@endpush