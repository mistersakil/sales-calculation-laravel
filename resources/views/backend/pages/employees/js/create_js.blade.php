<script>
$(document).ready(function(){

		/** Create modal window display **/
		$('#modal_for_create').on('click',function(){
			var url  = '{{ $projects_create_link }}'; 
			$.get(url,function(result){
				$('#view_container').append(result);
				$('#create_modal').modal('show');
			});
		});

		/** End: Create modal window display **/
		
		/** Brand store on ajax request **/

		$('#view_container').on('submit','#create_form',function(e){
			
			e.preventDefault();

			/* Validate and collect form data into an object */
			var my_data = {};
			
			my_data.name 				= $('#name').val();
			my_data.total_amount 		= $('#total_amount').val();
			my_data.advance_amount 		= $('#advance_amount').val();
			my_data.agreement_date 		= $('#agreement_date').val();
			my_data.start_date 			= $('#start_date').val();
			my_data.end_date 			= $('#end_date').val();
			my_data.product_id 			= $('#product_id').val();
			my_data.client_id 			= $('#client_id').val();
			my_data.discuss_member_id 	= $('#discuss_member_id').val();
			my_data.support_person_id 	= $('#support_person_id').val();
			my_data.project_status 		= $('#project_status').val();
			my_data.published 			= $('#published').val();
			my_data.body 				= $('#body').val();
			
			console.log(my_data);
			/* Create formdata and set all values to it for passing as ajax request */            
	        var form_data = new FormData();
	        if($('#files').val() != ''){
				my_data.files 		= document.getElementById('files').files[0];			
	        	form_data.append('files',my_data.files);
			}
	        form_data.append('name',my_data.name);
	        form_data.append('total_amount',my_data.total_amount);
	        form_data.append('advance_amount',my_data.advance_amount);
	        form_data.append('agreement_date',my_data.agreement_date);
	        form_data.append('start_date',my_data.start_date);
	        form_data.append('end_date',my_data.end_date);
	        form_data.append('product_id',my_data.product_id);
	        form_data.append('client_id',my_data.client_id);
	        form_data.append('discuss_member_id',my_data.discuss_member_id);
	        form_data.append('support_person_id',my_data.support_person_id);
	        form_data.append('project_status',my_data.project_status);
	        form_data.append('published',my_data.published);
	        form_data.append('body',my_data.body);
	        form_data.append('_token','{{ csrf_token() }}');
	        url = "{{ $projects_store_link }}";
	        
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
					// if("name" in errors ){
					// 	console.log('name error');
					// 	$('#name + .help-block').text(errors.name).css({'color' : 'red'});
					// }else{
					// 	$('#name + .help-block').text(errors.name).css({'color' : ''});
					// }
					
					
				});
			}
			


		});
		/** End: Create ajax request **/


});

</script>