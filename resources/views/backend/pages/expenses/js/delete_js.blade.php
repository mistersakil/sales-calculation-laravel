<script>
$(document).ready(function(){	

	/** Delete (modal) window display **/
	$('.view_container').on('click','.btn_delete',function(e){
		/* Generate URL for Ajax Request */
		var id = $(this).data('id');
		var url = '{{ $expenses_delete_link }}';
		$.ajax({
			url 		: url,
			type		: "get",
			data 		: {id : id},
			success 	: function(result,status,xhr){
				$('.view_container').append(result);
				$('.modal').modal('show');
			}

    	});
		
	});

	/** Destroy permanently **/
	$('.view_container').on('submit','.modal_form_delete',function(e){
		e.preventDefault();
		var url_destroy = '{{ $expenses_destroy_link }}';
		var data = $(this).serialize();
		
		if(true)
		{
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
					$('.modal').modal('hide');
					/* If datatable exist on current page then refresh table wihout reload page */
					if ( $.fn.DataTable.isDataTable( '.report_table' ) ) {
					 	$('.report_table').DataTable().ajax.reload();	
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
					
				},
				error 	: function(error)
				{
					/* alert message */		
					new PNotify({
	                  title: '{{ __("common.error") }}',
	                  text: '{{ __("common.validation error") }}',
	                  type: 'error',
	                  styling: 'bootstrap3'
	                 });
					/* Remove loading effect */
					ajax_loading(false);
				}
			});
		}		


	});

	/** End: Destroy permanently **/

});

</script>