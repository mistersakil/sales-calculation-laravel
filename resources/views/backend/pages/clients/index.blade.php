@extends('backend.layout.master')
@section('page_title',__('common.Clients'))
@section('main_content')
<div class="row view_container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-capitalize">{{ __('common.Clients') }}</h2>
                @can('create',App\Model\Client::class)
                <ul class="nav navbar-right panel_toolbox">
                    <a class="btn_create btn btn-primary "><i class="fa fa-plus"></i>
                        {{ __('common.Client add') }}</a>   
                </ul>
                @endcan
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card-box table-responsive">
                            @can('view_all',App\Model\Client::class)
                            <table class="table table-striped table-responsive report_table">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th>Client Name</th>
                                        <th width="14%">Country</th>
                                        <th width="10%">Status</th>
                                        <th width="13%">Created</th>
                                        <th width="13%">Updated</th>
                                        <th width="15%">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            @endcan
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@includeIf('backend.pages.clients.js.index_js')
@includeIf('backend.pages.clients.js.create_js')
@includeIf('backend.pages.clients.js.edit_js')
@includeIf('backend.pages.clients.js.delete_js')
@includeIf('backend.pages.clients.js.show_js')

@endpush