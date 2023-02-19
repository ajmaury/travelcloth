@extends('admin.layouts.master')

@section('page_title')
    Employee Master
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
							<a href="{{ route('customer.index') }}">@yield('page_title')</a>
						</li>
					</ul>
				</div>
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
                                <th class="">Customer ID</th>
                                <th class="">Name</th>
                                <th class="">Mobile</th>
                                <th class="">Email</th>
                                <th class="">KYC Status</th>
                                <th class="">Status</th>
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
                ajax: '{{ route('employee.index') }}',
                columns: [
                    {  data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {  data: 'accountId', name: 'customerId' },
                    {  data: 'fname', name: 'fname' },
                    {  data: 'mobile',  name: 'mobile' },
                    {  data: 'email', name: 'email' },
                    { data: 'kyc_status',  name: 'kycStatus' },
                    { data: 'account_status',  name: 'status'  }
                ],
            });
        });
    </script>
    <script type="text/javascript">
        function changeEmployeeStatus(_this, id) {
            var status = $(_this).prop('checked') == true ? 1 : 0;
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: `{{ route('employee.account_status_update') }}`,
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
    </script>
@endpush
