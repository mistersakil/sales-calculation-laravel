<script>
$(document).ready(function(){

	/** Project List Datatable **/
	$(function() {

		$('.report_table').DataTable({
			processing	: true,
			serverSide	: true,
			order 		: [0, 'asc'],
			stateSave	: true,
			ajax: '{{ $roles_list_ajax_link }}',
			columns: [
				{ data: 'id', name: 'id', searchable: false, orderable: true},
				{ data: 'name', name: 'name'},
				{ data: 'user_count', name: 'user_count', className: "text-center"},
				{ data: 'permission_count', name: 'permission_count', className: "text-center"},
				{ data: 'description', name: 'description'},
				{ data: 'status', name: 'status', className: "text-center"},
				{ data: 'updated_at', name: 'updated_at', className: "text-center"},
				{ data: 'action', className: "text-center", searchable: false, orderable: false},
			]
		});
	});
	
});
</script>