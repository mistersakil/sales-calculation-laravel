@extends('backend.layout.master')
@section('page_title',__('common.Account').' '.__('common.Balance'))
@section('main_content')
<div class="row view_container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-capitalize">
                @lang('common.Account') @lang('common.Balance')
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a class="btn btn-primary btn_reload" title="{{ __('common.Reload') }}">
                        <i class="fa fa-refresh"></i> @lang('common.Reload')
                    </a>
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- /.x_title -->
            <div class="x_content">
                <div class="row top_tiles" style="margin: 10px 0;">
                    <div class="col-md-3 tile text-center">
                        <h3>Total Collection</h3>
                        <h2>{{ number_format($total_collection ?? 0) }}</h2>
                        <span class="sparkline_two" style="height: 160px;">
                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                        </span>
                    </div>
                    <div class="col-md-1 tile text-center">
                        <h3 style="line-height: 100px">-</h3>
                    </div>
                    <div class="col-md-3 tile text-center">
                        <h3>Total Expense</h3>
                        <h2>{{ number_format($total_expense ?? 0) }}</h2>
                        <span class="sparkline_two" style="height: 160px;">
                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                        </span>
                    </div>
                    <div class="col-md-1 tile text-center">
                        <h3 style="line-height: 100px">=</h3>
                    </div>
                    
                    <div class="col-md-4 tile text-center">
                        <h3>Account Balance</h3>
                        <h2>{{ number_format($account_balance ?? 0) }}</h2>
                        <span class="sparkline_two" style="height: 160px;">
                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                        </span>
                    </div>
                    
                </div>
                
            </div>
            <!-- /.x_content -->
        </div>
        <!-- /.x_panel -->
    </div>
    
</div>
<!-- /.row -->
@endsection
<!-- SCRIPTES -->
@push('scripts')
{{-- @includeIf('backend.pages.account_balances.js.index_js') --}}
@endpush
<!-- END: SCRIPTES -->