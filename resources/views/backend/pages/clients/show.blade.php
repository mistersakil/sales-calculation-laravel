<div class="modal fade" role="dialog">
	<!-- Modal -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<h2 class="text-center text-info">@lang('common.Client') @lang('common.Information')</h2>
			</div>
			<div class="modal-footer">
				
				<div class="row">
					<div class="col-sm-5 col-xs-12 profile_details">
						@isset($model)
						<div class="well profile_view">
							<div class="col-sm-12 col-xs-12">
								<div class="left col-sm-12 col-xs-12">
									<h2 class="text-info">{{ $model->name }}</h2>
									<h4>
									<span class="label label-primary">
										{{ $model->country->name }}
									</span>
									</h4>
									@if(!empty($model->address))
									<p><strong><i class="fa fa-building"></i> Address: </strong> {{ $model->address }} </p>
									@endif
									<ul class="list-unstyled">
										@if(!empty($model->phone))
										<li><i class="fa fa-phone"></i> <strong>Phone: </strong>{{ $model->phone }}</li>
										@endif
										@if(!empty($model->email))
										<li><i class="fa fa-envelope"></i> <strong>Email: </strong>{{ $model->email }}</li>
										@endif
										@if(!empty($model->contact_person))
										<li><i class="fa fa-user"></i> <strong>Contact Person: </strong>{{ $model->contact_person }}</li>
										@endif
										@if(!empty($model->website))
										<li><i class="fa fa-user"></i> <strong>Website: </strong>{{ $model->website }}</li>
										@endif
										@if(!empty($model->status))
										<li>
											<i class="fa fa-sun-o"></i>
											<strong>Status: </strong>
											@if($model->status == 0)
											<span class="label label-default">
												{{ $model->custom_status()[$model->status] }}
											</span>
											@else
											<span class="label label-success">
												{{ $model->custom_status()[$model->status] }}
											</span>
											@endif
										</li>
										@endif
										<li><i class="fa fa-calendar"></i> <strong>Added In System: </strong>{{ $model->created_at->diffForHumans() }}</li>
										
									</ul>
								</div>
							</div>
						</div>
						@endisset
						<!-- /.col -->
					</div>
					<!-- /.col -->
					<div class="col-sm-7 col-xs-12 profile_details">
						@if(count($model->projects))
						<div class="well profile_view">
							<div class="col-sm-12 col-xs-12">
								<div class="left col-sm-12 col-xs-12">
									<h2 class="text-info">@lang('common.Po') @lang('common.Details')</h2> <hr>
									
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Product</th>
												<th>P.O Value</th>
												<th>Advance</th>
												<th>Agreement Date</th>
											</tr>
										</thead>
										<tbody>
											@if(count($model->projects))
											@foreach($model->projects as $project)
											<tr>
												<td>{{ ($project->product->code) }}</td>
												<td>{{ number_format($project->total_amount) }}</td>
												<td>{{ number_format($project->advance_amount) }}</td>
												<td>{{ ($project->agreement_date) }}</td>
											</tr>
											@endforeach
											@endif
										</tbody>
									</table>
									<h2 class="text-info">@lang('common.Collection') @lang('common.Details')</h2> <hr>
									
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Amount</th>
												<th>Collection Type</th>
												<th>Collection Date</th>
											</tr>
										</thead>
										<tbody>
											@php $no_collection = true; @endphp
											@foreach($model->projects as $project)
											@if(count($project->collections))
											@foreach($project->collections as $collection)
											<tr>
												<td>{{ number_format($collection->amount) }}</td>
												<td>{{ $collection->collection_type()[$collection->collection_type] }}</td>
												<td>{{ _custom_date_time($collection->collection_date,'d M, Y') }}</td>
											</tr>
											@endforeach
											@php $no_collection = false; @endphp
											@endif
											@endforeach
											@if($no_collection)
												<tr>
													<td colspan="3">No Collections</td>
												</tr>
											@endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
						
						@endif
						<!-- /.col -->
					</div>
					<!-- /.col -->
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-6 col-xs-12">
						<button type="button" class="btn btn-warning btn-block " data-dismiss="modal">@lang('common.Close')</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!-- End: Modal -->
</div>