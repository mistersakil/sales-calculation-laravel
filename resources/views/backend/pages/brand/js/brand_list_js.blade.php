<script>
$(document).ready(function(){

	//* Brand List Datatable *//
	$(function() {

		$('#report_table').DataTable({
			processing	: true,
			serverSide	: true,
			order 		: [0, 'asc'],
			stateSave	: true,
			ajax: '{{ $brand_list_ajax_link }}',
			columns: [
				{ data: 'id', name: 'id', searchable: false, orderable: true},
				{ data: 'name', name: 'name'},
				{ data: 'slug', name: 'slug'},
				{ data: 'body', name: 'body'},
				{ data: 'image', className: "text-center", name: 'image'},
				{ data: 'action', className: "text-center", searchable: false, orderable: false},
			]
		});
	});
	//* End: Brand List Datatable *//
	
});
</script>