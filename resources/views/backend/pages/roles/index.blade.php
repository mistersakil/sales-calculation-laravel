@extends('backend.layout.master')
@section('page_title',__('common.Role').' '.__('common.list'))
@section('main_content')
<div class="row view_container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-capitalize">@lang('common.Role') @lang('common.list')</h2>
                <ul class="nav navbar-right panel_toolbox">
                    @can('create', App\Model\Role::class) 
                    <a class="btn btn-primary btn_create" >
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
                                        <th width="8" title="Number of Users">Users</th>
                                        <th width ="12%" title="Number of Permissions">Permissions</th>
                                        <th width="25%">Description</th>
                                        <th width="10%">Status</th>
                                        <th width="12%">Updated</th>
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

@includeIf('backend.pages.roles.js.index_js')
@includeIf('backend.pages.roles.js.create_js')
@includeIf('backend.pages.roles.js.edit_js')
@includeIf('backend.pages.roles.js.delete_js')

@endpush