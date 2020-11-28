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
			var error = [];
			if($('#name').val() != ''){
				my_data.name 	= $('#name').val();
				$('#name').css({'border-color': ''});
				$('#name').next().css({'color': 'inherit'}).text('{{ __("common.BRAND_NAME_REQUIRED") }}');
				if(my_data.name.length <=1 )
				{
					error.push('{{ __("common.NAME_MIN_2") }}');
					$('#name').next().css({'color': 'red'}).text('{{ __("common.NAME_MIN_2") }}');
					$('#name').css({'border-color': 'red'});

				}

			}else{
				error.push('{{ __("common.BRAND_NAME_REQUIRED") }}');
				$('#name').css({'border-color': 'red'});
				$('#name').next().css({'color': 'red'}).text('{{ __("common.BRAND_NAME_REQUIRED") }}');
			}

			if($('#image').val() != ''){
				var image 		= document.getElementById('image');
				my_data.image 	= image.files[0];
				var extension 	= my_data.image.name.substr(my_data.image.name.lastIndexOf('.')+1, my_data.image.name.length);

				if(!['png','jpg','jpeg','bmp'].includes(extension)){
					error.push('{{ __("common.IMAGE_MIMES_JPG_PNG_GIF_BMP") }}');
					$('#image').next().css({'color': 'red'}).text('{{ __("common.IMAGE_MIMES_JPG_PNG_GIF_BMP") }}');
					$('#image').css({'border-color' : 'red'});
				}else if((my_data.image.size / 1024) > 50){
					error.push('{{ __("common.IMAGE_MAX_SIZE_50") }}');
					$('#image').next().css({'color': 'red'}).text('{{ __("common.IMAGE_MAX_SIZE_50") }}');
					$('#image').css({'border-color' : 'red'});
				}else{
					$('#image').next().css({'color': ''}).text('{{ __("common.BRAND_IMAGE_OPTIONAL") }}');
					$('#image').css({'border-color' : ''});
				}
			}
			my_data.published 	= $("input[name='published']:checked").val();
			my_data.body 		= $('#body').val();
			my_data.slug 		= $('#slug').val();

			/* Create formdata and set all values to it for passing as ajax request */            
	        var form_data = new FormData();
	        form_data.append('name',my_data.name);
	        form_data.append('image',my_data.image);
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

							$('form').trigger('reset');
							$('#view_container #create_modal .custom_loading').remove();
							$('#view_container #create_modal form').append(custom_message());
							setTimeout(function(){ $('#view_container #create_modal .alert_message').remove(); }, 5000);						
						}else{
							$('#view_container #create_modal .custom_loading').remove();
							$('#view_container #create_modal form').append(custom_message('error.png','Some error'));
							setTimeout(function(){ $('#view_container #create_modal .alert_message').remove(); }, 5000);
						}

						
					}
				}).fail(function(error){
					console.log(error.responseJSON);
				});
			}
			


		});
		//* End: Create ajax request *//
});

</script>