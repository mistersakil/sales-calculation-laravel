@extends('backend.layout.master')
@section('page_title',__('common.Employees'))
@section('main_content')
<div class="row" id="view_container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-capitalize">{{ __('common.Employees') }}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a class="btn btn-primary" id="modal_for_create"><i class="fa fa-plus"></i>
                        {{ __('common.Employees add') }}</a>
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
                                        <th width="20%" title="Employe Name">Name</th>
                                        <th width="15%">Designation</th>
                                        <th width="10%">Phone</th>
                                        <th width="10%">Email</th>
                                        <th width="10%" title="Employe Joining Date">Joining</th>
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

@includeIf('backend.pages.employees.js.index_js')
@includeIf('backend.pages.employees.js.create_js')
@includeIf('backend.pages.employees.js.edit_js')
@includeIf('backend.pages.employees.js.delete_js')

@endpush