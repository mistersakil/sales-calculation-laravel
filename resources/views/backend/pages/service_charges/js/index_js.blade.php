<script>
$(document).ready(function(){

	/** Datatable **/

	$('#report_table').DataTable({
		processing	: true,
		serverSide	: true,
		order 		: [0, 'asc'],
		stateSave	: true,
		ajax: '{{ $service_charges_list_ajax_link }}',
		columns: [
			{ data: 'id', name: 'id', searchable: false, orderable: true},
			{ data: 'project_id', name: 'project_id'},
			{ data: 'amount', name: 'amount'},
			{ data: 'start_date', name: 'start_date'},
			{ data: 'pay_schedule', name: 'pay_schedule'},
			{ data: 'status', name: 'status'},
			{ data: 'remarks', name: 'remarks'},
			{ data: 'action', className: "text-center", searchable: false, orderable: false},
		],
		footerCallback: function (row, data, start, end, display) {
	      var api =  this.api(), data;
	      // var current_page_sum = api.column( 2, {page:'current'} ).data().sum();

	      // $( api.column( 1 ).footer() ).html('Total: ').addClass('text-right');
	      // $( api.column( 2 ).footer() ).html(current_page_sum.toLocaleString());
	    }
	});


});
</script>