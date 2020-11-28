<script>
$(document).ready(function(){
	collection_report_table();
	/** Project List Datatable **/
	function collection_report_table(){
		$('#report_table').DataTable({
			processing	: true,
			serverSide	: true,
			order 		: [0, 'asc'],
			stateSave	: true,
			ajax: '{{ $collections_list_ajax_link."?ctype=$ctype" }}',
			columns: [
				{ data: 'id', name: 'id', searchable: false, orderable: true},
				{ data: 'project_id', name: 'project_id'},
				{ data: 'amount', name: 'amount'},
				{ data: 'collection_type', name: 'collection_type'},
				{ data: 'collection_date', name: 'collection_date'},
				{ data: 'remark', name: 'remark'},
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
	

	/** End: Project List Datatable **/

	// $('.x_content #report_table').empty();

});
</script>