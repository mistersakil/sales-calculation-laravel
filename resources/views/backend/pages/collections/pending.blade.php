@extends('backend.layout.master')
@section('page_title',__('common.Pending').' '.__('common.Collections'))
@section('main_content')
<div class="row view_container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-capitalize">
                @lang('common.Advance') @lang('common.Pending')
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a class="btn btn-info" href="{{ $collections_list_link }}">
                        <i class="fa fa-plus"></i>
                        @lang('common.Add') @lang('common.Collection')
                    </a>
                    <a class="collapse-link btn btn-info pull-right">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card-box table-responsive">
                            <table id="report_table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th>Company</th>
                                        <th>Product</th>
                                        <th class="text-center">PO Value</th>
                                        <th class="text-center">Advance Pending</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($projects)
                                    @php $total_pending = 0; @endphp
                                    @foreach($projects as $single)
                                    @php
                                    
                                    $advance = $single->collections()->selectRaw('sum(amount) as advance_collection')->where('collection_type',1)->get()->toArray();
                                    $advance_received = $advance[0]['advance_collection'];
                                    $advace_amount = $single->advance_amount;
                                    if($advance_received) {
                                        $advace_pending = $advace_amount - $advance_received ;
                                    }else{
                                       $advace_pending =  $advace_amount;
                                    }
                                    if($single->advance_amount == 0 || $advace_pending == 0){
                                        continue;
                                    }

                                    $total_pending += $advace_pending;
                                    @endphp
                                    <tr>
                                        <td>{{ $single->id }}</td>
                                        <td>{{ $single->client->name }}</td>
                                        <td>{{ $single->product->name }}</td>
                                        <td class="text-center">{{ number_format($single->total_amount) }}</td>
                                        <th class="text-center">{{ number_format($advace_pending) }}</th>
                                        <th class="text-center">
                                            <button data-product="{{ $single->product->name }}" data-client="{{ $single->client->name }}" data-type="1" data-id="{{ $single->id }}" data-amount="{{ $advace_pending }}" title="Add To Collection" class="btn_add_pending btn-success">
                                            <i class="fa fa-check"></i>
                                            </button>
                                        </th>
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <th class="text-center">Total: {{ number_format($total_pending ?? 0) }}</th>
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
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-capitalize">
                @lang('common.Pending') @lang('common.On') @lang('common.Po')
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a class="collapse-link btn btn-info pull-right">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card-box table-responsive">
                            <table id="report_table" class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th>Company</th>
                                        <th>Product</th>
                                        <th>PO Value</th>
                                        <th>Pending on PO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($projects)
                                    @php
                                    $total_amount = $total_pending = 0;
                                    @endphp
                                    @foreach($projects as $single)
                                    @php
                                    $collections = $single->collections()->selectRaw('sum(amount) as amount')->whereBetween('collection_type',[1,2])->get()->toArray();
                                    $collection = $collections[0]['amount'];
                                    $single_total = $single->total_amount;
                                    if($collection !=0 ){
                                        $pending_on_po = $single_total - $collection;
                                    }else{
                                        $pending_on_po = $single_total - $single->advance_amount;
                                    }
                                    if($single_total == 0 || $collection == $single->total_amount){
                                        continue;
                                    }
                                    $total_amount += $single_total;
                                    $total_pending += $pending_on_po;
                                    @endphp
                                    <tr>
                                        <td>{{ $single->id }}</td>
                                        <td>{{ $single->client->name }}</td>
                                        <td>{{ $single->product->name }}</td>
                                        <td>{{ number_format($single_total) }}</td>
                                        <td>
                                            @if($single_total == $pending_on_po)
                                            <span class="badge">
                                                @else
                                                <span>
                                                    @endif
                                                    {{ number_format($pending_on_po) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endisset
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ number_format($total_amount) ?? 0 }}</td>
                                        <td>{{ number_format($total_pending) ?? 0 }}</td>
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

@includeIf('backend.pages.collections.js.pending_js')

@endpush