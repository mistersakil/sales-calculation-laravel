<script>
$(document).ready(function(){

	/** Project List Datatable **/
	$(function() {

		$('.report_table').DataTable({
			processing	: true,
			serverSide	: true,
			order 		: [0, 'asc'],
			stateSave	: true,
			ajax: '{{ $permissions_list_ajax_link }}',
			columns: [
				{ data: 'id', name: 'id', searchable: false, orderable: true},
				{ data: 'name', name: 'name'},
				{ data: 'roles_count', name: 'roles_count', className: "text-center"},
				{ data: 'for', name: 'for'},
				{ data: 'status', name: 'status'},
				{ data: 'created_at', name: 'created_at'},
				{ data: 'updated_at', name: 'updated_at'},
				{ data: 'action', className: "text-center", searchable: false, orderable: false},
			]
		});
	});
	
});
</script>