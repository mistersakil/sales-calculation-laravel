<script>
$(document).ready(function(){	

	/** Delete (modal) window display **/
	$('#view_container').on('click','.btn_delete',function(e){
		/* Generate URL for Ajax Request */
		var delete_id = $(this).data('id');
		var url = '{{ $projects_delete_link }}';
		$.ajax({
			url 		: url,
			type		: "post",
			data 		: {id : delete_id},
			success 	: function(result,status,xhr){
				$('#view_container').append(result);
				$('#delete_modal').modal('show');
			}

    	});
		
	});

	/** Destroy permanently **/
	$('#view_container').on('submit','#delete_modal form',function(e){
		e.preventDefault();
		var url_destroy = '{{ $projects_destroy_link }}';
		var data = $(this).serialize();
		
		$.ajax({
			url 		: url_destroy,
			type		: "post",
			data 		: data,
			beforeSend	: function(xhr)
			{
				ajax_loading();
			},
			success 	: function(result)
			{
				
				/* On sucess result */
				$('#delete_modal').modal('hide');
				/* If datatable exist on current page then refresh table wihout reload page */
				if ( $.fn.DataTable.isDataTable( '#report_table' ) ) {
				 	$('#report_table').DataTable().ajax.reload();	
				}	
				if(result.success == 'true'){
					/* Remove loading effect */
					ajax_loading(false);
					/* alert message */		
					new PNotify({
                      title: '{{ __("common.success") }}',
                      text: result.message,
                      type: 'success',
                      styling: 'bootstrap3'
                     });

				}else{
					/* Remove loading effect */
					ajax_loading(false);
					/* alert message */		
					new PNotify({
                      title: '{{ __("common.error") }}',
                      text: result.message,
                      type: 'error',
                      styling: 'bootstrap3'
                     });
					
				}
				
			}
		}).fail(function(error){
			/* Remove loading effect */
			ajax_loading(false);
			/* alert message */		
			new PNotify({
              title: '{{ __("common.error") }}',
              text: result.message,
              type: 'error',
              styling: 'bootstrap3'
             });
		});
		


	});

	/** End; Destroy permanently **/

});

</script>