<script>
$(document).ready(function(){
	

	/** Create Action **/
	$('.btn_create').on('click',function(){
	// $(window).on('load',function(){
		var url  = '{{ $expenses_create_link }}';
		$.get(url,function(result){
			$('.view_container').append(result);
			$('.modal').modal('show');
		});
	});

	/** End: Create Action **/


	/** Create Dynamic Expense Fields **/
	var count = 1;
	$('.view_container').on('click','.add_another',function(e){

		var html = `
			<tr id="row${++count}">
                <td contenteditable="true" class="title"></td>
                <td contenteditable="true" class="amount"></td>
                <td class="date">
                    <div class="input-group date" id="datepicker${++count}">
                        <input type='text' class="form-control" name="date" id="date" value="{{ date('Y-m-d') }}" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </td>
                <td class="type">
                    <select name="type" id="type" class="custom_select">
                        <option value="1">Debit</option>
                        <option value="2">Credit</option>
                    </select>
                </td>
                <td class="status">
                    <select name="status" id="status" class="custom_select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </td>
                <td>
                    <button data-row="row${count}" type="button" name="remove"  title="Remove" class="btn-danger remove">
                    <i class="fa fa-minus"></i>
                    </button>
                </td>
            </tr>
		`;
		$('.modal_form_create table tbody').append(html);
		$('#datepicker'+count).datetimepicker({format: 'YYYY-MM-DD'});

	});
	
	/** End: Create Dynamic Expense Fields **/

	/** Remove Expense Row **/

	$('.view_container').on('click','.remove',function(e){
		var row_id = $(this).data('row');
		$('.modal_form_create table tbody #'+row_id).remove();
	});
	/** End: Remove Expense Row **/

	
	/** Store action **/

	$('.view_container').on('submit','.modal_form_create',function(e){
		
		e.preventDefault();
		var tr_counter 			= 1; 
		var row_data_array	= [];
		var tr_total		= $('.modal_form_create .table > tbody > tr').length;
		var error 			= [];

		$('.modal_form_create .table > tbody > tr').each(function(){
			var row_data 	= {};
			row_data.title  =  $(this).find(".title").text();
			row_data.amount =  $(this).find(".amount").text();
			row_data.date 	=  $(this).find(".date #date").val();
			row_data.type 	=  $(this).find(".type #type").val();
			row_data.status =  $(this).find(".status #status").val();
			row_data_array.push(row_data);
			if(row_data.title  == '') error.push('Title can not be empty');
			if(row_data.amount == '') error.push('Amount can not be empty');
			if(isNaN(row_data.amount)) error.push('Amount must be a number');
		});
		
		
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

        url = "{{ $expenses_store_link }}";

		if(error.length <= 0){
			$.ajax({
				url 		: url,
				type		: "post",
				data 		: JSON.stringify(row_data_array),
				contentType : 'json',
        		processData : false,
				beforeSend	: function(xhr)
				{
					ajax_loading();
				},
				success 	: function(result,status,xhr){


					/* Remove loading effect */
					ajax_loading(false);
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
					/* Remove loading effect */
					ajax_loading(false);
					
					/* alert message */		
					new PNotify({
	                  title: '{{ __("common.error") }}',
	                  text: '{{ __("common.validation error") }}',
	                  type: 'error',
	                  styling: 'bootstrap3'
	                 });

					/* Displaying errors */

					var errors = error.responseJSON.errors;
					/* Creating modal body section */
					
					$('.view_container .modal .modal-header').after('<div class="modal-body"></div>');

					for (var key in errors) {
					    $('#'+key+' ~ .help-block').css({'color' : 'red'});
					    $('.view_container .modal .modal-body').append('<li class="text-danger">'+errors[key]+'</li>');
					   
					}
				}

			});
		}
		/** End: AJAX  **/

	});
	/** End: Store action  **/
});

</script>