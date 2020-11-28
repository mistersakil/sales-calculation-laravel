<script>
$(document).ready(function(){

	/** Display list into datatable **/
	$(function() {

		$('.report_table').DataTable({
			processing	: true,
			serverSide	: true,
			order 		: [0, 'asc'],
			stateSave	: true,
			ajax: '{{ $clients_list_ajax_link }}',
			columns: [
				{ data: 'id', name: 'id', searchable: false, orderable: true},
				{ data: 'name', name: 'name'},
				{ data: 'country_id', name: 'country_id'},
				{ data: 'status', name: 'status', className: "text-center"},
				{ data: 'created_at', name: 'created_at', className: "text-center"},
				{ data: 'updated_at', name: 'updated_at', className: "text-center"},
				{ data: 'action', className: "text-center", searchable: false, orderable: false},
			]
		});
	});

	/** End: Display list into datatable **/
	
});
</script>