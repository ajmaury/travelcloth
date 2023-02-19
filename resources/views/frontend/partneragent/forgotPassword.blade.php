@extends('frontend.layouts.master')

@section('page_title')
Forgot Password
@endsection
@section('inner_top_padding')
<div class="header-margin"></div>
@endsection
@section('content')

<section class="layout-pt-lg layout-pb-lg bg-blue-2">
  <div class="container py-50">
    <div class="row justify-center">
      <div class="col-xl-6 col-lg-7 col-md-9">
        
        <div class="px-50 py-50 sm:px-20 sm:py-20 bg-white shadow-4 rounded-4 forgot_output">
            <form method="POST" action="#" id="customer_forgot">
            @csrf
            <div class="row y-gap-20">
              <div class="col-12">
                <h1 class="text-22 fw-500">Recover Password</h1>
                <p>Get the reset password OTP!</p>
              </div>
              <div class="col-12">
                <div class="form-input ">
                  <input type="tel" name="mobile">
                  <label class="lh-1 text-14 text-light-1">Enter Mobile No.</label>
                </div>
                <span class="mobile_err error"></span>
              </div>
              <div class="col-12">
                <input type="submit" id="forgot_btn" class="button py-20 -dark-1 bg-blue-1 text-white" value="Send Reset Password OTP">
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
    $("#customer_forgot").submit(function(e){
      e.preventDefault();
      $("#forgot_btn").val("Please wait...");
      $.ajax({
        url: '{{ route('partneragent.forget.password.post') }}',
        method: 'post',
        data: $(this).serialize(),
        dataType: 'JSON',
        //contentType: false,
       // cache: false,
        processData: false,
        success: function(res){
          console.log(res);
          if($.isEmptyObject(res.error)){
            $(".forgot_output").html(res.message);
            //toastr.success(res.message);
          }else{
            $("#forgot_btn").val("Send Reset Password OTP");
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
        url: '{{ route('partneragent.verify.password') }}',
        method: 'post',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res){
          console.log(res);
          if($.isEmptyObject(res.error)){
            $(".forgot_output").html(res.message);
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
        url: '{{ route('partneragent.resend.otp') }}',
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
    //Set password
    $(document).delegate("#set_pass_form","click", function(e){
      e.preventDefault();
      $("#set_pass").val("Please wait...");
      $.ajax({
        url: '{{ route('partneragent.set.password') }}',
        method: 'post',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res){
          console.log(res);
          if($.isEmptyObject(res.error)){
            location.href = "{{ route('partneragent.sign_in') }}";
            toastr.success(res.message);
          }else{
            $("#set_pass").val("Submit");
            printErrorcotpMsg(res.error);
          }
        }
      });
    });
</script>
@endpush