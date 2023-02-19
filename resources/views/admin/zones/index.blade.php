@extends('admin.layouts.master')

@section('page_title')
    Zone
@endsection

@section('content')
	<!-- Page Header -->
	<div class="page-header">
		<div class="card breadcrumb-card">
			<div class="row justify-content-between align-content-between" style="height: 100%;">
				<div class="col-md-6">
					<h3 class="page-title">@yield('page_title')</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active-breadcrumb">
							<a href="{{ route('zones.index') }}">@yield('page_title')</a>
						</li>
					</ul>
				</div>
				@if (Gate::check('permission-create'))
					<div class="col-md-3">
						<div class="create-btn pull-right">
							<a href="{{ route('zones.create') }}" class="btn custom-create-btn"><i class="fa fa-plus"></i> Add</a>
						</div>
					</div>
				@endif
			</div>
		</div><!-- /card finish -->	
	</div><!-- /Page Header -->

	<div class="row">
		<div class="col-md-12">

			<div class="card">
				<div class="card-body">
					<table class="table table-report -mt-2" id="zone_table">
						<thead>
							<tr>
								<th>Row ID</th>
								<th>Name</th>

								@if(Gate::check('zone-edit') || Gate::check('zone-delete'))
									<th>Action</th>
								@endif 
							</tr>
						</thead>

						<tbody>
							@foreach($zones as $zone)
								<tr>
									<td>{{ $zone->id }}</td>          
									<td>{{ $zone->zone_name }}</td>

									<td>
										@if(Gate::check('zone-edit'))
											<a href="{{route('zones.edit', $zone->id)}}" class="custom-edit-btn mr-1">
												<i class="fe fe-pencil mr-1"></i>Edit
											</a>
										@endif 

										@if( Gate::check('zone-delete'))
											<button class="custom-delete-btn remove-zone" data-id="{{ $zone->id }}" data-action="/admin/zones/destroy">
												<i class="fe fe-trash mr-1"></i>Delete
											</button>
										@endif 
									</td>
								</tr>
							@endforeach
						</tbody>		
					</table>
				</div>
			</div>

		</div> <!-- /col-md-12 -->
	</div> <!-- /row -->
@endsection



@push('scripts')
<script>
	$(document).ready( function () {
		$('#zone_table').DataTable();
	} );
</script>

<script type="text/javascript">
	$("body").on("click",".remove-zone",function(){
		var current_object = $(this);
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this data!",
			type: "error",
			showCancelButton: true,
			dangerMode: true,
			cancelButtonClass: '#DD6B55',
			confirmButtonColor: '#dc3545',
			confirmButtonText: 'Delete!',
		},function (result) {
			if (result) {
				var action = current_object.attr('data-action');
				var token = jQuery('meta[name="csrf-token"]').attr('content');
				var id = current_object.attr('data-id');

				$('body').html("<form class='form-inline remove-form' method='POST' action='"+action+"'></form>");
				$('body').find('.remove-form').append('<input name="_method" type="hidden" value="post">');
				$('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
				$('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
				$('body').find('.remove-form').submit();
			}
		});
	});
</script>
@endpush