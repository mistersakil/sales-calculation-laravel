<script>
$(document).ready(function(){

	/** Datatable **/

	$('.report_table').DataTable({
		order 		: [0, 'asc'],
		stateSave	: true,
	});

	/** Pending List Action **/

	$('.view_container').on('click','.btn_pending',function(e){
		var id = $(this).data('id');
		var url = '{{ $service_charges_pending_single }}';
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

	/** Pending List Action **/



});
</script>