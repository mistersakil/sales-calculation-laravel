@extends('backend.layout.master')
@section('page_title',__('common.Collection').' '.__('common.list'))
@section('main_content')
<div class="row view_container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-capitalize">
                    @lang('common.Collection') @lang('common.list')
                    @if(!empty($collection_type))({{ $collection_type }})@endif
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a class="btn btn-primary btn_reload" title="{{ __('common.Reload') }}">
                        <i class="fa fa-refresh"></i> @lang('common.Reload')
                    </a>
                    <a class="btn btn-primary" href="{{ $collections_pending_link }}">
                        <i class="fa fa-anchor"></i>
                        @lang('common.Pending') @lang('common.Collection')
                    </a>
                    @can('create', App\Model\Collection::class)
                    <a class="btn btn-primary btn_create" >
                        <i class="fa fa-plus"></i>
                        @lang('common.Add') @lang('common.New')
                    </a>
                    @endcan
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- /.x_title -->
            @can('view_all', App\Model\Collection::class)
            <div class="x_content">
                <!-- Collectoin summary -->
                @isset($collection_total)
                <div class="row top_tiles text-center">
                    <div class="animated flipInY col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats {{ $ctype == 0 ? 'text-primary' : 'text-success'  }}">
                            <div class="count">{{ number_format($collection_total) }}</div>
                            <h2><a class="{{ $ctype == 0 ? 'text-primary' : 'text-success'  }}" href="{{ $collections_list_link }}">Total Collection</a></h2>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats {{ $ctype == 1 ? 'text-primary' : 'text-success'  }}">
                            <div class="count">{{ number_format($collection_advance) }}</div>
                            <h2><a class=" {{ $ctype == 1 ? 'text-primary' : 'text-success'  }}" href="{{ $collections_list_link.'?ctype=1' }}">Advance Collection</a></h2>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats {{ $ctype == 2 ? 'text-primary' : 'text-success'  }}">
                            <div class="count">{{ number_format($collection_postsale) }}</div>
                            <h2><a class="{{ $ctype == 2 ? 'text-primary' : 'text-success'  }}" href="{{ $collections_list_link.'?ctype=2' }}">After Implementation</a></h2>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats {{ $ctype == 3 ? 'text-primary' : 'text-success'  }}">
                            <div class="count">{{ number_format($collection_mmc) }}</div>
                            <h2><a class="{{ $ctype == 3 ? 'text-primary' : 'text-success'  }}" href="{{ $collections_list_link.'?ctype=3' }}">MMC Received</a></h2>
                        </div>
                    </div>
                </div>
                @endisset
                <!-- End: Collectoin summary -->

                <div class="row">
                    
                    <div class="col-xs-12">
                        <div class="card-box table-responsive">
                            <table id="report_table" class="table table-striped table-responsive ">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th>Company</th>
                                        <th width="10%">Amount</th>
                                        <th width="15%">Collection Type</th>
                                        <th width="15%">Collected Date</th>
                                        <th width="15%">Remark</th>
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
            @endcan
        </div>
        <!-- /.x_panel -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

@endsection
@push('scripts')
@includeIf('backend.pages.collections.js.index_js')
@includeIf('backend.pages.collections.js.create_js')
@includeIf('backend.pages.collections.js.edit_js')
@includeIf('backend.pages.collections.js.delete_js')
@endpush