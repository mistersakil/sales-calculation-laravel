<script>
$(document).ready(function(){

	/** Create Action **/
	$('.btn_create').on('click',function(){
	// $(window).on('load',function(){
		var url  = '{{ $clients_create_link }}'; 
		$.get(url,function(result){
			$('.view_container').append(result);
			$('.modal').modal('show');
		});
	});

	/** End: Create Action **/
	
	/** Store action **/

	$('.view_container').on('submit','.modal_form',function(e){
		
		e.preventDefault();
		$('.help-block').css({'color' : ''});
		
		$('.view_container .modal .modal-body').remove();

		/* Validate and collect form data into an object */
		var my_data = {};
		
		my_data.name 						= $('#name').val();
		my_data.contact_person 				= $('#contact_person').val();
		my_data.country_id 					= $('#country_id').val();
		my_data.status 						= $('#status').val();
		my_data.phone 						= $('#phone').val();
		my_data.email 						= $('#email').val();
		my_data.website 					= $('#website').val();
		my_data.address 					= $('#address').val();


		
		/* Create formdata and set all values to it for passing as ajax request */            
        var form_data = new FormData();
        form_data.append('name',my_data.name);
        form_data.append('contact_person',my_data.contact_person);
        form_data.append('country_id',my_data.country_id);
        form_data.append('status',my_data.status);
        form_data.append('phone',my_data.phone);
        form_data.append('email',my_data.email);
        form_data.append('website',my_data.website);
        form_data.append('address',my_data.address);

        url = "{{ $clients_store_link }}";

        
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
					/* On sucess result */
					if(result.success == 'true'){
						/* If datatable exist on current page then refresh table wihout reload page */
						if ( $.fn.DataTable.isDataTable( '.report_table' ) ) {
						 	$('.report_table').DataTable().ajax.reload();	
						}

						/* Remove loading effect */
						ajax_loading(false);
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
				error 	: function(error){
					/* alert message */		
					new PNotify({
	                  title: '{{ __("common.error") }}',
	                  text: '{{ __("common.validation error") }}',
	                  type: 'error',
	                  styling: 'bootstrap3'
	                 });
					/* Remove loading effect */
					ajax_loading(false);

					/* Displaying errors */

					var errors = error.responseJSON.errors;

					/* Creating modal body section for error display */
					
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