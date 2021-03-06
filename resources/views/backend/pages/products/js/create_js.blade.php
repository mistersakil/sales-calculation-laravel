<script>
$(document).ready(function(){

	/** Create Action **/
	$('.btn_create').on('click',function(){
		var url  = '{{ $products_create_link }}'; 
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
		my_data.code 						= $('#code').val();
		my_data.description 				= $('#description').val();
		my_data.status 						= $('#status').val();
		my_data.platform_id 				= $('#platform_id').val();		

        url = "{{ $products_store_link }}";
        console.log(my_data);
		if(true){
			$.ajax({
				url 		: url,
				type		: 'post',
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
					   error_list += '<li class="text-light">'+errors[key]+'</li>'
					}	

					new PNotify({
	                  title: '{{ __("common.validation error") }}',
	                  text: error_list,
	                  type: 'error',
	                  styling: 'bootstrap3'
	                 });

					/* End: Displaying errors */

				}

			});
		}
	});
	/** End: Store action  **/
});

</script>