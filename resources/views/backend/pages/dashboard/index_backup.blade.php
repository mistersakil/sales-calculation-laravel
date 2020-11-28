@extends('backend.layout.master')
@section('page_title',__('common.DASHBOARD'))
@section('main_content')

<!-- Revenue Collection Report -->
<div class="row">
  <div class="col-xs-12">
    <div class="x_panel tile ">
      <div class="x_title">
        <h2>Revenue Collection Report<small>({{ date('F') }})</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <form class="form-horizontal">
            <fieldset>
              <div class="control-group">
                <div class="controls">
                  <div class="input-prepend input-group   pull-right">
                    <input type="text" style="width: 200px" name="daterange_revenue" id="daterange_revenue"
                    class="form-control pull-right" value="{{ date('m/d/Y - m/d/Y') }}" />
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <!-- top tiles -->
        <div class="tile_count">
          <div class="col-md-2 col-sm-6 col-xs-12 tile_stats_count text-center">
            <span class="count_top">PO Received</span>
            <div class="count blue"><span>#</span>@isset($po_received){{ $po_received }}@endisset</div>
            
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count text-center">
            <span class="count_top">PO Value</span>
            <div class="count green"><span>ট</span>@isset($po_value){{ number_format($po_value) }}@endisset</div>
            
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count text-center">
            <span class="count_top">Received Amount</span>
            <div class="count red"><span>ট</span>@isset($received_amount){{ number_format($received_amount) }}@endisset</div>
            
          </div>
          <div class="col-md-4 col-sm-6 col-xs-12 tile_stats_count text-center">
            <span class="count_top">Pending Amount</span>
            <div class="count text-warning"><span>ট</span>@isset($pending_amount){{ number_format($pending_amount) }}@endisset</div>
            
          </div>
        </div>
        <!-- /top tiles -->
      </div>
    </div>
  </div>
</div>
<!-- Revenue collection bar chart -->
<div class="row">
  <div class="col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Revenue Collection Chart<small>({{ date('Y') }})</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li>
            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="#">Settings 1</a>
              </li>
              <li>
                <a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div id="graph" style="width:100%; height:280px;"></div>
      </div>
    </div>
  </div>
  <!-- /line graph -->
</div>
<!-- /.row -->

<!-- Service Charge -->
<div class="row">
  <div class="col-xs-12">
    <div class="x_panel tile ">
      <div class="x_title">
        <h2>Service Charge ({{ date('F') }})</h2>
        <ul class="nav navbar-right panel_toolbox">
          <form class="form-horizontal">
            <fieldset>
              <div class="control-group">
                <div class="controls">
                  <div class="input-prepend input-group   pull-right">
                    <input type="text" style="width: 200px" name="reservation" id="reservation"
                    class="form-control pull-right" value="{{ date('m/d/Y - m/d/Y') }}" />
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <!-- top tiles -->
        <div class="row top_tiles">
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              {{-- <div class="icon"><i class="fa fa-money"></i></div> --}}
              <div class="count red">9,000,000</div>
              <h3>This Month <small><a href="">(Details)</a></small></h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              {{-- <div class="icon"><i class="fa fa-check"></i></div> --}}
              <div class="count green">700,000</div>
              <h3>Collected</h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              {{-- <div class="icon"><i class="fa fa-ellipsis-h"></i></div> --}}
              <div class="count blue">190,000</div>
              <h3>Pending</h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              {{-- <div class="icon"><i class="fa fa-smile-o"></i></div> --}}
              <div class="count">179,000,000</div>
              <h3>Total Collected</h3>
            </div>
          </div>
        </div>
        <!-- /top tiles -->
      </div>
    </div>
  </div>
</div>
<!-- Service Charge collection bar chart -->
<div class="row">
  <div class="col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Service Charge Collection Chart<small>({{ date('Y') }})</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li>
            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="#">Settings 1</a>
              </li>
              <li>
                <a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div id="service_charge_graph" style="width:100%; height:280px;"></div>
      </div>
    </div>
  </div>
  <!-- /line graph -->
</div>
<!-- /.row -->
<!-- Client -->
<div class="row">
  <div class="col-xs-12">
    <div class="x_panel tile ">
      <div class="x_title">
        <h2>Our Clients</h2>
        <ul class="nav navbar-right panel_toolbox">
          <form class="form-horizontal">
            <fieldset>
              <div class="control-group">
                <div class="controls">
                  <div class="input-prepend input-group   pull-right">
                    <input type="text" style="width: 200px" name="reservation" id="reservation"
                    class="form-control pull-right" value="{{ date('m/d/Y - m/d/Y') }}" />
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <!-- top tiles -->
        <div class="row top_tiles">
          <div class="animated flipInY col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
              {{-- <div class="icon"><i class="fa fa-money"></i></div> --}}
              <div class="count red">220</div>
              <h3>Live <small><a href="">(Details)</a></small></h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
              {{-- <div class="icon"><i class="fa fa-check"></i></div> --}}
              <div class="count green">70</div>
              <h3>Ongoing <small><a href="">(Details)</a></small></h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
              {{-- <div class="icon"><i class="fa fa-ellipsis-h"></i></div> --}}
              <div class="count blue">190</div>
              <h3>Pending <small><a href="">(Details)</a></small></h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
              {{-- <div class="icon"><i class="fa fa-ellipsis-h"></i></div> --}}
              <div class="count green">10</div>
              <h3>Last <small><a href="">(Details)</a></small></h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
              {{-- <div class="icon"><i class="fa fa-ellipsis-h"></i></div> --}}
              <div class="count blue">5</div>
              <h3>Top <small><a href="">(Details)</a></small></h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
              {{-- <div class="icon"><i class="fa fa-smile-o"></i></div> --}}
              <div class="count">500</div>
              <h3>Total <small><a href="">(Details)</a></small></h3>
            </div>
          </div>
        </div>
        <!-- /top tiles -->
      </div>
    </div>
  </div>
</div>
<!-- Our Office -->
<div class="row">
  <div class="col-xs-12">
    <div class="x_panel tile ">
      <div class="x_title">
        <h2>Our Office</h2>
        <ul class="nav navbar-right panel_toolbox">
          <form class="form-horizontal">
            <fieldset>
              <div class="control-group">
                <div class="controls">
                  <div class="input-prepend input-group   pull-right">
                    <input type="text" style="width: 200px" name="reservation" id="reservation"
                    class="form-control pull-right" value="{{ date('m/d/Y - m/d/Y') }}" />
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <!-- top tiles -->
        <div class="row top_tiles">
          <div class="animated flipInY col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
              {{-- <div class="icon"><i class="fa fa-money"></i></div> --}}
              <div class="count red">220</div>
              <h3><i class="fa fa-eye"></i> Employees</h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
              {{-- <div class="icon"><i class="fa fa-check"></i></div> --}}
              <div class="count green">70</div>
              <h3><i class="fa fa-eye"></i> Office Certificate</h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
              {{-- <div class="icon"><i class="fa fa-ellipsis-h"></i></div> --}}
              <div class="count blue">190</div>
              <h3><i class="fa fa-eye"></i> References</h3>
            </div>
          </div>
          <div class="animated flipInY col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
              {{-- <div class="icon"><i class="fa fa-ellipsis-h"></i></div> --}}
              <div class="count green">10</div>
              <h3><i class="fa fa-eye"></i> Products</h3>
            </div>
          </div>
          
        </div>
        <!-- /top tiles -->
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
$(function() {
$('#daterange_two').daterangepicker({
opens: 'left'
}, function(start, end, label) {
console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
});
$('#daterange_revenue').daterangepicker({
opens: 'left'
}, function(start, end, label) {
console.log("Revenue date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
});
// Revenue Collection Chart Morris.Bar
  Morris.Bar({
    element: 'graph',
    data: [
      {x: 'Jan', y: 600000},
      {x: 'Feb', y: 450000},
      {x: 'Mar', y: 650000},
      {x: 'Apr', y: 700000},
      {x: 'May', y: 910000},
      {x: 'Jun', y: 650000},
      {x: 'Jul', y: 800000},
      {x: 'Aug', y: 700000},
      {x: 'Sep', y: 600000},
      {x: 'Oct', y: 650000},
      {x: 'Nov', y: 600000},
      {x: 'Dec', y: 750000},
    ],
    xkey: 'x',
    ykeys: ['y'],
    labels: ['Collection']
  }).on('click', function(i, row){
    console.log(i, row);
  });
  // service_charge_graph Morris.Bar
  Morris.Bar({
    element: 'service_charge_graph',
    data: [
      {x: 'Jan', y: 600000},
      {x: 'Feb', y: 450000},
      {x: 'Mar', y: 650000},
      {x: 'Apr', y: 700000},
      {x: 'May', y: 910000},
      {x: 'Jun', y: 650000},
      {x: 'Jul', y: 800000},
      {x: 'Aug', y: 700000},
      {x: 'Sep', y: 600000},
      {x: 'Oct', y: 650000},
      {x: 'Nov', y: 600000},
      {x: 'Dec', y: 750000},
    ],
    xkey: 'x',
    ykeys: ['y'],
    labels: ['Collection']
  }).on('click', function(i, row){
    console.log(i, row);
  });

  
});
</script>
@endpush