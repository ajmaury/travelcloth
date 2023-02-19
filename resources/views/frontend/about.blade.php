@extends('frontend.layouts.master')

@section('page_title')
    About Us
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
  <section class="layout-pt-lg layout-pb-md">
    <div data-anim-wrap class="container">
      <div data-anim-child="slide-up delay-1" class="row justify-center text-center">
        <div class="col-auto">
          <div class="sectionTitle -md">
            <h2 class="sectionTitle__title">Why Choose Us</h2>
            <p class=" sectionTitle__text mt-5 sm:mt-0">These popular destinations have a lot to offer</p>
          </div>
        </div>
      </div>

      <div class="row y-gap-40 justify-between pt-50">

        <div data-anim-child="slide-up delay-2" class="col-lg-3 col-sm-6">

          <div class="featureIcon -type-1 ">
            <div class="d-flex justify-center">
              <img src="#" data-src="{{ url('assets/fronted/img/featureIcons/1/1.svg') }}" alt="image" class="js-lazy">
            </div>

            <div class="text-center mt-30">
              <h4 class="text-18 fw-500">Best Price Guarantee</h4>
              <p class="text-15 mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
          </div>

        </div>

        <div data-anim-child="slide-up delay-3" class="col-lg-3 col-sm-6">

          <div class="featureIcon -type-1 ">
            <div class="d-flex justify-center">
              <img src="#" data-src="{{ url('assets/fronted/img/featureIcons/1/2.svg') }}" alt="image" class="js-lazy">
            </div>

            <div class="text-center mt-30">
              <h4 class="text-18 fw-500">Easy & Quick Booking</h4>
              <p class="text-15 mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
          </div>

        </div>

        <div data-anim-child="slide-up delay-4" class="col-lg-3 col-sm-6">

          <div class="featureIcon -type-1 ">
            <div class="d-flex justify-center">
              <img src="#" data-src="{{ url('assets/fronted/img/featureIcons/1/3.svg') }}" alt="image" class="js-lazy">
            </div>

            <div class="text-center mt-30">
              <h4 class="text-18 fw-500">Customer Care 24/7</h4>
              <p class="text-15 mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
          </div>

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

  <section class="pt-60">
    <div class="container">
      <div class="border-bottom-light pb-40">
        <div class="row y-gap-30 justify-center text-center">

          <div class="col-xl-3 col-6">
            <div class="text-40 lg:text-30 lh-13 fw-600">4,958</div>
            <div class="text-14 lh-14 text-light-1 mt-5">Destinations</div>
          </div>

          <div class="col-xl-3 col-6">
            <div class="text-40 lg:text-30 lh-13 fw-600">2,869</div>
            <div class="text-14 lh-14 text-light-1 mt-5">Total Properties</div>
          </div>

          <div class="col-xl-3 col-6">
            <div class="text-40 lg:text-30 lh-13 fw-600">2M</div>
            <div class="text-14 lh-14 text-light-1 mt-5">Happy customers</div>
          </div>

          <div class="col-xl-3 col-6">
            <div class="text-40 lg:text-30 lh-13 fw-600">574,974</div>
            <div class="text-14 lh-14 text-light-1 mt-5">Our Volunteers</div>
          </div>

        </div>
      </div>
    </div>
  </section>

  
  <section class="section-bg layout-pt-lg layout-pb-lg">
    <div class="section-bg__item -mx-20 bg-light-2"></div>

    <div class="container">
      <div class="row justify-center text-center">
        <div class="col-auto">
          <div class="sectionTitle -md">
            <h2 class="sectionTitle__title pb-30">Our Team</h2> 
          </div>
        </div>
      </div>

      
         <div class="row">

      
          <div class="col-xl-4 col-6">
            <div class="testimonials -type-1 bg-white rounded-4 pt-40 pb-30 px-40"> 
              <p class="testimonials__text text-dark-1" style="line-height: 1.3!important;">Vasudeva brings more than 25 years of experience in service sector with over a decade of business management experience, passionate towards building big business, with good exposure of business practices, in Travel Cloth overall administration, management with key focus on execution, customer experience and Idea to PoC planning. 
                </p>

              <div class="pt-20 mt-28 border-top-light">
                <div class="row x-gap-20 y-gap-20 items-center">
                  <div class="col-auto">
                    <img class="size-60" src="{{ url('assets/fronted/img/avatars/1.png') }}" alt="image">
                  </div>

                  <div class="col-auto">
                    <div class="text-15 fw-500 lh-14">Mr. Vasudeva Murthy</div>
                    <div class="text-14 lh-14 text-light-1 mt-5">Founder & CEO</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

         <div class="col-xl-4 col-6">
            <div class="testimonials -type-1 bg-white rounded-4 pt-40 pb-30 px-40">
               <p class="testimonials__text text-dark-1" style="line-height: 1.3!important;">More than 30 years of experience in various business management held senior level positions at large multinational organisations, proven skills in policy defining and deployment based on the type of business. In Travel Cloth, business monitoring, identifying the potential partners & investors, empanelling partners like insurance, logistics, hotels and legal. Also mentoring the current team for day to day executions and process building

              </p>


              <div class="pt-20 mt-28 border-top-light">
                <div class="row x-gap-20 y-gap-20 items-center">
                  <div class="col-auto">
                    <img class="size-60" src="{{ url('assets/fronted/img/avatars/1.png') }}" alt="image">
                  </div>

                  <div class="col-auto">
                    <div class="text-15 fw-500 lh-14">Mr.Sanjay Choudhary
                    </div>
                    <div class="text-14 lh-14 text-light-1 mt-5">Mentor</div>
                  </div>
                </div>
              </div>
            </div>
       </div>

        <div class="col-xl-4 col-6">
            <div class="testimonials -type-1 bg-white rounded-4 pt-40 pb-30 px-40">
              <p class="testimonials__text text-dark-1" style="line-height: 1.3!important;">More than 20 years of experience in Sales, Marketing, customer support. Core industry experience of e-commerce, e-wallets, proven skills in operations, digital marketing, team management, revenue generation, competitive intelligence, business research. In travel cloth, looking after entire day to day operations in terms of marketing, promotions, logistic management, vendor sourcing, revenue forecasting & revenue generation.


              </p>

              <div class="pt-20 mt-28 border-top-light">
                <div class="row x-gap-20 y-gap-20 items-center">
                  <div class="col-auto">
                    <img class="size-60" src="{{ url('assets/fronted/img/avatars/1.png') }}" alt="image">
                  </div>

                  <div class="col-auto">
                    <div class="text-15 fw-500 lh-14">Mr. Ravi S</div>
                    <div class="text-14 lh-14 text-light-1 mt-5">BD Manager & Marketing Head</div>
                  </div>
                </div>
              </div>
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