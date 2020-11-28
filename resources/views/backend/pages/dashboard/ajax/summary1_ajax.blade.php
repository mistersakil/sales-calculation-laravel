<!-- top tiles -->
<div class="tile_count">
  <div class="col-md-2 col-sm-6 col-xs-12 tile_stats_count text-center">
    <a href="{{ $projects_list_link }}">
    <span class="count_top">VMS @lang('common.Total') @lang('common.Bin')</span>
    <div class="count counter blue">
      {{ $po_total_unit ?? 0 }}
    </div>
    </a>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count text-center">
    <a href="{{ $projects_list_link }}">
    <span class="count_top">VMS Total Value</span>
    <div class="count counter green">
      {{ $po_value ?? 0  }}
    </div>  
    </a>  
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count text-center">
    <a href="{{ $collections_list_link }}">    
    <span class="count_top">VMS Total Received</span>
    <div class="count counter red">
      {{ ($advance_postsale_collection ?? 0 ) }}
    </div>
    </a>    
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12 tile_stats_count text-center">
    <a href="{{ $collections_pending_link }}">    
    <span class="count_top">VMS Total Pending</span>
    <div class="count counter text-warning">
      {{ ( $advance_postsale_pending ?? 0 ) }}
    </div>
    </a>
  </div>
</div>
<!-- /top tiles -->

<script>
    /* Counter Generator */
    $('.counter').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 5000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now).toLocaleString('en'));
        }
    });
  });
</script>