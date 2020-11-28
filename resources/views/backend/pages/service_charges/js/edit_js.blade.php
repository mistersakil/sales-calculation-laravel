<script>
$(document).ready(function(){
	
	/** Edit action **/

	$('.view_container').on('click','.btn_edit',function(e){
		var id = $(this).data('id');
		var url = '{{ $service_charges_edit_link }}';
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
	/** End: Edit action **/

	/** Store action **/


	$('.view_container').on('submit','.modal_form_edit',function(e){
		
		e.preventDefault();
		$('.help-block').css({'color' : ''});
		$('.view_container .modal .modal-body').remove();

		/* Validate and collect form data into an object */
		var my_data = {};
		
		my_data.project_id 				= $('#project_id').val();
		my_data.amount 					= $('#amount').val();
		my_data.pay_schedule 			= $('#pay_schedule').val();
		my_data.status 					= $('#status').val();
		my_data.start_date 				= $('#start_date').val();
		my_data.remarks 				= $('#remarks').val();
		my_data.id 						= $('#id').val();

		/* Create formdata and set all values to it for passing as ajax request */            
        var form_data = new FormData();
        form_data.append('project_id',my_data.project_id);
        form_data.append('amount',my_data.amount);
        form_data.append('pay_schedule',my_data.pay_schedule);
        form_data.append('status',my_data.status);
        form_data.append('start_date',my_data.start_date);
        form_data.append('remarks',my_data.remarks);
        form_data.append('id',my_data.id);

        url = "{{ $service_charges_update_link }}";

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

					/* Displaying errors */

					var errors = error.responseJSON.errors;
					/* Creating modal body section */
					
					$('.view_container .modal .modal-header').after('<div class="modal-body"></div>');

					for (var key in errors) {
					    $('#'+key+' ~ .help-block').css({'color' : 'red'});
					    $('.view_container .modal .modal-body').append('<li class="text-danger">'+errors[key]+'</li>');
					   
					}
				}

			});
		}
	});
	/** End: Store action  **/
	
});

</script>