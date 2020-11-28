<script>
$(document).ready(function(){

	/** Create Action **/
	$('.btn_create').on('click',function(){
		var url  = '{{ $users_create_link }}'; 
		$.get(url,function(result){
			$('.view_container').append(result);
			$('.modal').modal('show');
		});
	});

	/** End: Create Action **/
	
	/** Store action **/

	$('.view_container').on('submit','.modal_form_create',function(e){
		
		e.preventDefault();
		$('.help-block').css({'color' : ''});

		/* Validate and collect form data into an object */ 

		var my_data = {};
		
		my_data.name 						= $('#name').val();
		my_data.email 						= $('#email').val();
		my_data.password 					= $('#password').val();
		my_data.status 						= $('#status').val();
		my_data.role 						= $('#role').val();

        url = "{{ $users_store_link }}";

		if(true){
			$.ajax({
				url 		: url,
				type		: "post",
				data 		: my_data,
				dataType 	: 'json',
				beforeSend	: function(xhr)
				{
					ajax_loading();
				},
				success 	: function(result,status,xhr){

					/* Remove loading effect */
					ajax_loading(false);

					/* On sucess result */
					if(result.success == 'true'){
						/* If datatable exist on current page then refresh table wihout reload page */
						if ( $.fn.DataTable.isDataTable( '.report_table' ) ) {
						 	$('.report_table').DataTable().ajax.reload();	
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

					/* Displaying errors */

					var errors = error.responseJSON.errors;
					var error_list = '';
					for (var key in errors) {
					    $('#'+key+' ~ .help-block').css({'color' : 'red'});
					    error_list += '<li>'+errors[key]+'</li>';
					   
					}
					/* alert message */		
					new PNotify({
	                  title: '{{ __("common.validation error") }}',
	                  text: error_list,
	                  type: 'error',
	                  styling: 'bootstrap3'
	                 });

					/* End: alert message */	

				}

			});
		}
	});
	/** End: Store action  **/
});

</script>