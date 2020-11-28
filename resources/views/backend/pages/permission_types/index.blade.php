@extends('backend.layout.master')
@section('page_title',__('common.Permission').' '.__('common.For').' '.__('common.list'))
@section('main_content')
<div class="row view_container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-capitalize">@lang('common.Permission') @lang('common.For') @lang('common.list')</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a class="btn btn-primary btn_reload" title="{{ __('common.Reload') }}">
                        <i class="fa fa-refresh"></i> @lang('common.Reload')
                    </a>
                    {{-- <a class="btn btn-primary btn_create">
                    	<i class="fa fa-plus"></i>
                        @lang('common.Add') @lang('common.New')
                    </a> --}}
                </ul>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card-box table-responsive">
                            <table class="table table-striped table-responsive report_table">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="">Name</th>
                                        <th width="15%" title="Number of Permissions">N.O Permissions</th>
                                        <th width="10%">Status</th>
                                        <th width="15%">Created</th>
                                        <th width="15%">Updated</th>
                                        <th width="10%">Action</th>
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

@includeIf('backend.pages.permission_types.js.index_js')
@includeIf('backend.pages.permission_types.js.delete_js')

@endpush