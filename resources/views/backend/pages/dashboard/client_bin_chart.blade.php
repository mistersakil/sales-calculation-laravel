<!-- Client BIN chart  -->
<div class="row" id="client_bin">
  <div class="col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>@lang('common.Client') @lang('common.Chart')</h2>
        <ul class="nav navbar-right panel_toolbox">
          <form class="form-horizontal">
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-6 col-xs-12">Filter By Year</label>
              <div class="col-md-5 col-sm-5 col-xs-12">
                <select class="select2_single form-control client_bin_year" tabindex="-1">
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
        <div id="client_bin_chart" style="width:100%; height:280px;"></div>
      </div>
      <!-- /.x_content-->
    </div>
    <!-- /.x_panel-->
  </div>
  <!-- /.col-->
</div>
<!-- /.row -->

<!-- End: Client BIN chart  -->