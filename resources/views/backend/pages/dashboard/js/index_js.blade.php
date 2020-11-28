<script>

$(function() {

/** daterange select **/
$('#daterange_two').daterangepicker({
opens: 'left'
}, function(start, end, label) {
console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
});




/** Revenue Collection Chart Morris.Bar **/

  // service_charge_graph Morris.Bar
  // Morris.Bar({
  //   element: 'service_charge_graph',
  //   data: [
  //     {x: 'Jan', y: 600000},
  //     {x: 'Feb', y: 450000},
  //     {x: 'Mar', y: 650000},
  //     {x: 'Apr', y: 700000},
  //     {x: 'May', y: 910000},
  //     {x: 'Jun', y: 650000},
  //     {x: 'Jul', y: 800000},
  //     {x: 'Aug', y: 700000},
  //     {x: 'Sep', y: 600000},
  //     {x: 'Oct', y: 650000},
  //     {x: 'Nov', y: 600000},
  //     {x: 'Dec', y: 750000},
  //   ],
  //   xkey: 'x',
  //   ykeys: ['y'],
  //   labels: ['Collection']
  // }).on('click', function(i, row){
  //   console.log(i, row);
  // });

  
});
</script>