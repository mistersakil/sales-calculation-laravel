<script>
$(document).ready(function(){

		//* Create modal window display *//
		$('#crate_brand_modal_btn').on('click',function(){
			var url  = '{{ $brand_create_link }}'; 
			$.get('{{ $brand_create_link }}',function(result){
				$('#view_container').append(result);
				$('#create_modal').modal('show');
			});
		});

		//* End: Create modal window display *//
		
		//* Brand store on ajax request *//

		$('#view_container').on('submit','#create_form',function(e){
			
			e.preventDefault();

			/* Validate and collect form data into an object */
			var my_data = {};
			
			my_data.name 		= $('#name').val();
			my_data.published 	= $("input[name='published']:checked").val();
			my_data.body 		= $('#body').val();
			my_data.slug 		= $('#slug').val();
			

			/* Create formdata and set all values to it for passing as ajax request */            
	        var form_data = new FormData();
	        form_data.append('name',my_data.name);
	        if($('#image').val() != ''){
				my_data.image 		= document.getElementById('image').files[0];			
	        	form_data.append('image',my_data.image);
			}
	        form_data.append('body',my_data.body);
	        form_data.append('slug',my_data.slug);
	        form_data.append('published',my_data.published);
	        form_data.append('_token','{{ csrf_token() }}');
	        url = "{{ $brand_store_link }}";
	        // error.length >= 0
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
						$('#view_container #create_modal form').append(custom_loading());	
						$('#view_container #create_modal .alert_message').remove();
					},
					success 	: function(result,status,xhr)
					{
						/* On sucess result */
						if(result.success == 'true'){
							/* If datatable exist on current page then refresh table wihout reload page */
							if ( $.fn.DataTable.isDataTable( '#report_table' ) ) {
							 	$('#report_table').DataTable().ajax.reload();	
							}
							/* Reset create form */
							$('form').trigger('reset');
							/* Remove loading effect */
							$('#view_container #create_modal .custom_loading').remove();
							/* Display success alert */
							$('#view_container #create_modal form').append(custom_message());
							/* Remove alert */
							setTimeout(function()
							{ 
								$('#view_container #create_modal .alert_message').remove(); 
							}, 5000);		
							/* Remove error message */				
							$('.help-block').css({'color' : ''});
						}else{
							$('#view_container #create_modal .custom_loading').remove();
							$('#view_container #create_modal form').append(custom_message('error.png','Some error'));
							setTimeout(function(){ $('#view_container #create_modal .alert_message').remove(); }, 5000);
						}

						
					}
				}).fail(function(error){
					var errors = error.responseJSON.errors;
					console.log(errors);
					if("name" in errors ){
						console.log('name error');
						$('#name + .help-block').text(errors.name).css({'color' : 'red'});
					}else{
						$('#name + .help-block').text(errors.name).css({'color' : ''});
					}
					if("image" in errors ){
						console.log('image error');
						$('#image + .help-block').text(errors.image).css({'color' : 'red'});
					}else{
						$('#image + .help-block').text(errors.image).css({'color' : ''});
					}
					
				});
			}
			


		});
		//* End: Create ajax request *//
});

</script>