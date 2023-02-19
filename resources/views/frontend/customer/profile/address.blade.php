@extends('frontend.layouts.dashboard_master')

@section('page_title')
Address
@endsection
@section('content')
<div class="dashboard__main">
    <div class="dashboard__content bg-light-2">
        <div class="row y-gap-20 justify-between items-end pb-20 lg:pb-20 md:pb-12">
            <div class="col-auto">
                <h1 class="text-30 lh-14 fw-600">My Profile</h1>
            </div>
            <div class="col-auto"> </div>
        </div>
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="tabs -underline-2 js-tabs">
                @include('frontend.customer.profile.menu')
                <form action="{{ route('customer.address.post') }}" method="POST">
                    @csrf
                    <div class="row x-gap-20 y-gap-20 pt-50">
                        <div class="col-md-12">
                            <div class="form-input ">
                                <input type="text" name="address_line1" id="address_line1" @error('address_line1') form-control-error
                                    @enderror required="required" value="{{$customer->address_line1}}">
                                <label class="lh-1 text-16 text-light-1">Address Line 1</label>
                                @error('address_line1')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-input ">
                                <input type="text" name="address_line2" id="address_line2" @error('address_line2') form-control-error
                                    @enderror required="required" value="{{$customer->address_line2}}">
                                <label class="lh-1 text-16 text-light-1">Address Line 2</label>
                                @error('address_line2')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group select_box">
                                <label for="country_id" class="required">Country</label>
                                <select name="country_id" id="country_id" data-live-search="true">
                                    <option value="">Select Country</option>
                                    @foreach ($countrys as $country)
                                    <option value="{{ $country->id }}" {{ $country->id == $customer->country_id ? 'selected':'' }}>{{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group select_box">
                                <label for="state_id" class="required">State</label>
                                <select name="state_id" id="state_id" data-live-search="true">
                                    <option value="">Select State</option>
                                    
                                </select>
                                @error('state_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group select_box">
                                <label for="city_id" class="required">City</label>
                                <select name="city_id" id="city_id" data-live-search="true">
                                    <option value="">Select City</option>
                                </select>
                                @error('city_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-input ">
                                <input type="text" name="pincode_id" id="pincode_id" @error('pincode_id') form-control-error
                                    @enderror required="required" value="{{$customer->pincode_id}}">
                                <label class="lh-1 text-16 text-light-1">Pin Code</label>
                                @error('pincode_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-inline-block"> 
                                <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">Save Changes
                                    <div class="icon-arrow-top-right ml-15"></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <footer class="footer -dashboard mt-60">
            <div class="footer__row row y-gap-10 items-center justify-between">
                <div class="col-auto">
                    <div class="row y-gap-20 items-center">
                        <div class="col-auto">
                            <div class="text-14 lh-14 mr-30">© 2022 Travel Cloth All rights reserved.</div>
                        </div>

                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        function getState(idCountry,dbstateid){
            $("#state_id").html('');
            $.ajax({
                url: "{{route('customer.getstate')}}",
                type: "POST",
                data: {
                    country_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#state_id').html('<option value="">Select State</option>');
                    $.each(result.states, function (key, value) {
                        if(dbstateid){
                            if(value.id == dbstateid){
                                var selected = "selected";
                            }else{
                                var selected = "";
                            }
                        }else{
                            var selected = "";
                        }
                        $("#state_id").append('<option value="' + value
                            .id + '" '+selected+'>' + value.state_name + '</option>');
                    });
                }
            });
        }
        function getCIty(idState,dbcityid)
        {
            $("#city_id").html('');
            $.ajax({
                url: "{{route('customer.getcity')}}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#city_id').html('<option value="">Select City</option>');
                    $.each(result.citys, function (key, value) {
                        if(dbcityid){
                            if(value.id == dbcityid){
                                var selected = "selected";
                            }else{
                                var selected = "";
                            }
                        }else{
                            var selected = "";
                        }
                        $("#city_id").append('<option value="' + value
                            .id + '" '+selected+'>' + value.city_name + '</option>');
                    });
                    
                }
            });
        }
        //get state
        if($("#country_id").val()){
            var idCountry = $("#country_id").val();
            var dbstateid = '{{ $customer->state_id }}';
            getState(idCountry,dbstateid);
        }
        $('#country_id').on('change', function () {
            var idCountry = $("#country_id").val();
            getState(idCountry,'');
        });
        //get city
        var stateID = '{{ $customer->state_id }}';
        if(typeof(stateID) != "undefined" && stateID !== null) {
            var idState = '{{ $customer->state_id }}';
            var dbCityid = '{{ $customer->city_id }}';
           // alert(dbCityid);
            getCIty(idState,dbCityid);
        }
        $('#state_id').on('change', function () {
            var idState = $("#state_id").val();
            getCIty(idState,'');
        });
        
    });
</script>
@endpush