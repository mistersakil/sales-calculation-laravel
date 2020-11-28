<script>
$(document).ready(function(){
  /** Manupulate year list **/
  var year_list  = [];
  for (i = new Date().getFullYear(); i >= 2005; i--) {
      year_list.push(i);
  }
  $( ".select2_yearly_rev_chat" ).select2({'data': year_list}).change(function(){
    $('#revenue_collection_chart_group_morris').empty();
    revenue_chart_onchange(this.value);
  });

  /** Revenue Collection Chart Morris.Bar **/
  revenue_chart(new Date().getFullYear());

  function revenue_chart(year){
    $.ajax({
    type: 'get',
    dataType: 'json',
    data : {"year": year},
    url : '{{ $revenue_collection_group_chart }}',
    success: function(result){
      Morris.Bar({
        element:"revenue_collection_chart_group_morris",
        data:result,
        xkey:"month",
        ykeys:["po_value","received_amount","pending_amount"],
        barColors:["#0B62A4","#1ABB9C","#E74C3C","yellow"],
        hideHover:"auto",
        labels:["PO Value","Collected","Pending"],
        resize:!0
      }).on("click",function(a,b){
        console.log(a,b)
      })

      }

    });
  }

  function revenue_chart_onchange(year){
    $.ajax({
      type: 'get',
      dataType: 'json',
      data : {"year": year},
      beforeSend  : function(xhr){
          ajax_loading();
      },
      url : '{{ $revenue_collection_group_chart }}',
      success: function(result){
        /*** Chart generation ***/
        Morris.Bar({
          element:"revenue_collection_chart_group_morris",
          data:result,
          xkey:"month",
          ykeys:["po_value","received_amount","pending_amount"],
          barColors:["#0B62A4","#1ABB9C","#E74C3C","yellow"],
          hideHover:"auto",
          labels:["PO Value","Collected","Pending"],
          resize:!0
        }).on("click",function(a,b){
          console.log(a,b)
        })
        /*** Remove loading effect ***/
        ajax_loading(false);
      }

    });
  }

});
</script>