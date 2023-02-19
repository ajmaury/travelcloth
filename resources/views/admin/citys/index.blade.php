@extends('admin.layouts.master')

@section('page_title')
    City
@endsection

@push('css')
	<style>
		.table tr td{
			vertical-align: middle;
		}
	</style>
@endpush

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
							<a href="{{ route('citys.index') }}">@yield('page_title')</a>
						</li>
					</ul>
				</div>
				@if (Gate::check('city-create'))
					<div class="col-md-5">
						<div class="create-btn pull-right">
							<a href="{{ route('citys.export') }}" class="btn custom-create-btn"><i
								class="fa fa-file-excel-o"></i> Export</a>
							<a href="javascript:void(0)" data-toggle="modal" data-target="#importCity"
							class="btn custom-create-btn"><i class="fa fa-file-excel-o"></i> Import</a>
							<a href="{{ route('citys.create') }}" class="btn custom-create-btn"><i class="fa fa-plus"></i> Add</a>
						</div>
					</div>
				@endif
			</div>
		</div><!-- /card finish -->	
	</div><!-- /Page Header -->
	<div class="row">
		<div class="col-md-12">
			<p class="error"><strong>Note - </strong>State ID is the State table row ID</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">

			<div class="card">
				<div class="card-body">
					<table class="table table-hover table-center mb-0" id="table">
						<thead>
							<tr>
								<th class="">SL</th>
								<th class="">State</th>
								<th class="">City</th>
								@if(Gate::check('city-edit') || Gate::check('city-delete'))
									<th class="">Action</th>
								@endif 
							</tr>
						</thead>

						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>

		</div>	
	</div>
<div class="modal fade" id="importCity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Import City</h5>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('citys.import') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<label for="statefile">Select File</label>
					<input type="file" name="file" id="statefile" class="form-control" required>
					<br>
					<button class="btn btn-success">
						Import City Data
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection


@push('scripts')
<script>
	$(function() {
		$('#table').DataTable({
			processing	: true,
			responsive 	: false,
			serverSide	: true,
			order:       [[0, 'desc' ]],
			ajax 		: '{{ route('citys.index') }}',
			columns			: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'state', name: 'state' },
					{ data: 'city_name', name: 'city_name' },
					@if(Gate::check('city-edit') || Gate::check('city-delete'))
						{ data: 'action', name: 'action', orderable: false, searchable: false}
					@endif 
				],

		});
	});
</script>

<script type="text/javascript">
	$("body").on("click",".remove-city",function(){
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


<script type="text/javascript">
	function changeCmspageStatus(_this, id) {
		var status = $(_this).prop('checked') == true ? 1 : 0;
		let _token = $('meta[name="csrf-token"]').attr('content');

		$.ajax({
			url: `{{route('citys.status_update')}}`,
			type: 'get',
			data: {
				_token: _token,
				id: id,
				status: status 
			},
			success: function (result) {
				if(status == 1){
					toastr.success(result.message);
				}else{
					toastr.error(result.message);
				} 
			}
		});
	}
</script>
@endpush