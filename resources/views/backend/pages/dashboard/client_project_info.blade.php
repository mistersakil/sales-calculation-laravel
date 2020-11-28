<div class="row client_info">
  <div class="col-xs-12">
    <div class="x_panel tile ">
      <div class="x_title">
        <h2>Project Overview</h2>
        <ul class="nav navbar-right panel_toolbox">
          <a class="collapse-link btn btn-info pull-right"><i class="fa fa-chevron-up"></i></a>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="animated flipInY col-md-4 col-sm-6 col-xs-12">
            <a href="{{ $clients_list_link }}">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-sitemap text-warning"></i>
                </div>
                <div class="count">{{ $total_clients ?? 0 }}</div>
                <h3>Total Client</h3>
              </div>
            </a>
          </div>
          <div class="animated flipInY col-md-4 col-sm-6 col-xs-12">
            <a href="{{ $projects_list_link }}">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-paypal text-danger"></i>
                </div>
                <div class="count">{{ $total_projects ?? 0 }}</div>
                <h3>Total Projects</h3>
              </div>
            </a>
          </div>
          <div class="animated flipInY col-md-4 col-sm-6 col-xs-12">
            <a href="{{ $projects_list_link.'?progress_type=0' }}">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-tty text-info"></i>
                </div>
                <div class="count">{{ $initiate ?? 0 }}</div>
                <h3>Project Initiates</h3>
              </div>
            </a>
          </div>
          <div class="animated flipInY col-md-4 col-sm-6 col-xs-12">
            <a href="{{ $projects_list_link.'?progress_type=1' }}">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-space-shuttle text-primary"></i>
                </div>
                <div class="count">{{ $ongoing ?? 0 }}</div>
                <h3>Ongoing</h3>
              </div>
            </a>
          </div>
          <div class="animated flipInY col-md-4 col-sm-6 col-xs-12">
            <a href="{{ $projects_list_link.'?progress_type=2' }}">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-unlock-alt text-warning"></i>
                </div>
                <div class="count">{{ $testing ?? 0 }}</div>
                <h3>In Testing</h3>
              </div>
            </a>
          </div>
          <div class="animated flipInY col-md-4 col-sm-6 col-xs-12">
            <a href="{{ $projects_list_link.'?progress_type=3' }}">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square text-success"></i>
                </div>
                <div class="count">{{ ($live ?? 0) }}</div>
                <h3>Live</h3>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>