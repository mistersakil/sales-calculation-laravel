@extends('backend.layout.master')
@section('page_title',__('common.DASHBOARD'))
@section('main_content')
<div id="view_container">
  
</div>
<!-- Client project information -->
@can('project_overview', App\Model\User::class) 
@includeIf('backend.pages.dashboard.client_project_info')
@endcan
<!-- End: Client project information -->

<!-- UYVMS Revenue Summary -->
@can('vms_revenue_summary', App\Model\User::class) 
@includeIf('backend.pages.dashboard.summary1')
@endcan
<!-- End: UYVMS Revenue Summary -->

<!-- Accumulated revenue -->
@can('accumulated_revenue', App\Model\User::class) 
@includeIf('backend.pages.dashboard.summary2')
@endcan
<!-- End: Accumulated revenue-->

<!-- project_collection_tree -->
<div class="row hidden" id="project_collection_tree">
  <div class="col-xs-12">
    <div class="x_panel tile ">
      <div class="x_title">
        <h2>@lang('common.Collection') @lang('common.Graph')</h2>
        <ul class="nav navbar-right panel_toolbox">
          <a class="collapse-link btn btn-info pull-right"><i class="fa fa-chevron-up"></i></a>
        </ul>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
          <div class="treant_chart" id="tree_container"> Project Collection Tree </div>
        </div>
    </div>
  </div>
</div>
<!-- End: project_collection_tree -->
<!-- PO Summery -->
@can('vms_po_summary', App\Model\User::class)    
@includeIf('backend.pages.dashboard.po_summary')
@endcan
<!-- End:  PO Summery -->

{{-- @includeIf('backend.pages.dashboard.revenue_collection_chart_group') --}}
<!-- Service Charge -->
@can('service_charge', App\Model\User::class)    
@includeIf('backend.pages.dashboard.service_charge')
@endcan
<!-- End: Service Charge -->
<!-- Client Chart -->
@can('client_chart', App\Model\User::class)    
@includeIf('backend.pages.dashboard.client_bin_chart')
@endcan
<!-- End: Client Chart -->

@endsection
@push('scripts')
@includeIf('backend.pages.dashboard.js.project_collection_tree_js')
@includeIf('backend.pages.dashboard.js.po_summary_js')
@includeIf('backend.pages.dashboard.js.summary1_js')
{{-- @includeIf('backend.pages.dashboard.js.revenue_collection_chart_js') --}}
{{-- @includeIf('backend.pages.dashboard.js.revenue_collection_chart_group_js') --}}
@includeIf('backend.pages.dashboard.js.client_bin_chart_js')
@includeIf('backend.pages.dashboard.js.service_charge_js')
@includeIf('backend.pages.dashboard.js.summary2_js')
@includeIf('backend.pages.dashboard.js.index_js')
<script>
    new Treant( chart_config );
    /* Counter Generator */
    $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
  });
</script>
@endpush