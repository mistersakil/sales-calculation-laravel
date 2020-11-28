@extends('backend.layout.master')
@section('page_title',__('common.Service').' '.__('common.Service').' '.__('common.Current'))
@section('main_content')
<div class="row view_container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-capitalize">
                    @lang('common.Service') @lang('common.Charge')<small>({{ date('F') }})</small>
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a class="btn btn-primary btn_reload" title="{{ __('common.Reload') }}">
                        <i class="fa fa-refresh"></i> @lang('common.Reload')
                    </a>
                    <a class="btn btn-primary" href="{{ $service_charges_pending_link }}">
                        <i class="fa fa-bell"></i>
                        @lang('common.Pending')
                    </a>
                    @can('view_all', App\Model\ServiceCharge::class)  
                    <a class="btn btn-primary" href="{{ $service_charges_list_link }}">
                        <i class="fa fa-bars"></i>
                        @lang('common.List')
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
                                        <th width="18%">Client</th>
                                        <th width="5%" title="Product Code">Code</th>
                                        <th width="10%">Charge</th>
                                        <th width="10%" title="Pay Schedule">Schedule</th>
                                        <th width="10%" title="Started">Started</th>
                                        <th width="20%" title="Total Pending Amount">Total Pending</th>
                                        <th width="12%">Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
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

@includeIf('backend.pages.service_charges.js.current_month_js')
@includeIf('backend.pages.service_charges.js.receive_js')
@includeIf('backend.pages.service_charges.js.pending_js')

@endpush