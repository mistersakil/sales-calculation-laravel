@extends('backend.layout.master')
@section('page_title',__('common.Service').' '.__('common.Charge').' '.__('common.list'))
@section('main_content')
<div class="row view_container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-capitalize">@lang('common.Service') @lang('common.Charge') @lang('common.list')</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a class="btn btn-primary btn_reload" title="{{ __('common.Reload') }}">
                        <i class="fa fa-refresh"></i> @lang('common.Reload')
                    </a>                    
                    <a class="btn btn-primary" href="{{ $service_charges_current_link }}">
                        <i class="fa fa-clock-o"></i>
                        @lang('common.'.date('F'))
                    </a>                    
                    <a class="btn btn-primary" href="{{ $service_charges_pending_link }}">
                        <i class="fa fa-bell"></i>
                        @lang('common.Pending')
                    </a>
                    @can('create', App\Model\Project::class)  
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
                            <table id="report_table" class="table table-striped table-responsive ">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th>Client</th>
                                        <th>Amount</th>
                                        <th>Start date</th>
                                        <th>Pay schedule</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
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

@includeIf('backend.pages.service_charges.js.index_js')
@includeIf('backend.pages.service_charges.js.create_js')
@includeIf('backend.pages.service_charges.js.edit_js')
@includeIf('backend.pages.service_charges.js.delete_js')

@endpush