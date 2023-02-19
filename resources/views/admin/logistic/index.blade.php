@extends('admin.layouts.master')

@section('page_title')
    Logistic
@endsection

@push('css')
    <style>
        .table tr td {
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
							<a href="{{ route('logistic.index') }}">@yield('page_title')</a>
						</li>
					</ul>
				</div>
                @if (Gate::check('user-create'))
                    <div class="col-md-3">
                        <div class="create-btn pull-right">
                            <a href="{{ route('logistic.create') }}" class="btn custom-create-btn">Add</a>
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
                    <table class="table table-hover table-center mb-0" id="table">
                        <thead>
                            <tr>
                                <th class="">Logistic ID </th>
                                <th class="">Company Name </th>
                                <th class="">Contact Person</th>
                                <th class="">GST Number</th>
                                <th class="">Bank Name</th>
                                <th class="">Account Number</th>
                                <th class="">IFSC Code</th>
                                <th class="">Status</th>

                                @if (Gate::check('logistic-edit') || Gate::check('logistic-delete'))
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
@endsection
<!--logistic view model-->
<div class="modal fade" id="logistic_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Logistic Detail</h5>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        <div class="modal-body view_output">
          
        </div>
        
      </div>
    </div>
  </div>


@push('scripts')
    <script>
        $(function() {
            $('#table').DataTable({
                processing: true,
                responsive: false,
                serverSide: true,
                order: [
                    [0, 'desc']
                ],
                ajax: '{{ route('logistic.index') }}',
                columns: [
                    {  data: 'logisticId', name: 'logisticId' },
                    {  data: 'cname', name: 'cname' },
                    {  data: 'contact_person',  name: 'contact_person' },
                    {  data: 'gstin', name: 'gstin' },
                    {  data: 'bankname', name: 'bankname' },
                    {  data: 'accountnumber', name: 'accountnumber' },
                    {  data: 'ifsccode', name: 'ifsccode' },
                    { data: 'status',  name: 'status'  },

                    @if (Gate::check('logistic-edit') || Gate::check('logistic-delete'))
                        { data: 'action', name: 'action', orderable: false, searchable: false}
                    @endif
                ],
            });
        });
    </script>

    <script type="text/javascript">
        $("body").on("click", ".remove-logistic", function() {
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
            }, function(result) {
                if (result) {
                    var action = current_object.attr('data-action');
                    var token = jQuery('meta[name="csrf-token"]').attr('content');
                    var id = current_object.attr('data-id');

                    $('body').html("<form class='form-inline remove-form' method='POST' action='" + action + "'></form>");
                    $('body').find('.remove-form').append( '<input name="_method" type="hidden" value="post">');
                    $('body').find('.remove-form').append('<input name="_token" type="hidden" value="' + token + '">');
                    $('body').find('.remove-form').append('<input name="id" type="hidden" value="' + id + '">');
                    $('body').find('.remove-form').submit();
                }
            });
        });
    </script>


    <script type="text/javascript">
        function changeLogisticStatus(_this, id) {
            var status = $(_this).prop('checked') == true ? 1 : 0;
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: `{{ route('logistic.status_update') }}`,
                type: 'GET',
                data: {
                    _token: _token,
                    id: id,
                    status: status
                },
                success: function(result) {
					if(status == 1){
                    	toastr.success(result.message);
                	}else{
                    	toastr.error(result.message);
                	} 
                }
            });
        }
        function logistic_view(id){
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: `{{ route('logistic.view') }}`,
                type: 'GET',
                data: {
                    _token: _token,
                    id: id
                },
                success: function(result) {
                    console.log(result);
                    $(".view_output").html(result);
					$('#logistic_view').modal('toggle'); 
                }
            });
        }
    </script>
@endpush
