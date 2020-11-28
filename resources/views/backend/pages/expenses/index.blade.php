@extends('backend.layout.master')
@section('page_title',__('common.Expense').' '.__('common.list'))
@section('main_content')
<div class="row view_container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-capitalize">
                    @lang('common.Expense') @lang('common.list')
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a class="btn btn-primary btn_reload" title="{{ __('common.Reload') }}">
                        <i class="fa fa-refresh"></i> @lang('common.Reload')
                    </a>
                    @can('create', App\Model\Expense::class)                    
                    <a class="btn btn-primary btn_create" >
                        <i class="fa fa-plus"></i>
                        @lang('common.Add') @lang('common.New')
                    </a>
                    @endcan
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- /.x_title -->

            <div class="x_content">
               

                <div class="row">
                    
                    <div class="col-xs-12">
                        <div class="card-box table-responsive">
                            <table class="table table-striped table-responsive report_table">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th>Title</th>
                                        <th width="10%">Amount</th>
                                        <th width="15%">Type</th>
                                        <th width="15%">Status</th>
                                        <th width="15%">Expense Date</th>
                                        <th width="10%">Action</th>
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
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.x_content -->
        </div>
        <!-- /.x_panel -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

@endsection
@push('scripts')
@includeIf('backend.pages.expenses.js.index_js')
@includeIf('backend.pages.expenses.js.create_js')
@includeIf('backend.pages.expenses.js.edit_js')
@includeIf('backend.pages.expenses.js.delete_js')
@endpush