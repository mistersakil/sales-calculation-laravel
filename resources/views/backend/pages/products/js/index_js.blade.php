<script>
$(document).ready(function(){

	/** Project List Datatable **/
	$(function() {

		$('.report_table').DataTable({
			processing	: true,
			serverSide	: true,
			order 		: [0, 'asc'],
			stateSave	: true,
			ajax: '{{ $products_list_ajax_link }}',
			columns: [
				{ data: 'id', name: 'id', searchable: false, orderable: true},
				{ data: 'name', name: 'name'},
				{ data: 'projects_count', name: 'projects_count', className: "text-center"},
				{ data: 'code', name: 'code', className: "text-center"},
				{ data: 'platform_id', name: 'platform_id', className: "text-center"},
				{ data: 'status', name: 'status', className: "text-center"},
				{ data: 'updated_at', name: 'updated_at', className: "text-center"},
				{ data: 'action', className: "text-center", searchable: false, orderable: false},
			],
		});
	});
	
});
</script>