<!-- top tiles -->
<div class="tile_count">
  <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count text-center">
    <a href="{{ $collections_list_link }}">
      <span class="count_top">@lang('common.Total') @lang('common.Received')</span>
      <div class="count blue">
        <span>{{ $taka }}</span>
        {{ number_format($total_amount ?? 0) }}
      </div>
    </a>
    
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count text-center">
    <a href="{{ $collections_list_link.'?ctype=1' }}">
      
      <span class="count_top">@lang('common.Advance')  @lang('common.Received')</span>
      <div class="count green">
        <span>{{ $taka }}</span>
        {{ number_format($advance ?? 0) }}
      </div>
    </a>
    
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count text-center">
    <a href="{{ $collections_list_link.'?ctype=3' }}">
      <span class="count_top">@lang('common.Mmc') @lang('common.Received')</span>
      <div class="count text-warning">
        <span>{{ $taka }}</span>
        {{ number_format($service_charge ?? 0) }}
      </div>
    </a>
    
  </div>

</div>
<div class="tile_count">

  <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count text-center">
    <a href="{{ $collections_list_link.'?ctype=2' }}">
      <span class="count_top">@lang('common.After') @lang('common.Implementation')</span>
      <div class="count red">
        <span>{{ $taka }}</span>
        {{ number_format($after_implementation ?? 0) }}
      </div>
    </a>    
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count text-center">
    <a href="{{ $collections_list_link.'?ctype=4' }}">
      <span class="count_top">@lang('common.Customization') @lang('common.Charge')</span>
      <div class="count red">
        <span>{{ $taka }}</span>
        {{ number_format($customization_charge ?? 0) }}
      </div>
    </a>    
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count text-center">
    <a href="{{ $collections_list_link.'?ctype=5' }}">
      <span class="count_top">@lang('common.Others')</span>
      <div class="count red">
        <span>{{ $taka }}</span>
        {{ number_format($other_charges ?? 0) }}
      </div>
    </a>    
  </div>
  
</div>
<!-- /top tiles -->