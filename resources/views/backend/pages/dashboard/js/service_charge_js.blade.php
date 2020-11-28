<script>
$(document).ready(function(){

      var url  = '{{ $dashboard_service_charge }}'; 
      $.ajax({
        url         : url,
        type        : 'get',
        success     : function(result){
          $('.service_charge .x_content').empty();
          $('.service_charge .x_content').append(result);
       
        },
        error       : function(){
          alert('Error found');
        }
      });
});
</script>