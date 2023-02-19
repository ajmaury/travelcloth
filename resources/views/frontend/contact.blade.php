@extends('frontend.layouts.master')

@section('page_title')
    Contact Us
@endsection

@section('content')
<section class="section-bg layout-pt-lg layout-pb-lg">
    <div class="section-bg__item col-12">
       <img src="{{ url('assets/fronted/img/pages/become-expert/1.png') }}" alt="image">
    </div>

    <div class="container">
      <div class="row justify-center text-center">
        <div class="col-xl-6 col-lg-8 col-md-10">
          <h1 class="text-40 md:text-25 fw-600 text-white">Frequently </h1>
          <div class="text-white mt-15">Asked Questions</div>
        </div>
      </div>
    </div>
  </section>

  <div class="ratio ratio-16:9">
    <div class="map-ratio">
      <div class="map js-map-single"></div>
    </div>
  </div>

  <section>
    <div class="relative container">
      <div class="row justify-end">
        <div class="col-xl-5 col-lg-7">
          <div class="map-form px-40 pt-40 pb-50 lg:px-30 lg:py-30 md:px-24 md:py-24 bg-white rounded-4 shadow-4">
            <div class="text-22 fw-500">
              Send a message
            </div>

            <div class="row y-gap-20 pt-20">
              <div class="col-12">

                <div class="form-input ">
                  <input type="text" required>
                  <label class="lh-1 text-16 text-light-1">Full Name</label>
                </div>

              </div>
              <div class="col-12">

                <div class="form-input ">
                  <input type="text" required>
                  <label class="lh-1 text-16 text-light-1">Email</label>
                </div>

              </div>
              <div class="col-12">

                <div class="form-input ">
                  <input type="text" required>
                  <label class="lh-1 text-16 text-light-1">Subject</label>
                </div>

              </div>
              <div class="col-12">

                <div class="form-input ">
                  <textarea required rows="4"></textarea>
                  <label class="lh-1 text-16 text-light-1">Your Messages</label>
                </div>

              </div>
              <div class="col-auto">

                <a href="#" class="button px-24 h-50 -dark-1 bg-blue-1 text-white">
                  Send a Messsage <div class="icon-arrow-top-right ml-15"></div>
                </a>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="layout-pt-md layout-pb-lg bg-blue-2">
    <div class="container">
      <div class="row x-gap-80 y-gap-20 justify-between">
        <div class="col-12">
          <div class="text-30 sm:text-24 fw-600">Contact Us</div>
        </div>

        <div class="col-lg-4">
          <div class="text-14 text-light-1">Address</div>
          <div class="text-18 fw-500 mt-10">Vayu Travel Cloth Private Limited<br/>
          516, F2, Sagar Retreat, Vasanthapura, 6th Main Rd, Maruthi Layout, Bengaluru, Karnataka 560061</div>
        </div>

        <div class="col-auto">
          <div class="text-14 text-light-1">Toll Free Customer Care</div>
          <div class="text-18 fw-500 mt-10">+91-9845226644
          </div>
        </div>

        <div class="col-auto">
          <div class="text-14 text-light-1">Need live support?</div> 
           <div class="text-18 fw-500 mt-10">For Support: <a href="mailto:support@travelcloth.com">support@travelcloth.com</a></div> 
<div class="text-18 fw-500 mt-10">For Corporate Information: <a href="mailto:info@travelcloth.com">info@travelcloth.com</a></div>
<div class="text-18 fw-500 mt-10">For Partnerships : <a href="mailto:partners@travelcloth.com">partners@travelcloth.com</a></div>

<div class="text-14 text-light-1 mt-15">Follow us on social media</div>
          <div class="d-flex x-gap-20 items-center mt-10">
           <a href="https://www.facebook.com/travelcloth/"><i class="icon-facebook text-14"></i></a> <a href="https://twitter.com/ClothTravel"><i class="icon-twitter text-14"></i></a> <a href="https://www.instagram.com/travelcloth.com"><i class="icon-instagram text-14"></i></a> <a href="https://www.linkedin.com/company/travel-cloth/"><i class="icon-linkedin text-14"></i></a> <a href="https://www.youtube.com/channel/UC0RdBmOjc5nAzMC7nYgNyGQ"><i class="icon-play text-14"></i></a>
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