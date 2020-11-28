<script>
$(document).ready(function(){	

	/** Delete (modal) window display **/
	$('.view_container').on('click','.btn_receive',function(e){
		/* Generate URL for Ajax Request */

		var id = $(this).data('id');
		var url = '{{ $service_charges_receive_link }}';
		// console.log(id, url);
		console.log(id);
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
	$('.view_container').on('submit','.modal_form_receive',function(e){
		e.preventDefault();
		
		/* Validate and collect form data into an object */
		var my_data = {};
		
		my_data.project_id 				= $('#project_id').val();
		my_data.amount 					= $('#amount').val();
		my_data.collection_date 		= $('#collection_date').val();
		my_data.collection_type 		= $('#collection_type').val();
		my_data.remark 					= $('#remark').val();


		
		/* Create formdata and set all values to it for passing as ajax request */            
        var form_data = new FormData();
        form_data.append('project_id',my_data.project_id);
        form_data.append('amount',my_data.amount);
        form_data.append('collection_date',my_data.collection_date);
        form_data.append('collection_type',my_data.collection_type);
        form_data.append('remark',my_data.remark);

        url = "{{ $collections_store_link }}";

		if(true){
			$.ajax({
				url 		: url,
				type		: "post",
				data 		: form_data,
				contentType : false,
        		processData : false,
				beforeSend	: function(xhr)
				{
					ajax_loading();
				},
				success 	: function(result,status,xhr){

					/* Remove loading effect */
					ajax_loading(false);
					/* Hide alert modal */
					$('.modal').modal('hide');

					if(result.success == 'true'){
						/* If datatable exist on current page then refresh table wihout reload page */
						if ( $.fn.DataTable.isDataTable( '#report_table' ) ) {
						 	$('#report_table').DataTable().ajax.reload();	
						}

						/* alert message */		
						new PNotify({
                          title: '{{ __("common.success") }}',
                          text: result.message,
                          type: 'success',
                          styling: 'bootstrap3'
                         });
						/* Remove error message */				
						$('.help-block').css({'color' : ''});
					}else{
						/* alert message */		
						new PNotify({
                          title: '{{ __("common.error") }}',
                          text: result.message,
                          type: 'error',
                          styling: 'bootstrap3'
                         });
						
					}

					
				},
				error 	: function(error){
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
		/** End: AJAX  **/		


	});

	/** End: Destroy permanently **/

});

</script>