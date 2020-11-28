<!-- top tiles -->
<div class="tile_count">
  <div class="col-md-2 col-sm-6 col-xs-12 tile_stats_count text-center">
    <span class="count_top">PO (BIN)</span>
    <div class="count blue">
      {{ $total_company ?? 0  }} ({{ $po_total_unit ?? 0 }})
    </div>
    
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count text-center">
    <span class="count_top">PO Value</span>
    <div class="count green">
      <span>{{ $taka }}</span>
    {{ number_format($po_total_value ?? 0) }}
  </div>
    
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count text-center">
    <span class="count_top">Advance on PO</span>
    <div class="count red"><span>{{ $taka }}</span>    
    {{ number_format($po_total_advance ?? 0) }}
    </div>
    
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12 tile_stats_count text-center">
    <span class="count_top">Pending on PO</span>
    <div class="count text-warning">
      <span>ট</span>
      {{ number_format( ($po_total_value ?? 0) - ($po_total_advance ?? 0) )  }}
    </div>
    
  </div>
</div>
<!-- /top tiles -->