@extends('admin.layouts.master')

@section('page_title')
    Associate Master
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
							<a href="{{ route('associate.index') }}">@yield('page_title')</a>
						</li>
					</ul>
				</div>
                @if (Gate::check('associate-create'))
                    <div class="col-md-3">
                        <div class="create-btn pull-right">
                            <a href="{{ route('associate.sign_up') }}" class="btn custom-create-btn"><i class="fa fa-plus"></i> Add</a>
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
                                <th class="">Sr. No.</th>
                                <th class="">Associate ID</th>
                                <th class="">Name</th>
                                <th class="">Mobile</th>
                                <th class="">Email</th>
                                <th class="">KYC Status</th>
                                <th class="">Status</th>
                                @if (Gate::check('associate-view'))
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
<!-- Associate View -->
<div class="modal fade" id="associate_view" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
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
                ajax: '{{ route('associate.index') }}',
                columns: [
                    {  data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {  data: 'accountId', name: 'customerId' },
                    {  data: 'fname', name: 'fname' },
                    {  data: 'mobile',  name: 'mobile' },
                    {  data: 'email', name: 'email' },
                    { data: 'kyc_status',  name: 'kycStatus' },
                    { data: 'account_status',  name: 'status'  },
                    @if (Gate::check('associate-view'))
                        { data: 'action', name: 'action', orderable: false, searchable: false}
                    @endif
                ],
            });
        });
    </script>
    <script type="text/javascript">
        function changeAssociateStatus(_this, id) {
            var status = $(_this).prop('checked') == true ? 1 : 0;
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: `{{ route('associate.account_status_update') }}`,
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
        function associateview(customer_id){
            $.ajax({
                url: `{{ route('associate.adminview') }}`,
                type: 'GET',
                data: {
                    customer_id: customer_id
                },
                success: function(result) {
                    $(".modal-content").html(result);
					$("#associate_view").modal("show");
                }
            });
        }
    </script>
@endpush