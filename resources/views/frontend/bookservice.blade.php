@extends('frontend.layouts.master')

@section('page_title')
    Book Services
@endsection

@section('content')
<section class="section-bg layout-pt-lg layout-pb-lg">
    <div class="section-bg__item col-12">
      <img src="{{ url('assets/fronted/img/pages/about/1.png') }}" alt="image">
    </div>

    <div class="container">
      <div class="row justify-center text-center">
        <div class="col-xl-6 col-lg-8 col-md-10">
          <h1 class="text-40 md:text-25 fw-600 text-white">Book Service</h1>
          <div class="text-white mt-15">Your trusted trip companion</div>
        </div>
      </div>
    </div>
  </section>
  <section class="layout-pt-md">
    <div class="container">
      <div class="row y-gap-30 justify-between items-center">
        <div class="col-lg-5">
          <h2 class="text-30 fw-600">About Travel Cloth</h2>
          <p class="mt-5">Travel Cloth is a one-stop solution for all of your luxury travel management needs.</p>

          <p class="text-dark-1 mt-60 lg:mt-40 md:mt-20">
             A highly skilled team with more than ten years of expertise assists in meeting all travel facilitation requirements. Originated in 2018 to alleviate all concerns about comfort, mobility, and time efficiency. We strive to establish an unparalleled and enduring travel experience for our fellow travellers. We invite travellers to experience the new in travel in today's contemporary era.

          </p>
        </div>

        <div class="col-lg-6">
          <img src="{{ url('assets/fronted/img/pages/about/2.png') }}" alt="image" class="rounded-4">
        </div>
      </div>
    </div>
  </section>
  <section class="layout-pt-md mt-40 layout-pb-md bg-dark-2">
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