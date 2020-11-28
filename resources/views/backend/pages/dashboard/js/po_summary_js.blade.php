<script>
$(document).ready(function(){

  $(window).load(function(){

    var current_month_range = {
      start_date   : moment().subtract(29, 'days').format('YYYY-MM-DD'),
      end_date  : moment().format('YYYY-MM-DD'),
    };

    /** Revenue collection details link generate **/
    $('.po_summary .collection_details').attr('href','{{ $projects_po_details_link }}'+'/'+current_month_range.start_date+'/'+current_month_range.end_date);


    /** Revenue collection daterange select for search **/
    $('#daterange_po_summary').daterangepicker({
      opens: 'left',
      startDate: moment().subtract(29, 'days'),
      endDate: moment(),
      locale: {
        format: 'DD MMM,YYYY'
      },
      ranges: {
         'Today'        : [moment(), moment()],
         'Yesterday'    : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         'Last 7 Days'  : [moment().subtract(6, 'days'), moment()],
         'Last 30 Days' : [moment().subtract(29, 'days'), moment()],
         'This Month'   : [moment().startOf('month'), moment().endOf('month')],
         'Last Month'   : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    },function(start, end, label) {
        var selected_dates = {start_date : start.format('YYYY-MM-DD'), end_date : end.format('YYYY-MM-DD')}
       
        po_summary(selected_dates);
        /** Revenue collection details link generate **/
        $('.po_summary .collection_details').attr('href','{{ $projects_po_details_link }}'+'/'+selected_dates.start_date+'/'+selected_dates.end_date);
    });
    
    po_summary(current_month_range);

    /*  po_summary function */

    function po_summary(dates){
      var url  = '{{ $po_summary }}'; 
      $.ajax({
        url         : url,
        data        : dates,
        type        : 'get',
        beforeSend  : function(xhr){
          ajax_loading(true);
        },
        success     : function(result){
          /* Remove loading effect */
          ajax_loading(false);

          /* Display resulting content */
          $('.po_summary .x_content').empty();
          $('.po_summary .x_content').append(result);
       
        },
        error       : function(){
          /* Remove loading effect */
          ajax_loading(false);

          /* alert message */   
          new PNotify({
            title: '{{ __("common.error") }}',
            text: '{{ __("common.validation error") }}',
            type: 'error',
            styling: 'bootstrap3'
          });
        }
      });
    }
    /* End: po_summary function */


 

  });


});
</script>