@extends('backend.layout.master')
@section('page_title',__('common.Permission').' '.__('common.list'))
@section('main_content')
<div class="row view_container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-capitalize">@lang('common.Permission') @lang('common.list')</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a class="btn btn-primary btn_reload" title="{{ __('common.Reload') }}">
                        <i class="fa fa-refresh"></i> @lang('common.Reload')
                    </a>
                    @can('generate', App\Model\Permission::class)  
                    <a class="btn btn-primary btn_generate">
                    	<i class="fa fa-plus"></i>
                        @lang('common.Generate') @lang('common.Permissions')
                    </a>
                    @endcan
                    @can('create_new', App\Model\Permission::class)  
                    <a class="btn btn-primary btn_create">
                        <i class="fa fa-plus"></i>
                        @lang('common.Add') @lang('common.New')
                    </a>
                    @endcan
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
                                        <th>Name</th>
                                        <th width="10%" title="Assigned to Roles">Assigned</th>
                                        <th width="15%">For</th>
                                        <th width="10%">Status</th>
                                        <th width="12%">Create</th>
                                        <th width="12%">Updated</th>
                                        <th width="15%">Action</th>
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

@includeIf('backend.pages.permissions.js.index_js')
@includeIf('backend.pages.permissions.js.generate_js')
@includeIf('backend.pages.permissions.js.create_js')
@includeIf('backend.pages.permissions.js.edit_js')
@includeIf('backend.pages.permissions.js.delete_js')

@endpush