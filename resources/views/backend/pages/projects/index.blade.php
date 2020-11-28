@extends('backend.layout.master')
@section('page_title',__('common.PROJECT_LIST'))
@section('main_content')
<div class="row view_container" id="view_container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-capitalize">
                {{ __('common.PROJECT_LIST') }}
                @if(!empty($progress_type_name))({{ $progress_type_name }})@endif
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    @can('create', App\Model\Project::class)  
                    <a class="btn btn-primary" id="modal_for_create"><i class="fa fa-plus"></i>
                    {{ __('common.PROJECT_ADD') }}</a>
                    @endcan
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <!--
                <div class="row text-center">
                    <a class="btn btn-app" href="{{ $clients_list_link }}">
                        <span class="badge bg-red">6</span>
                        <i class="fa fa-bullhorn"></i> Total Client
                    </a>
                    <a class="btn btn-app" href="{{ $projects_list_link }}">
                        <span class="badge bg-green">56</span>
                        <i class="fa fa-users"></i> Total Projects
                    </a>
                    <a class="btn btn-app">
                        <span class="badge bg-primary">85 million</span>
                        <i class="fa fa-users"></i> Projects Total Value
                    </a>
                    <a class="btn btn-app">
                        <span class="badge bg-blue">6</span>
                        <i class="fa fa-bullhorn"></i> Total BIN
                    </a>
                    <a class="btn btn-app" href="{{ $projects_list_link.'?progress_type=0' }}">
                        <span class="badge bg-orange">32</span>
                        <i class="fa fa-inbox"></i> Project Initiates
                    </a>
                    <a class="btn btn-app" href="{{ $projects_list_link.'?progress_type=1' }}">
                        <span class="badge bg-primary">12</span>
                        <i class="fa fa-envelope"></i> Ongoing Projects
                    </a>
                    <a class="btn btn-app" href="{{ $projects_list_link.'?progress_type=2' }}">
                        <span class="badge bg-blue">102</span>
                        <i class="fa fa-heart-o"></i> Projects In-testing
                    </a>
                    <a class="btn btn-app" href="{{ $projects_list_link.'?progress_type=3' }}">
                        <span class="badge bg-red">102</span>
                        <i class="fa fa-heart-o"></i> Live Projects
                    </a>
                    <a class="btn btn-app">
                        <span class="badge bg-green">102</span>
                        <i class="fa fa-heart-o"></i> MMC Applicable
                    </a>
                </div>
            -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card-box table-responsive">
                            <table id="report_table" class="table table-striped table-responsive ">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="25%">Project Info</th>
                                        <th width="22%">Amount Summery</th>
                                        <th width="18%">Other Info</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Project Info</th>
                                    <th>Amount Summery</th>
                                    <th>Other Info</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
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
@includeIf('backend.pages.projects.js.index_js')
@includeIf('backend.pages.projects.js.create_js')
@includeIf('backend.pages.projects.js.edit_js')
@includeIf('backend.pages.projects.js.delete_js')
@endpush