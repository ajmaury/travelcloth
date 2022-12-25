<form method="POST" action="#" id="otpform">
  @csrf
 
  <div class="row y-gap-20">
    <div class="col-12">
      <h1 class="text-22 fw-500">Enter OTP</h1>
      <p class="mt-10">Please check your inbox and then verify it.</a>
      </p>
    </div>
    <div class="col-12">
      <div class="form-input ">
        <input type="tel" name="otp">
        <label class="lh-1 text-14 text-light-1">Enter OTP</label>
      </div>
      <span class="otp_err error"></span>
    </div>
    <div class="col-12">
      <a href="" class="text-14 fw-500 text-blue-1 underline" id="resend_otp">Resend OTP
      </a>
    </div>
    <div class="col-12">
      <input type="submit" id="verify_otp" class="button py-20 -dark-1 bg-blue-1 text-white" value="Verify OTP">
    </div>
  </div>
</form>

