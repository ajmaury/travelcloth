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
                <p class="mt-10">Don't have an account yet? <a href="{{ route('partneragent.sign_up') }}"
                    class="text-blue-1">Sign up for free</a></p>
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
                <a href="#" class="text-14 fw-500 text-blue-1 underline">Forgot your password?</a>
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

<section class="layout-pt-md layout-pb-md bg-dark-2">
  <div class="container">
    <div class="row y-gap-30 justify-between items-center">
      <div class="col-auto">
        <div class="row y-gap-20  flex-wrap items-center">
          <div class="col-auto">
            <div class="icon-newsletter text-60 sm:text-40 text-white"></div>
          </div>

          <div class="col-auto">
            <h4 class="text-26 text-white fw-600">Your Travel Journey Starts Here</h4>
            <div class="text-white">Sign up and we'll send the best deals to you</div>
          </div>
        </div>
      </div>
      <div class="col-auto">
        <div class="single-field -w-410 d-flex x-gap-10 y-gap-20">
          <div>
            <input class="bg-white h-60" type="text" placeholder="Your Email">
          </div>

          <div>
            <button class="button -md h-60 bg-blue-1 text-white">Subscribe</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection