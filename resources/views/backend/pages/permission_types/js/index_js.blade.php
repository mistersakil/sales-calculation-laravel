<script>
$(document).ready(function(){

	/** Project List Datatable **/
	$(function() {

		$('.report_table').DataTable({
			processing	: true,
			serverSide	: true,
			order 		: [0, 'asc'],
			stateSave	: true,
			ajax: '{{ $permission_types_list_ajax_link }}',
			columns: [
				{ data: 'id', name: 'id', searchable: false, orderable: true},
				{ data: 'name', name: 'name'},
				{ data: 'permission_count', name: 'permission_count', className: "text-center"},
				{ data: 'status', name: 'status', className: "text-center"},
				{ data: 'created_at', name: 'created_at', className: "text-center"},
				{ data: 'updated_at', name: 'updated_at', className: "text-center"},
				{ data: 'action', className: "text-center", searchable: false, orderable: false},
			]
		});
	});
	
});
</script>