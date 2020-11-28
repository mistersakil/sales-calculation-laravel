@extends('backend.layout.master')
@section('page_title',__('common.Amc').' '.__('common.Pending').' '.__('common.Summary'))
@section('main_content')
<div class="row view_container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-capitalize">
                @lang('common.Amc') @lang('common.Pending') @lang('common.Summary')
                @if(!empty($collection_type))({{ $collection_type }})@endif
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a class="btn btn-primary btn_reload" title="{{ __('common.Reload') }}">
                        <i class="fa fa-refresh"></i> @lang('common.Reload')
                    </a>
                    <a class="btn btn-primary" href="{{ $service_charges_current_link }}">
                        <i class="fa fa-clock-o"></i>
                        @lang('common.'.date('F'))
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
            <!-- /.x_title -->
            @can('view_all', App\Model\Collection::class)
            <div class="x_content">
                <!-- Collectoin summary -->
                @isset($expected)
                <div class="row top_tiles text-center">
                    <div class="animated flipInY col-md-4 col-sm-6 col-xs-12">
                        <div class="tile-stats text-info">
                            <div class="count">{{ number_format($expected) }}</div>
                            <h2>Amc Total Amount</h2>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-4 col-sm-6 col-xs-12">
                        <div class="tile-stats text-success">
                            <div class="count">{{ number_format($collected) }}</div>
                            <h2>Amc Total Collected Amount</h2>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-4 col-sm-6 col-xs-12">
                        <div class="tile-stats text-warning">
                            <div class="count">{{ number_format($pending) }}</div>
                            <h2>Amc Total Pending Amount</h2>
                        </div>
                    </div>
                </div>
                @endisset
                <!-- End: Collectoin summary -->
                <h2 class="well">AMC Applicable Clients</h2>
                <div class="row">
                    
                    <div class="col-xs-12">
                        <div class="card-box table-responsive">
                            <table class="table table-striped table-responsive report_table">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th>Client</th>
                                        <th>Product Code</th>
                                        <th width="10%">Amount</th>
                                        <th width="15%">Pay Schedule</th>
                                        <th width="15%">Starting From</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($pending_list)
                                    @foreach($pending_list as $single)
                                    <tr>
                                        <td>{{ $single->id }}</td>
                                        <td>{{ $single->project->client->name }}</td>
                                        <td>{{ $single->project->product->code }}</td>
                                        <td>{{ $single->amount }}</td>
                                        <td>
                                            @if($single->pay_schedule == 1)
                                            <span class="label label-primary">
                                                {{ $single->pay_schedule()[$single->pay_schedule] }}
                                            </span>
                                            @elseif($single->pay_schedule == 2)
                                            <span class="label label-danger">
                                                {{ $single->pay_schedule()[$single->pay_schedule] }}
                                            </span>
                                            @else
                                            <span class="label label-success">
                                                {{ $single->pay_schedule()[$single->pay_schedule] }}
                                            </span>
                                            @endif
                                        </td>
                                        <td>{{ _custom_date_time($single->start_date,'F Y') }}</td>
                                        <td>
                                            <a  title="{{ __('common.Pending') }}" class="btn btn-warning btn-xs btn_pending" data-id="{{ $single->id }}">
                                                <i class="fa fa-anchor"></i>
                                                @lang('common.Pending')
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset
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
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.x_content -->
            @endcan
        </div>
        <!-- /.x_panel -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection
@push('scripts')
@includeIf('backend.pages.service_charges.js.pending_js')
@endpush