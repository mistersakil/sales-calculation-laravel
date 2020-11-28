<script>
$(document).ready(function(){

      var url  = '{{ $dashboard_summary2 }}'; 
      $.ajax({
        url         : url,
        type        : 'get',
        success     : function(result){
          $('.summary2 .x_content').empty();
          $('.summary2 .x_content').append(result);
       
        },
        error       : function(){
          alert('Error found');
        }
      });
});
</script>