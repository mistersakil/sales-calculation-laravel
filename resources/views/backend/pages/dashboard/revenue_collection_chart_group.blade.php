<!-- Revenue collection Bar Chart Group -->
<div class="row" id="revenue_collection_chart_group">
  <div class="col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Monthly Revenue Chart<small>({{ date('Y') }})</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <form class="form-horizontal">
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-6 col-xs-12">Filter By Year</label>
              <div class="col-md-5 col-sm-5 col-xs-12">
                <select class="select2_single form-control select2_yearly_rev_chat" tabindex="-1">
                  <option value="" selected disabled>Select Year</option>
                </select>

              </div>
              <div class="col-md-1 col-sm-1 col-xs-12">
                <a class="collapse-link btn btn-info"><i class="fa fa-chevron-up"></i></a>
              </div>
            </div>
          </form>
        </ul>
        <div class="clearfix"></div>
      </div>
      <!-- /.x_title-->
      <div class="x_content">
        <div id="revenue_collection_chart_group_morris" style="width:100%; height:280px;"></div>
      </div>
      <!-- /.x_content-->
    </div>
    <!-- /.x_panel-->
  </div>
  <!-- /.col-->
</div>
<!-- /.row -->

<!-- End: Revenue collection Bar Chart -->