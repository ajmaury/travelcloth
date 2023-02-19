@extends('frontend.layouts.master')

@section('page_title')
Sign In
@endsection
@section('inner_top_padding')
<div class="header-margin"></div>
@endsection
@section('content')
<section class="layout-pt-lg layout-pb-lg bg-blue-2">
  <div class="container">
    <div class="row justify-center">
      <div class="col-xl-6 col-lg-7 col-md-9">
        <div class="px-50 py-50 sm:px-20 sm:py-20 bg-white shadow-4 rounded-4">
          <form action="{{ route('partneragent.login_go') }}" method="POST">
            @csrf()
            <div class="row y-gap-20">
              <div class="col-12">
                <h1 class="text-22 fw-500">Welcome back</h1>
                
              </div>
              <div class="col-12">
                <div class="form-input ">
                  <input type="email" name="email">
                  <label class="lh-1 text-14 text-light-1">Email ID</label>
                </div>
              </div>
              <div class="col-12">
                <div class="form-input ">
                  <input type="password" name="password">
                  <label class="lh-1 text-14 text-light-1">Password</label>
                </div>
              </div>
              <div class="col-12">
                <a href="{{ route('partneragent.forget.password.get') }}" class="text-14 fw-500 text-blue-1 underline">Forgot your password?</a>
              </div>
              <div class="col-12">
                <input type="submit" class="button py-20 -dark-1 bg-blue-1 text-white" value="Submit">
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection