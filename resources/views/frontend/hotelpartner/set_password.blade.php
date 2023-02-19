<form method="POST" action="#" id="set_pass_form">
    @csrf
   
    <div class="row y-gap-20">
      <div class="col-12">
        <h1 class="text-22 fw-500">Please set your desire password...</h1>
        </p>
      </div>
      <div class="col-12">
        <div class="form-input ">
          <input type="password" name="password">
          <label class="lh-1 text-14 text-light-1">Set Password</label>
        </div>
        <span class="password_err error"></span>
      </div>
      <div class="col-12">
        <div class="form-input ">
          <input type="password" name="password_confirmation">
          <label class="lh-1 text-14 text-light-1">Confirm Password</label>
        </div>
        <span class="password_confirmation_err error"></span>
      </div>
      <div class="col-12">
        <input type="submit" id="set_pass" class="button py-20 -dark-1 bg-blue-1 text-white" value="Submit">
      </div>
    </div>
  </form>
  
  