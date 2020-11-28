@extends('backend.layout.master')
@section('page_title',__('common.BRAND_ADD'))
@section('main_content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2 class="text-capitalize">{{ __('common.BRAND_ADD') }}</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li>
						<a href="{{ $category_create_link }}" title="{{ __('common.BRAND_ADD') }}"><i class="text-primary fa fa-plus fa-2x"></i></a>
					</li>
					<li>
						<a href="{{ $category_create_link }}" title="{{ __('common.CATEGORY_LIST') }}"><i class="text-success fa fa-th-list fa-2x"></i></a>
					</li>
					<li>
						<a class="collapse-link" title="{{ __('common.COLLAPSE_SECTION') }}"><i class="text-warning fa-2x fa fa-chevron-up"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				@if(session('msg'))
				<div class="alert alert-success alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
					</button>
					<strong>@lang('common.SUCCESS')</strong>
				</div>
				@endif
				@if(count($errors) > 0)
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
					</button>
					<strong>@lang('errors.PLEASE_FIX_ALL_ERROR')</strong>
				</div>
				@endif
				
				<form method="post" action="{{ route('admin.brands.store') }}"  class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
					@csrf
					<div class="col-md-8 col-sm-12  form_area">
						<!-- Name -->
						<div class="item form-group">
							<div class="col-xs-12">
								<label class="control-label" for="name">@lang('common.NAME')
									<span class="required">*</span>
								</label>
								<input value="{{ old('name') }}" type="text" id="name" name="name" class="form-control" required="required">
								<span class="help-block"><span class=" @if($errors->has('name')) {{ 'text-danger' }} @else {{ 'text-info' }} @endif">@if($errors->has('name')) {{ $errors->first('name') }} @else {{ __('common.PLEASE_ADD_NAME') }} @endif </span></span>
							</div>
							
						</div>
						<!-- Body -->
						<div class="item form-group">
							<div class="col-xs-12">
								<label class="control-label" for="body">@lang('common.DESCRIPTION')
								</label>
								<textarea rows="5" id="body" name="body" class="form-control" required="required">{{ old('body') }}</textarea>
								<span class="help-block"><span class=" @if($errors->has('body')) {{ 'text-danger' }} @else {{ 'text-info' }} @endif"> @if($errors->has('body')) {{$errors->first('body') }} @else {{ __('common.PLEASE_ADD_DESCRIPTION') }} @endif </span></span>
							</div>
						</div>
						
					</div>
					
					<div class="col-md-4 col-sm-12  form_area">
						
						<!-- Image -->
						<div class="item form-group">
							<div class="col-xs-12">
								<label class="control-label" for="image">@lang('common.IMAGE')
								</label>
								<input value="{{ old('image') }}" type="file" id="image" name="image" class="form-control" required="required">
								<span class="help-block"><span class="@if($errors->has('image')) {{ 'text-danger' }} @else {{ 'text-info' }} @endif">@if($errors->has('image')) {{$errors->first('image') }} @else {{ __('common.PLEASE_ADD_IMAGE') }} @endif</span></span>
							</div>
						</div>
						<!-- Published   -->
						<div class="form-group">
							<div class="col-md-9 col-sm-9 col-xs-12">
								<div class="">
									
									<p>
										<strong>@lang('common.PUBLISHED')</strong>
										
										<input type="radio" class="flat" name="published" id="pub_yes" value="1" checked="" required /> @lang('common.YES')
										<input type="radio" class="flat" name="published" id="pub_no" value="0" /> @lang('common.NO')
									</p>
								</div>
							</div>
						</div>
						
						<hr>
						<div class="form-group">
							<div class="col-xs-12 col-md-offset-0">
								<button type="reset" class="btn btn-warning pull-right"> @lang('common.CLEAR')</button>
								<button id="send" type="submit" class="btn btn-primary"> @lang('common.SAVE')</button>
							</div>
						</div>
					</div>
				</form>
				
			</div>
		</div>
	</div>
</div>
@endsection