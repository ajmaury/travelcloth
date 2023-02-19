@extends('frontend.layouts.partneragent.dashboard_master')
@section('page_title')
Profile
@endsection
@section('content')
<style>
    input[type="file"] {
        display: none;
    }
</style>
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
                @include('frontend.partneragent.profile.menu')
                <form method="POST" action="#" id="verifymobileotp">
                    @csrf
                    <div class="col-xl-9 pt-50">
                        <div class="row x-gap-20 y-gap-20">
                            <div class="col-md-6">
                                <div class="form-input ">
                                    <input type="text" readonly value="{{ $customer->mobile }}">
                                    <label class="lh-1 text-16 text-light-1" style="top:20px">Mobile</label>
                                </div>
                            </div>
                            <div class="col-md-6 change_no_output" style="display: flex;">
                                @if ($customer->mobile_verification_status)
                                <span style="background-color: green !important;border-color: green !important;" class="button h-50 px-24 text-white mt-10">Verified</span>
                                @else
                                <a href="javascript:void(0)"
                                    class="button h-50 px-24 -dark-1 bg-blue-1 text-white mt-10 ml-10 verifyno">Send OTP
                                    <div class="icon-arrow-top-right ml-15"></div>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
                <div class="border-top-light mt-30 mb-30"></div>
                <form action="{{ route('partneragent.profile.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row y-gap-30 items-center">
                        <div class="col-auto">
                            <div class="d-flex ratio ratio-1:1 w-200">
                                <img src="{{ url('/storage/customer_profile/'.$customer->image) }}" alt="image" id="display_img" style="max-height: 200px !important;
                            position: inherit;" class="img-ratio rounded-4" onerror="this.src='{{ asset('assets/fronted/img/dummy.png') }}';">
                                <div class="d-flex justify-end px-10 py-10 h-100 w-1/1 absolute">
                                    <div class="size-40 bg-white rounded-4"> 
                                        <a href="{{ route('partneragent.deleteImage') }}"><i class="icon-trash text-16"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <h4 class="text-16 fw-500">Your Profile</h4>
                            <div class="text-14 mt-5">PNG or JPG no bigger than 800px wide and tall.</div>
                            <div class="d-inline-block mt-15">
                                <label class="button h-50 px-24 -dark-1 bg-blue-1 text-white" id="pro_img">
                                    <input type="file" onChange="img_pathUrl(this);" name="pro_img" />
                                    <i class="icon-upload-file text-20 mr-10"></i>
                                    Browse Image
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="border-top-light mt-30 mb-30"></div>
                    <div class="col-xl-9">
                        <div class="row x-gap-20 y-gap-20">
                            <div class="col-md-6">
                                <div class="form-input ">
                                    <input type="text" readonly value="{{ $customer->accountId }}">
                                    <label class="lh-1 text-16 text-light-1" style="top:20px">User ID</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-input ">
                                    <input type="text" readonly value="{{ $customer->email }}">
                                    <label class="lh-1 text-16 text-light-1" style="top:20px">Email</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-input ">
                                    <input type="text" name="companyName" id="companyName" @error('companyName') form-control-error
                                        @enderror" required="required" value="{{$customer->companyName}}">
                                    <label class="lh-1 text-16 text-light-1">Company Name</label>
                                    @error('companyName')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-input ">
                                    <input type="text" name="fname" id="fname" @error('fname') form-control-error
                                        @enderror" required="required" value="{{$customer->fname}}">
                                    <label class="lh-1 text-16 text-light-1">First Name</label>
                                    @error('fname')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-input ">
                                    <input type="text" name="lname" id="lname" @error('lname') form-control-error
                                        @enderror" required="required" value="{{$customer->lname}}">
                                    <label class="lh-1 text-16 text-light-1">Last Name</label>
                                    @error('lname')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="d-inline-block pt-30">
                        <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">Save Changes
                            <div class="icon-arrow-top-right ml-15"></div>
                        </button>
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
    function img_pathUrl(input){
    $('#display_img')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
}
$(document).delegate(".verifyno", "click", function(e) {
    e.preventDefault();
    $.ajax({
    url: '{{ route('partneragent.verifyno') }}',
    dataType: 'json',
    success: function(res){
        $(".change_no_output").html(res);
    }
    });
});
$(function(){
    $("#verifymobileotp").submit(function(e){
      e.preventDefault();
      $.ajax({
        url: '{{ route('partneragent.verify_mobile_otp') }}',
        method: 'post',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res){
            console.log(res);
            if($.isEmptyObject(res.error)){
                toastr.success(res.message);
                location.href = "{{ route('partneragent.profile') }}";
            }else{
                toastr.error(res.error['otp']);
            }
        }
      });
    });
});
</script>
@endpush