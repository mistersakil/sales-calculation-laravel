<script>
$(document).ready(function(){
	

	/** Edit action **/

	$('#view_container').on('click','.btn_edit',function(e){
		/* Generate URL for Ajax Request */
		var id = $(this).data('id');
		var url = '{{ $projects_edit_link }}';
		$.ajax({
			url 		: url,
			type		: "get",
			data 		: {id : id},
			success 	: function(result,status,xhr){
				$('#view_container').append(result);
				$('#modal').modal('show');
			}

    	});
	});
	/** End: Edit action **/

	/** Store action **/

	$('#view_container').on('submit','#modal_form',function(e){
		
		e.preventDefault();
		$('.help-block').css({'color' : ''});

		/* Validate and collect form data into an object */
		var my_data = {};
		
		my_data.unit 						= $('#unit').val();
		my_data.total_amount 				= $('#total_amount').val();
		my_data.advance_amount 				= $('#advance_amount').val();
		my_data.advance_receive_date		= $('#advance_receive_date').val();
		my_data.agreement_date 				= $('#agreement_date').val();
		my_data.start_date 					= $('#start_date').val();
		my_data.end_date 					= $('#end_date').val();
		my_data.product_id 					= $('#product_id').val();
		my_data.client_id 					= $('#client_id').val();			
		my_data.progress 					= $('#progress').val();
		my_data.status 						= $('#status').val();
		my_data.vat_type 					= $('#vat_type').val();
		my_data.vat_amount 					= $('#vat_amount').val();
		my_data.id 							= $('#id').val();
		
		/* Create formdata and set all values to it for passing as ajax request */            
        var form_data = new FormData();
        if($('#file').val() != ''){
        	form_data.append('file',document.getElementById('file').files[0]);
		}
	    form_data.append('unit',my_data.unit);
        form_data.append('total_amount',my_data.total_amount);
        form_data.append('advance_amount',my_data.advance_amount);
        form_data.append('advance_receive_date',my_data.advance_receive_date);
        form_data.append('agreement_date',my_data.agreement_date);
        form_data.append('start_date',my_data.start_date);
        form_data.append('end_date',my_data.end_date);
        form_data.append('product_id',my_data.product_id);
        form_data.append('client_id',my_data.client_id);
        form_data.append('progress',my_data.progress);
        form_data.append('status',my_data.status);
        form_data.append('vat_type',my_data.vat_type);
        form_data.append('vat_amount',my_data.vat_amount);
        form_data.append('id',my_data.id);
        url = "{{ $projects_update_link }}";
        
		if(true)
		{
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
				success 	: function(result,status,xhr)
				{

					/* Remove loading effect */
					ajax_loading(false);
					/* On sucess result */
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

					
				}
			}).fail(function(error){
				/* Remove loading effect */
				ajax_loading(false);

				/* alert message */		
				new PNotify({
                  title: '{{ __("common.error") }}',
                  text: '{{ __("common.invalid query or server error") }}',
                  type: 'error',
                  styling: 'bootstrap3'
                 });

				/* Displaying errors */

				var errors = error.responseJSON.errors;
				for (var key in errors) {
				    $('#'+key+' ~ .help-block').css({'color' : 'red'});
				   
				}
				
			});
		}
		


	});
	/** End: Store action  **/
	
});

</script>