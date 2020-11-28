<div class="alert @if(session('alert_class')){{ session('alert_class') }}@else{{ 'alert-success' }}@endif alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
	</button>
	<strong>{{ session('alert_message') }}</strong>
</div>