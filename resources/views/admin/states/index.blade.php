@extends('admin.layouts.master')

@section('page_title')
State
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
						<a href="{{ route('states.index') }}">@yield('page_title')</a>
					</li>
				</ul>

			</div>

			@if (Gate::check('permission-create'))
			<div class="col-md-5">
				<div class="create-btn pull-right">
					<a href="{{ route('states.export') }}" class="btn custom-create-btn"><i
							class="fa fa-file-excel-o"></i> Export</a>
					<a href="javascript:void(0)" data-toggle="modal" data-target="#importstate"
						class="btn custom-create-btn"><i class="fa fa-file-excel-o"></i> Import</a>
					<a href="{{ route('states.create') }}" class="btn custom-create-btn"><i class="fa fa-plus"></i>
						Add</a>
				</div>
			</div>
			@endif
		</div>

	</div><!-- /card finish -->
</div><!-- /Page Header -->
<div class="row">
	<div class="col-md-12">
		<p class="error"><strong>Note - </strong> Country Type (Domestic = 0, International = 1) and Country ID is the
			country table row ID</p>
	</div>
</div>
<div class="row">
	<div class="col-md-12">

		<div class="card">
			<div class="card-body">
				<table class="table table-report -mt-2" id="state_table">
					<thead>
						<tr>
							<th>Row ID</th>
							<th>Country Type</th>
							<th>Country</th>
							<th>State</th>
							@if(Gate::check('state-edit') || Gate::check('state-delete'))
							<th>Action</th>
							@endif
						</tr>
					</thead>

					<tbody>
						@foreach($states as $state)
						<tr>
							<td>{{ $state['id'] }}</td>
							<td>{{ $state['country_type'] == 0 ? "Domestic":"International"; }}</td>
							<td>{{ $state['country']['country_name'] }}</td>
							<td>{{ $state['state_name'] }}</td>

							<td>
								@if(Gate::check('state-edit'))
								<a href="{{route('states.edit', $state->id)}}" class="custom-edit-btn mr-1">
									<i class="fe fe-pencil mr-1"></i>Edit
								</a>
								@endif

								@if( Gate::check('state-delete'))
								<button class="custom-delete-btn remove-state" data-id="{{ $state->id }}"
									data-action="/admin/states/destroy">
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
<div class="modal fade" id="importstate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Import State</h5>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('states.import') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<label for="statefile">Select File</label>
					<input type="file" name="file" id="statefile" class="form-control" required>
					<br>
					<button class="btn btn-success">
						Import State Data
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
<!-- Modal -->


@push('scripts')
<script>
	$(document).ready( function () {
		$('#state_table').DataTable();
	} );
</script>

<script type="text/javascript">
	$("body").on("click",".remove-state",function(){
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