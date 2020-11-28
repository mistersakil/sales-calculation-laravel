<script>
$(document).ready(function(){
	generate_report_table();
	/** Generate Report Datatable **/
	function generate_report_table(){
		$('.report_table').DataTable({
			processing	: true,
			serverSide	: true,
			order 		: [0, 'asc'],
			stateSave	: true,
			ajax: '{{ $expenses_list_ajax_link }}',
			columns: [
				{ data: 'id', name: 'id', searchable: false, orderable: true},
				{ data: 'title', name: 'title'},
				{ data: 'amount', name: 'amount'},
				{ data: 'type', name: 'type'},
				{ data: 'status', name: 'status'},
				{ data: 'date', name: 'date'},
				{ data: 'action', className: "text-center", searchable: false, orderable: false},
			],
			footerCallback: function (row, data, start, end, display) {
		      var api =  this.api(), data;
		      var current_page_sum = api.column( 2, {page:'current'} ).data().sum();

		      $( api.column( 1 ).footer() ).html('Total: ').addClass('text-right');
		      $( api.column( 2 ).footer() ).html(current_page_sum.toLocaleString());
		    }
		});				
	}
	

	/** End: Generate Report Datatable **/

});
</script>