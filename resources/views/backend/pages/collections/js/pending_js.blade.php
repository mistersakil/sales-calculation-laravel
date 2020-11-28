<script>
$(document).ready(function(){
	

	/** Pending Collection Summary Action **/
	$('.btn_add_pending').on('click',function(){
		var data 				= {};
		data.project_id 		= $(this).data('id');
		data.collection_type 	= $(this).data('type');
		data.amount 			= $(this).data('amount');
		data.product 			= $(this).data('product');
		data.client 			= $(this).data('client');
		var url 				= '{{ $collections_collect_link }}';
		$.ajax({
			url					: url,
		 	data 				: data,
		  	type 				: 'get',
		  	success				: function(result){
		  		$('.view_container').append(result);
				$('.modal').modal('show');
		  	},
		  	error 				: function(error){
		  		console.log(error);
			}
		});
	});

	/** End: Create Action **/

	
	/** Store action **/

	$('.view_container').on('submit','.modal_form_collect',function(e){
		
		e.preventDefault();

		/* Validate and collect form data into an object */
		var my_data = {};
		
		my_data.amount 			= $('#amount').val();
		my_data.collection_type = $('#collection_type').val();
		my_data.project_id 		= $('#project_id').val();


		
		/* Create formdata and set all values to it for passing as ajax request */            
        var form_data = new FormData();
        form_data.append('amount',my_data.amount);
        form_data.append('collection_type',my_data.collection_type);
        form_data.append('project_id',my_data.project_id);

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
					if(result.success == 'true'){
						/* alert message */		
						new PNotify({
                          title: '{{ __("common.success") }}',
                          text: result.message,
                          type: 'success',
                          styling: 'bootstrap3'
                         });
						$('.modal').modal('hide');
						window.location.reload(true);

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
	/** End: Store action  **/
});

</script>