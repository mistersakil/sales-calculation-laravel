<script>
$(document).ready(function(){

	/** Project List Datatable **/
	$(function() {

		$('#report_table').DataTable({
			processing	: true,
			serverSide	: true,
			order 		: [0, 'asc'],
			stateSave	: true,
			ajax: '{{ $projects_list_ajax_link."?progress_type=$progress_type" }}',
			columns: [
				{ data: 'id', name: 'id', searchable: false, orderable: true},
				{ data: 'name', name: 'name'},
				{ data: 'advance_amount', name: 'advance_amount'},
				{ data: 'status', name: 'status'},
				{ data: 'action', className: "text-center", searchable: false, orderable: false},
			]
		});
	});
	
});
</script>