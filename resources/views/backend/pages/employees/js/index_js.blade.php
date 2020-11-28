<script>
$(document).ready(function(){

	/** Brand List Datatable **/
	$(function() {

		$('#report_table').DataTable({
			processing	: true,
			serverSide	: true,
			order 		: [0, 'asc'],
			stateSave	: true,
			ajax: '{{ $employees_list_ajax_link }}',
			columns: [
				{ data: 'id', name: 'id', searchable: false, orderable: true},
				{ data: 'name', name: 'name'},
				{ data: 'designation_id', name: 'designation_id'},
				{ data: 'phone', name: 'phone'},
				{ data: 'email', name: 'email'},
				{ data: 'join_date', name: 'join_date'},
				{ data: 'action', className: "text-center", searchable: false, orderable: false},
			]
		});
	});

	/** End: Brand List Datatable **/
	
});
</script>