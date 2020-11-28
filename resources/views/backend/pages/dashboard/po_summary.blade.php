<div class="row po_summary">
  <div class="col-xs-12">
    <div class="x_panel tile ">
      <div class="x_title">
        @php $month = strtolower(date('F')); @endphp
        <h2>UYVMS @lang('common.Po') @lang('common.Summary')<small>( @lang('common.last') @lang('common.30') @lang('common.days') )</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <form class="form-horizontal">
            <fieldset>
              <div class="control-group">
                <div class="controls">
                  <label for="daterange_po_summary" class="daterange_label">Filter by Date: </label>
                  <div class="input-prepend input-group   pull-right">
                    <input type="text" style="width: 200px" name="daterange_po_summary" id="daterange_po_summary"
                    class="form-control" value="{{ date('m/d/Y - m/d/Y') }}" />
                    &nbsp; <a class="collapse-link btn btn-info"><i class="fa fa-chevron-up"></i></a>
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
          
        </ul>
        <div class="clearfix"></div>
      </div>
      <!-- /.x_title -->
      <a class="collection_details" href="">
        <div class="x_content">
          
        </div>
      </a>
      <!-- /.x_content -->
    </div>
    <!-- /.x_panel -->
  </div>
</div>
<!-- /.row -->