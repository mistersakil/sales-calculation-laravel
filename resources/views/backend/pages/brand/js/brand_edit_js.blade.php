<script>
$(document).ready(function(){
	

	// * Brand edit modal window display *//

	$('#view_container').on('click','.btn_edit',function(e){
		/* Remove Previous Modals */
		$('.modal.fade').remove();
		/* Generate URL for Ajax Request */
		var update_id = $(this).data('id');
		console.log(update_id);
		var url  = '{{ $brand_edit_modal_link }}'+'/'+update_id ;
		console.log(url);
		$.get(url,function(result){
			$('#view_container').append(result);
			$('#edit_modal').modal('show');
		});
	});
	//* End: Brand edit modal window display *//
	//* Brand store on ajax request *//

	$('#view_container').on('submit','#edit_form',function(e){
		
		e.preventDefault();

		/* Validate and collect form data into an object */
		var my_form_data = {};
		var error = [];
		if($('#name').val() != ''){
			my_form_data.name 	= $('#name').val();
			$('#name').css({'border-color': ''});
			$('#name').next().css({'color': 'inherit'}).text('{{ __('common.BRAND_NAME_REQUIRED') }}');
			if(my_form_data.name.length <=1 )
			{
				error.push('{{ __("common.NAME_MIN_2") }}');
				$('#name').next().css({'color': 'red'}).text('{{ __("common.NAME_MIN_2") }}');
				$('#name').css({'border-color': 'red'});

			}

		}else{
			error.push('{{ __("common.BRAND_NAME_REQUIRED") }}');
			$('#name').css({'border-color': 'red'});
			$('#name').next().css({'color': 'red'}).text('{{ __('common.BRAND_NAME_REQUIRED') }}');
		}

		if($('#image').val() != ''){
			var image 		= document.getElementById('image');
			my_form_data.image 	= image.files[0];
			var extension 	= my_form_data.image.name.substr(my_form_data.image.name.lastIndexOf('.')+1, my_form_data.image.name.length);

			if(!['png','jpg','jpeg','bmp'].includes(extension)){
				error.push('{{ __("common.IMAGE_MIMES_JPG_PNG_GIF_BMP") }}');
				$('#image').next().css({'color': 'red'}).text('{{ __("common.IMAGE_MIMES_JPG_PNG_GIF_BMP") }}');
				$('#image').css({'border-color' : 'red'});
			}else if((my_form_data.image.size / 1024) > 50){
				error.push('{{ __("common.IMAGE_MAX_SIZE_50") }}');
				$('#image').next().css({'color': 'red'}).text('{{ __("common.IMAGE_MAX_SIZE_50") }}');
				$('#image').css({'border-color' : 'red'});
			}else{
				$('#image').next().css({'color': ''}).text('{{ __("common.BRAND_IMAGE_OPTIONAL") }}');
				$('#image').css({'border-color' : ''});
			}
		}
		my_form_data.published 	= $("input[name='published']:checked").val();
		my_form_data.body 		= $('#body').val();
		my_form_data.slug 		= $('#slug').val();
		my_form_data.id 			= $('#id').val();
		my_form_data._token		= '{{ csrf_token() }}';

		/* Create formdata and set all values to it for passing as ajax request */            
        var form_data_update = new FormData();
        form_data_update.append('id',my_form_data.id);
        form_data_update.append('name',my_form_data.name);
        form_data_update.append('image',my_form_data.image);
        form_data_update.append('body',my_form_data.body);
        form_data_update.append('slug',my_form_data.slug);
        form_data_update.append('published',my_form_data.published);
        form_data_update.append('_token',my_form_data._token);
        var url = '{{ $brand_update_link }}';
        console.log(my_form_data);
        console.log(url);
		if(error.length <= 0)
		{
			$.ajax({
				url 		: url,
				type		: "POST",
				dataType	: "json",
				data 		: form_data_update,
				contentType : false,
        		processData : false,
        		beforeSend	: function(xhr)
				{
					$('#view_container #edit_modal form').append(custom_loading());	
					$('#view_container #edit_modal .alert_message').remove();
				},
				success 	: function(result,status,xhr)
				{
					/* On sucess result */
					if(result.success == 'true'){
						/* If datatable exist on current page then refresh table wihout reload page */
						if ( $.fn.DataTable.isDataTable( '#report_table' ) ) {
						 	$('#report_table').DataTable().ajax.reload();	
						}

						$('#view_container #edit_modal .custom_loading').remove();
						$('#view_container #edit_modal form').append(custom_message());
						setTimeout(function(){ $('#view_container #edit_modal .alert_message').remove(); }, 5000);						
					}else{
						$('#view_container #edit_modal .custom_loading').remove();
						$('#view_container #edit_modal form').append(custom_message('error.png','Some error'));
						setTimeout(function(){ $('#view_container #edit_modal .alert_message').remove(); }, 5000);
					}
					
				},
				error 	: function(xhr,status,error)
				{
					
					console.log(status);
					console.log(error);
					console.log(xhr);
					
				}
			});
		}
	});
	
});

</script>