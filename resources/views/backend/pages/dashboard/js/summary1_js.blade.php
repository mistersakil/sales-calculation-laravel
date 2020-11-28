<script>
$(document).ready(function(){

      var url  = '{{ $dashboard_summary1 }}'; 
      $.ajax({
        url         : url,
        type        : 'get',
        success     : function(result){
          $('.summary1 .x_content').empty();
          $('.summary1 .x_content').append(result);
       
        },
        error       : function(){
          alert('Error found');
        }
      });
});
</script>