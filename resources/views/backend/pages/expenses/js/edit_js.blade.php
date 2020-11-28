<script>
$(document).ready(function(){
	
	/** Edit action **/

	$('.view_container').on('click','.btn_edit',function(e){
		var id = $(this).data('id');
		var url = '{{ $expenses_edit_link }}';
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

		var error 			= [];
		var row_data 		= {};
		$('.modal_form_edit .table > tbody > tr').each(function(){
			row_data.title  =  $(this).find(".title").text();
			row_data.amount =  $(this).find(".amount").text();
			row_data.date 	=  $(this).find(".date #date").val();
			row_data.type 	=  $(this).find(".type #type").val();
			row_data.status =  $(this).find(".status #status").val();
			row_data.id 	=  $('#id').val();
			if(row_data.title  == '') error.push('Title can not be empty');
			if(row_data.amount == '') error.push('Amount can not be empty');
			if(isNaN(row_data.amount)) error.push('Amount must be a number');
		});
		

		var form_data = new FormData();
        form_data.append('title',row_data.title);
        form_data.append('amount',row_data.amount);
        form_data.append('date',row_data.date);
        form_data.append('type',row_data.type);
        form_data.append('status',row_data.status);
        form_data.append('id',row_data.id);
		
		/* Error Alert */
		if(error.length > 0){
			let s = new Set(error);
		    let it = s.values();
		    error = Array.from(it);
			var html = '';
			error.forEach(function(value){
				html += '<li>'+value+'</li>';
			});
			/* alert message */		
			new PNotify({
              title: '{{ __("common.error") }}',
              text: html,
              type: 'error',
              styling: 'bootstrap3'
             });
		}

        url = "{{ $expenses_update_link }}";

		if(error.length <= 0){
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

				}

			});
		}
	});
	/** End: Store action  **/
	
});

</script>