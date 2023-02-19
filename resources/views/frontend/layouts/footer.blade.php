<footer class="footer"  style="background-image:url({{ url('assets/fronted/img/masthead/5/bg.jpg') }})">
    <div class="container">
      <div class="pt-60 pb-60">
        <div class="row y-gap-40 justify-between xl:justify-start">
          <div class="col-xl-4 col-lg-6"> 
            @if($setting->website_logo_dark != null || !empty($setting->website_logo_dark))
                  <a href="{{ route('home') }}" class="logo">
                      <img src="{{url('storage/logo/'.$setting->website_logo_light)}}" alt="{{$setting->website_title}}" style="max-width: 200px;">
                  </a>
              @else
                  <a href="{{ route('home') }}" class="logo">
                      <img src="{{ url('assets/admin/img/logo-def.png') }}" alt="Logo" style="max-width: 200px;">
                  </a>
              @endif
            <div class="row y-gap-30 justify-between pt-30">
              <div class="col-sm-7">
                <div class="text-14">Toll Free Customer Care</div>
                 <a href="tel:+91-9845226644" class="text-18 fw-500 mt-5">+91-9845226644</a>  </div>
              <div class="col-sm-5">
                <div class="text-14">Need live support?</div>
                <a href="mailto:support@travelcloth.com" class="text-18 fw-500 mt-5">support@travelcloth.com</a> </div>
            </div>
            <div class="row x-gap-20 y-gap-15 pt-60">
              <div class="col-12">
                <h5 class="text-16 fw-500">Your all-in-one travel app</h5>
              </div>
             
              <div class="col-auto col-lg-6">
                <div class="d-flex items-center px-20 py-10 bg-white-10">
                  <div class="icon-play-market text-24"></div>
                  <div class="ml-20">
                    <div class="text-14 lh-14">Get in on</div>
                    <div class="text-15 lh-14 fw-500">Google Play</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-60">
              <h5 class="text-16 fw-500 mb-10">Follow us on social media</h5>
              <div class="d-flex x-gap-20 items-center"> 
                <a href="https://www.facebook.com/travelcloth/"><i class="icon-facebook text-14"></i></a> 
                <a href="https://twitter.com/ClothTravel"><i class="icon-twitter text-14"></i></a> 
                <a href="https://www.instagram.com/travelcloth.com"><i class="icon-instagram text-14"></i></a> 
                <a href="https://www.linkedin.com/company/travel-cloth/"><i class="icon-linkedin text-14"></i></a> 
                <a href="https://www.youtube.com/channel/UC0RdBmOjc5nAzMC7nYgNyGQ"><i class="icon-play text-14"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row y-gap-30">
              <div class="col-12">
                <h5 class="text-16 fw-500 mb-15">Get Updates & More</h5>
                <div class="single-field relative d-flex justify-end items-center pb-30">
                  <input class="bg-white rounded-8" type="email" placeholder="Your Email">
                  <button class="absolute px-20 h-full text-15 fw-500 underline text-dark-1">Subscribe</button>
                </div>
              </div>
              <div class="col-lg-6 col-sm-6">
                <h5 class="text-16 fw-500 mb-30">Company</h5>
                <div class="d-flex y-gap-5 flex-column"> 
                  <a href="about.html">About Us</a> 
                  <a href="careers.html">Careers</a> 
                  <a href="agent.html">Become Agent</a> 
                  <a href="hotel.html">Become Hotel</a> 
                  <a href="associated.html">Become Associated</a>  
                </div>
              </div>
              <div class="col-lg-6 col-sm-6">
                <h5 class="text-16 fw-500 mb-30">Support</h5>
                <div class="d-flex y-gap-5 flex-column"> <a href="{{ route('contact') }}">Contact</a>   
                  <a href="{{ route('privacy') }}">Privacy Policy</a> 
                  <a href="{{ route('terms') }}">Terms and Conditions</a> <a href="#">Sitemap</a> </div>
              </div>
               
            </div>
          </div>
        </div>
      </div>
     <div class="py-20 border-top-white-15">
       <div class="row">
              <div class="col-12">
                <div class="text-14 text-center"> © 2022 Travel Cloth All rights reserved. </div>
              </div>
               
            </div>
             
      </div>
    </div>
  </footer>