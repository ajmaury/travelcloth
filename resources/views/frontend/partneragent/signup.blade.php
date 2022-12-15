@extends('frontend.layouts.master')

@section('page_title')
Sign Up
@endsection
@section('content')
<section class="section-bg layout-pt-lg layout-pb-lg">
  <div class="section-bg__item col-12">
    <img src="{{ url('assets/fronted/img/pages/about/1.png') }}" alt="image">
  </div>
  <div class="container">
    <div class="row justify-center text-center">
      <div class="col-xl-6 col-lg-8 col-md-10">
        <h1 class="text-40 md:text-25 fw-600 text-white">Looking for joy?</h1>
        <div class="text-white mt-15">Your trusted trip companion</div>
      </div>
    </div>
  </div>
</section>
<section class="layout-pt-lg layout-pb-lg bg-blue-2">
  <div class="container">
    <div class="row justify-center">
      <div class="col-xl-6 col-lg-7 col-md-9">
        <div class="px-50 py-50 sm:px-20 sm:py-20 bg-white shadow-4 rounded-4 register_output">
          <form method="POST" action="#" id="partneragent_signup">
            @csrf
            <div class="row y-gap-20">
              <div class="col-12">
                <h1 class="text-22 fw-500">Create An ccount</h1>
                <p class="mt-10">Already have an account? <a href="{{ route('partneragent.sign_in') }}" class="text-blue-1">Log
                    in</a>
                </p>
              </div>
              <div class="col-12">
                <div class="form-input">
                  <input type="text" name="companyName" id="companyName">
                  <label class="lh-1 text-14 text-light-1">Company Name</label>
                </div>
                <span class="companyName_err error"></span>
              </div>
              <div class="col-12">
                <div class="form-input">
                  <input type="text" name="fname" id="fname">
                  <label class="lh-1 text-14 text-light-1">First Name</label>
                </div>
                <span class="fname_err error"></span>
              </div>
              <div class="col-12">
                <div class="form-input ">
                  <input type="text" name="lname">
                  <label class="lh-1 text-14 text-light-1">Last Name</label>
                </div>
                <span class="lname_err error"></span>
              </div>
              <div class="col-12">
                <div class="form-input ">
                  <input type="tel" name="mobile">
                  <label class="lh-1 text-14 text-light-1">Enter Mobile Number</label>
                </div>
                <span class="mobile_err error"></span>
              </div>
              <div class="col-12">
                <div class="form-input ">
                  <input type="email" name="email">
                  <label class="lh-1 text-14 text-light-1">Email</label>
                </div>
                <span class="email_err error"></span>
              </div>
              <div class="col-12">
                <div class="form-input ">
                  <input type="password" name="password">
                  <label class="lh-1 text-14 text-light-1">Enter Password</label>
                </div>
                <span class="password_err error"></span>
              </div>
              <div class="col-12">
                <input type="submit" id="register_btn" class="button py-20 -dark-1 bg-blue-1 text-white" value="Next ">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
@push('scripts')
<script>
  
  $(function(){
    $("#partneragent_signup").submit(function(e){
      e.preventDefault();
      $("#register_btn").val("Please wait...");
      $.ajax({
        url: '{{ route('partneragent.register') }}',
        method: 'post',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res){
          console.log(res);
          if($.isEmptyObject(res.error)){
            $(".register_output").html(res.message);
            //toastr.success(res.message);
          }else{
            $("#register_btn").val("Next");
            printErrorMsg(res.error);
          }
        }
      });
    });
    function printErrorMsg(msg){
      $.each(msg, function(key,value){
        $('.'+key+'_err').text(value);
      })
    }
  });
    $(document).delegate("#otpform", "submit", function(e) {
      e.preventDefault();
      $("#verify_otp").val("Please wait...");
      $.ajax({
        url: '{{ route('partneragent.verify_otp') }}',
        method: 'post',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res){
          console.log(res);
          if($.isEmptyObject(res.error)){
            location.href = "{{ route('partneragent.sign_in') }}";
            toastr.success(res.message);
          }else{
            $("#verify_otp").val("Verify OTP");
            printErrorcotpMsg(res.error);
          }
        }
      });
    });
    function printErrorcotpMsg(msg){
      $.each(msg, function(key,value){
        $('.'+key+'_err').text(value);
      })
    }
    //resend otp
    $(document).delegate("#resend_otp","click", function(e){
      e.preventDefault();
      $.ajax({
        url: '{{ route('partneragent.resend_otp') }}',
        dataType: 'json',
        success: function(res){
          console.log(res);
          if($.isEmptyObject(res.error)){
            toastr.success(res.message);
          }else{
            printErrorcotpMsg(res.error);
          }
        }
      });
    });
</script>
@endpush
