<script>
$(document).ready(function(){

	/** Datatable **/

	$('#report_table').DataTable({
		processing	: true,
		serverSide	: true,
		order 		: [0, 'asc'],
		stateSave	: true,
		ajax: '{{ $service_charges_current_ajax }}',
		columns: [
			{ data: 'id', name: 'id', searchable: false, orderable: true},
			{ data: 'project_id', name: 'project_id'},
			{ data: 'product', name: 'product'},
			{ data: 'amount', name: 'amount', className : 'text-center'},
			{ data: 'pay_schedule', name: 'pay_schedule'},
			{ data: 'start_date', name: 'start_date'},
			{ data: 'total_pending', name: 'total_pending'},
			{ data: 'collection_type', name: 'collection_type'},
			// { data: 'received', name: 'received'},
			{ data: 'action', className: "text-center", searchable: false, orderable: false},
		],
		footerCallback: function (row, data, start, end, display) {
	      var api =  this.api(), data;
	      var current_page_sum = api.column( 3, {page:'current'} ).data().sum();

	      $( api.column( 2 ).footer() ).html('Total: ').addClass('text-right');
	      $( api.column( 3 ).footer() ).html(current_page_sum.toLocaleString());
	    }
	});


});
</script>