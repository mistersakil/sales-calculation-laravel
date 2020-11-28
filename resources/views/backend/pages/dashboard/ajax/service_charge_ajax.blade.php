<div class="tile_count">
  @php $current_month = date('F'); @endphp
  <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count text-center">
    <div class="col-xs-12">
      
      <a href="{{ $service_charges_list_link }}">
        <span class="count_top"> @lang('common.Total') @lang('common.Mmc')</span>
        <div class="count blue">
          {{ $mmc_total ?? 0  }}
        </div>
      </a>
    </div>
    <div class="col-xs-12">
      
      <a href="{{ $service_charges_list_link }}">
        <span class="count_top"> @lang('common.Total') @lang('common.Mmc') @lang('common.Value')</span>
        <div class="count blue">
          {{ number_format($mmc_total_value) ?? 0  }}
        </div>
      </a>
    </div>
  </div>
  <!-- /.tile_stats_count -->
  <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count text-center">
    <div class="col-xs-12">
      
      <a href="{{ $service_charges_current_link }}">
        <span class="count_top">@lang('common.Mmc') @lang('common.Applicable')  (@lang('common.'.$current_month))</span>
        <div class="count green">
          {{ $mmc_applicable_current ?? 0  }}
        </div>
      </a>
    </div>
    <div class="col-xs-12">
      
      <a href="{{ $service_charges_current_link }}">
        <span class="count_top"> @lang('common.Mmc') @lang('common.Value') (@lang('common.'.$current_month))</span>
        <div class="count green">
          {{ number_format($mmc_value_current) ?? 0  }}
        </div>
      </a>
    </div>
  </div>
  <!-- /.tile_stats_count -->
  <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count text-center">
    <div class="col-xs-12">
      <a href="{{ $service_charges_current_link }}">
        
        <span class="count_top">@lang('common.Mmc') @lang('common.Received') (@lang('common.'.$current_month))</span>
        <div class="count red">
          {{ number_format($mmc_received_current) ?? 0  }}
        </div>
      </a>
    </div>
    <div class="col-xs-12">
      <a href="{{ $service_charges_current_link }}">
        
        <span class="count_top">@lang('common.Mmc') @lang('common.Pending') (@lang('common.'.$current_month))</span>
        <div class="count red">
          {{ number_format($mmc_pending_current) ?? 0  }}
        </div>
      </a>
    </div>
  </div>
  <!-- /.tile_stats_count -->
</div>
<!-- /.tile_count -->