<script>
$(document).ready(function(){

	/** Project List Datatable **/
	$(function() {

		$('#report_table').DataTable({
			processing	: true,
			serverSide	: true,
			order 		: [0, 'asc'],
			stateSave	: true,
			ajax: {
				"url": "{{ $projects_po_details_ajax_link }}",
			    "data": {
			        "date_start" : "{{ $date_start }}",
			        "date_end" : "{{ $date_end }}",
			    }
			},
			columns: [
				{ data: 'id', name: 'id', searchable: false, orderable: true},
				{ data: 'client_id', name: 'client_id'},
				{ data: 'unit', name: 'unit', class : 'text-center'},
				{ data: 'total_amount', name: 'total_amount', class : 'text-center'},
				{ data: 'advance_amount', name: 'advance_amount', class : 'text-center'},
				{ data: 'advance_pending', name: 'advance_pending', class : 'text-center'},
				{ data: 'pending_on_po', name: 'pending_on_po', class : 'text-center'},
				{ data: 'agreement_date', name: 'agreement_date'},
			],
			footerCallback: function (row, data, start, end, display) {
		      var api =  this.api(), data;
		      var bin = api.column( 2, {page:'current'} ).data().sum();
		      var po_value = api.column( 3, {page:'current'} ).data().sum();
		      var advance_received = api.column( 4, {page:'current'} ).data().sum();
		      var advance_pending = api.column( 5, {page:'current'} ).data().sum();
		      var pending_on_po = api.column( 6, {page:'current'} ).data().sum();

		      $( api.column( 1 ).footer() ).html('Total: ').addClass('text-right');
		      $( api.column( 2 ).footer() ).html('<span class="label label-info">BIN</span><br><strong>'+bin.toLocaleString()+'</strong>').addClass('text-center');
		      $( api.column( 3 ).footer() ).html('<span class="label label-info">PO Value</span><br><strong>'+po_value.toLocaleString()+'</strong>').addClass('text-center');
		      $( api.column( 4 ).footer() ).html('<span class="label label-info">Advance Received</span><br><strong>'+advance_received.toLocaleString()+'</strong>').addClass('text-center');
		      $( api.column( 5 ).footer() ).html('<span class="label label-info">Advance Pending</span><br><strong>'+advance_pending.toLocaleString()+'</strong>').addClass('text-center');
		      $( api.column( 6 ).footer() ).html('<span class="label label-info">Pending on PO</span><br><strong>'+pending_on_po.toLocaleString()+'</strong>').addClass('text-center');
		    }
		});
	});
	
});
</script>