<script>
$(document).ready(function(){

	/** Project List Datatable **/
	$(function() {

		$('.report_table').DataTable({
			processing	: true,
			serverSide	: true,
			order 		: [0, 'asc'],
			stateSave	: true,
			ajax: '{{ $users_list_ajax_link }}',
			columns: [
				{ data: 'id', name: 'id', searchable: false, orderable: true},
				{ data: 'name', name: 'name'},
				{ data: 'email', name: 'email'},
				{ data: 'role_id', name: 'role_id'},
				{ data: 'created_at', name: 'created_at'},
				{ data: 'updated_at', name: 'updated_at'},
				{ data: 'status', name: 'status'},
				{ data: 'action', className: "text-center", searchable: false, orderable: false},
			]
		});
	});
	
});
</script>