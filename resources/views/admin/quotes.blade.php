@extends('admin.layouts.master')

@section('page_title')
Quotes
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
                        <a href="">@yield('page_title')</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6">
            
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
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Pickup Destination</th>
                        <th>Pickup Pincode</th>
                        <th>Drop Destination</th>
                        <th>Drop Pincode</th>
                        <th>No. of Bag</th>
                        <th>Toatl</th>
                        <th>Tax (18%)</th>
                        <th>Grang Total</th>
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
                ajax: '{{ route('quotes') }}',
                columns: [
                    {  data: 'name', name: 'name' },
                    {  data: 'mobile', name: 'mobile' },
                    {  data: 'pickup_destination', name: 'pickup_destination' },
                    {  data: 'pickup_pincode',  name: 'pickup_pincode' },
                    {  data: 'drop_destination', name: 'drop_destination' },
                    { data: 'drop_pincode',  name: 'drop_pincode' },
                    { data: 'no_of_bag',  name: 'no_of_bag'  },
                    { data: 'total',  name: 'total'  },
                    { data: 'tax',  name: 'tax'  },
                    { data: 'grand_total',  name: 'grand_total'  },
                ],
            });
        });
</script>
<script type="text/javascript">
    function changeCustomerStatus(_this, id) {
            var status = $(_this).prop('checked') == true ? 1 : 0;
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: `{{ route('customer.account_status_update') }}`,
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