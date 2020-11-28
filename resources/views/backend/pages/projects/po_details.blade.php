@extends('backend.layout.master')
@section('page_title',__('common.Po').' '.__('common.Details'))
@section('main_content')
<div class="row view_container" id="view_container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-capitalize">
                @lang('common.Po') @lang('common.Details')
                <small>( {{ date_format(date_create($date_start),'d M, Y') .' - '.date_format(date_create($date_end),'d M, Y') }} )</small>

                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a class="btn btn-primary" id="modal_for_create" href="{{ $projects_list_link }}"><i class="fa fa-plus"></i>
                        {{ __('common.PROJECT_ADD') }}</a>
                </ul>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-xs-12">

                        @if(session('alert_message'))
                        @includeIf('backend.pages.partials.alert_message')
                        @endif
                        <div class="card-box table-responsive">
                            <table id="report_table" class="table table-striped table-responsive ">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th>Company</th>
                                        <th>BIN</th>
                                        <th class="text-center">PO Value </th>
                                        <th>Advance Received</th>
                                        <th>Advance Pending</th>
                                        <th>Pending on PO</th>
                                        <th>PO Date</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Amount</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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

@includeIf('backend.pages.projects.js.po_details_js')

@endpush