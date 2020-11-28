<script>
$(document).ready(function(){
  /** Manupulate year list **/
  var year_list  = [];
  for (i = new Date().getFullYear(); i >= 2005; i--) {
      year_list.push(i);
  }
  $( ".client_bin_year" ).select2({'data': year_list}).change(function(){
    var year = $(this).val();
    $('#client_bin_chart').empty();
    client_bin_chart(this.value);
  });

  /** Revenue Collection Chart Morris.Bar **/
  client_bin_chart(new Date().getFullYear());

  function client_bin_chart(year){
    $.ajax({
    type: 'get',
    dataType: 'json',
    data : {"year": year},
    url : '{{ $client_bin_chart_link }}',
    success: function(result){
      Morris.Bar({
        element:"client_bin_chart",
        data:result,
        xkey:"month",
        ykeys:["total_po","total_bin"],
        barColors:["#0B62A4","#1ABB9C"],
        hideHover:"auto",
        labels:["Company","BIN"],
        resize:!0
        }).on("click",function(a,b){
          // console.log(a,b)
        })

      }

    });
  }

});
</script>