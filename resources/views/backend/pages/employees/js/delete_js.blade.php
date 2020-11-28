<script>
$(document).ready(function(){	

	
		//* Delete modal window display *//
		$('#view_container').on('click','.btn_delete',function(e){
			/* Remove Previous Modals */
			$('.modal.fade').remove();		
			/* Generate URL for Ajax Request */
			var delete_id = $(this).attr('data-id');
			var url = '{{ $brand_delete_modal_link }}';
			$.get(url,function(result){
				$('#view_container').append(result);
				$('#delete_modal').modal('show');
				$('#view_container #delete_modal form').attr('action','{{ $brand_destroy_link }}'+'/'+delete_id);
			});
		});

		/* Destroy brand permanently */
		$('#view_container').on('submit','#delete_modal form',function(e){
			e.preventDefault();
			var route = $(this).attr('action');

			if(route != '')
			{
				$.ajax({
					url 		: route,
					type		: "post",
					dataType	: "json",
					data 		: $(this).serialize(),
					contentType: false,
            		processData: false,
					beforeSend	: function(xhr)
					{
						$('#view_container #delete_modal .modal-footer').append(custom_loading()).css({'padding-bottom' : '70px'});	
						$('#view_container #delete_modal .modal-footer .alert_message').remove().css({'padding-bottom' : '0px'});
					},
					success 	: function(result,status,xhr)
					{
						/* On sucess result */
						$('#report_table').DataTable().ajax.reload();	
						if(result.success == 'true'){
							$('#view_container #delete_modal .modal-footer .custom_loading').remove();
							$('#view_container #delete_modal .modal-footer').append(custom_message());
							setTimeout(function()
							{
								$('#view_container #delete_modal .modal-footer .alert_message').remove(); 
								$('#view_container #delete_modal .modal-footer').css({'padding-bottom' : '0px'});
								$('#delete_modal').modal('hide');

							}, 1000);						
						}else{
							$('#view_container #delete_modal .custom_loading').remove();
							$('#view_container #delete_modal .modal-footer').append(custom_message('error.png'));
							setTimeout(function()
							{ 
								$('#view_container #delete_modal .modal-footer .alert_message').remove(); 
								$('#view_container #delete_modal .modal-footer').css({'padding-bottom' : '0px'}); 
								$('#delete_modal').modal('hide');
							}, 1000);
						}

						
					}
				});
			}


		});

		//* End: Delete modal window display *//

});

</script>