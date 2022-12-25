@extends('frontend.layouts.master')

@section('page_title')
    Home Page
@endsection

@section('content')
<section data-anim-wrap class="masthead -type-5">
  <div data-anim-child="fade" class="masthead__bg"> <img src="{{ url('assets/fronted/img/masthead/5/bg.svg') }}" alt="image"> </div>
  <div class="container">
    <div class="row">
      <div class="col-xl-7">
        <h1 data-anim-child="slide-up delay-4" class="text-60 lg:text-40 md:text-30">Best Travel <span class="text-blue-1 relative">Experience <span class="-line"><img src="{{ url('assets/fronted/img/general/line.png') }}" alt="image"></span></span></h1>
        <p data-anim-child="slide-up delay-5" class="mt-20">Experience the various exciting tour and travel packages and Make hotel reservations, find<br class="lg:d-none">
          vacation packages, search cheap hotels and events</p>
        <div data-anim-child="slide-up delay-6" class="mainSearch bg-white pr-20 py-20 lg:px-20 lg:pt-5 lg:pb-20 rounded-4 shadow-1 mt-35">
          <div class="button-grid items-center">
            <div class="searchMenu-loc px-30 lg:py-20 lg:px-0 js-form-dd js-liverSearch">
              <div data-x-dd-click="searchMenu-loc">
                <h4 class="text-15 fw-500 ls-2 lh-16">Search Available On Pincode</h4>
                <div class="text-15 text-light-1 ls-2 lh-16">
                  <input autocomplete="off" type="search" placeholder="Where are you going?" class="js-search js-dd-focus" />
                </div>
              </div>
              <div class="searchMenu-loc__field shadow-2 js-popup-window" data-x-dd="searchMenu-loc" data-x-dd-toggle="-is-active">
                <div class="bg-white px-30 py-30 sm:px-0 sm:py-15 rounded-4">
                  <div class="y-gap-5 js-results">
                    <div>
                      <button class="-link d-block col-12 text-left rounded-4 px-20 py-15 js-search-option">
                      <div class="d-flex">
                        <div class="icon-location-2 text-light-1 text-20 pt-4"></div>
                        <div class="ml-10">
                          <div class="text-15 lh-12 fw-500 js-search-option-target">London</div>
                          <div class="text-14 lh-12 text-light-1 mt-5">Greater London, United Kingdom</div>
                        </div>
                      </div>
                      </button>
                    </div>
                    <div>
                      <button class="-link d-block col-12 text-left rounded-4 px-20 py-15 js-search-option">
                      <div class="d-flex">
                        <div class="icon-location-2 text-light-1 text-20 pt-4"></div>
                        <div class="ml-10">
                          <div class="text-15 lh-12 fw-500 js-search-option-target">New York</div>
                          <div class="text-14 lh-12 text-light-1 mt-5">New York State, United States</div>
                        </div>
                      </div>
                      </button>
                    </div>
                    <div>
                      <button class="-link d-block col-12 text-left rounded-4 px-20 py-15 js-search-option">
                      <div class="d-flex">
                        <div class="icon-location-2 text-light-1 text-20 pt-4"></div>
                        <div class="ml-10">
                          <div class="text-15 lh-12 fw-500 js-search-option-target">Paris</div>
                          <div class="text-14 lh-12 text-light-1 mt-5">France</div>
                        </div>
                      </div>
                      </button>
                    </div>
                    <div>
                      <button class="-link d-block col-12 text-left rounded-4 px-20 py-15 js-search-option">
                      <div class="d-flex">
                        <div class="icon-location-2 text-light-1 text-20 pt-4"></div>
                        <div class="ml-10">
                          <div class="text-15 lh-12 fw-500 js-search-option-target">Madrid</div>
                          <div class="text-14 lh-12 text-light-1 mt-5">Spain</div>
                        </div>
                      </div>
                      </button>
                    </div>
                    <div>
                      <button class="-link d-block col-12 text-left rounded-4 px-20 py-15 js-search-option">
                      <div class="d-flex">
                        <div class="icon-location-2 text-light-1 text-20 pt-4"></div>
                        <div class="ml-10">
                          <div class="text-15 lh-12 fw-500 js-search-option-target">Santorini</div>
                          <div class="text-14 lh-12 text-light-1 mt-5">Greece</div>
                        </div>
                      </div>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="button-item">
              <button class="mainSearch__submit button -dark-1 py-15 px-35 h-60 col-12 rounded-4 bg-blue-1 text-white"> <i class="icon-search text-20 mr-10"></i> Search </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div data-anim-child="fade" class="masthead__image"> <img src="{{ url('assets/fronted/img/masthead/5/1.png') }}" alt="image"> </div>
</section>
<section class="layout-pt-lg layout-pb-md">
  <div data-anim-wrap="" class="container animated">
    <div data-anim-child="slide-up delay-1" class="row justify-center text-center is-in-view">
      <div class="col-auto">
        <div class="sectionTitle -md">
          <h2 class="sectionTitle__title">Benefits</h2>
          <p class=" sectionTitle__text mt-5 sm:mt-0">These popular destinations have a lot to offer</p>
        </div>
      </div>
    </div>

    <div class="row y-gap-40 justify-between pt-40 sm:pt-20">

      <div data-anim-child="slide-up delay-2" class="col-lg-4 col-sm-6 is-in-view">

        <div class="featureIcon -type-1 -hover-shadow px-50 py-50 lg:px-24 lg:py-15">
          <div class="d-flex justify-center">
            <img src="{{ url('assets/fronted/img/featureIcons/1/1.svg') }}" alt="image" class="js-lazy loaded" data-ll-status="loaded">
          </div>

          <div class="text-center mt-30">
            <h4 class="text-18 fw-500">Best Price Guarantee</h4>
            <p class="text-15 mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </div>

      </div>

      <div data-anim-child="slide-up delay-3" class="col-lg-4 col-sm-6 is-in-view">

        <div class="featureIcon -type-1 -hover-shadow px-50 py-50 lg:px-24 lg:py-15">
          <div class="d-flex justify-center">
            <img src="{{ url('assets/fronted/img/featureIcons/1/2.svg') }}" alt="image" class="js-lazy loaded" data-ll-status="loaded">
          </div>

          <div class="text-center mt-30">
            <h4 class="text-18 fw-500">Easy &amp; Quick Booking</h4>
            <p class="text-15 mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </div>

      </div>

      <div data-anim-child="slide-up delay-4" class="col-lg-4 col-sm-6 is-in-view">

        <div class="featureIcon -type-1 -hover-shadow px-50 py-50 lg:px-24 lg:py-15">
          <div class="d-flex justify-center">
            <img src="{{ url('assets/fronted/img/featureIcons/1/3.svg') }}" alt="image" class="js-lazy loaded" data-ll-status="loaded">
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

<section class="layout-pt-md layout-pb-lg">
  <div class="container">
    <div class="row y-gap-15 justify-center text-center">
      <div class="col-xl-3 col-sm-6">
        <div class="text-40 lh-13 text-blue-1 fw-600">4,958</div>
        <div class="text-14 lh-14 text-light-1 mt-5">Destinations</div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="text-40 lh-13 text-blue-1 fw-600">2,869</div>
        <div class="text-14 lh-14 text-light-1 mt-5">Total Properties</div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="text-40 lh-13 text-blue-1 fw-600">2M</div>
        <div class="text-14 lh-14 text-light-1 mt-5">Happy customers</div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="text-40 lh-13 text-blue-1 fw-600">574,974</div>
        <div class="text-14 lh-14 text-light-1 mt-5">Our Volunteers</div>
      </div>
    </div>
  </div>
</section>
<section class="section-bg layout-pt-lg md:pt-0 md:pb-60 sm:pb-40 layout-pb-lg bg-blue-1-05">
  <div class="section-bg__item -right -image col-5 md:mb-60 sm:mb-40"> <img src="{{ url('assets/fronted/img/backgrounds/5.png') }}" alt="image"> </div>
  <div class="container">
    <div class="row">
      <div class="col-xl-4 col-md-7">
        <h2 class="text-30 fw-600">Why Choose Us</h2>
        <p class="mt-5">These popular destinations have a lot to offer</p>
        <div class="row y-gap-30 pt-60 md:pt-40">
          <div class="col-12">
            <div class="d-flex pr-30"> <img class="size-50" src="{{ url('assets/fronted/img/featureIcons/1/1.svg') }}" alt="image">
              <div class="ml-15">
                <h4 class="text-18 fw-500">Best Price Guarantee</h4>
                <p class="text-15 mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="d-flex pr-30"> <img class="size-50" src="{{ url('assets/fronted/img/featureIcons/1/2.svg') }}" alt="image">
              <div class="ml-15">
                <h4 class="text-18 fw-500">Easy & Quick Booking</h4>
                <p class="text-15 mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="d-flex pr-30"> <img class="size-50" src="{{ url('assets/fronted/img/featureIcons/1/3.svg') }}" alt="image">
              <div class="ml-15">
                <h4 class="text-18 fw-500">Customer Care 24/7</h4>
                <p class="text-15 mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section-bg layout-pt-lg layout-pb-lg bg-light-2">
    <div class="section-bg__item col-12">
      <img src="{{ url('assets/fronted/img/backgrounds/testimonials/bg-2.svg') }}" alt="image">
    </div>

    <div data-anim-wrap="" class="container animated">
      <div data-anim-child="slide-up delay-1" class="row justify-center text-center is-in-view">
        <div class="col-auto">
          <div class="sectionTitle -md">
            <h2 class="sectionTitle__title">Testimonials</h2>
            <p class=" sectionTitle__text mt-5 sm:mt-0">Interdum et malesuada fames ac ante ipsum</p>
          </div>
        </div>
      </div>

      <div data-anim-child="slide-up delay-2" class="row justify-center pt-50 md:pt-30 is-in-view">
        <div class="col-xl-7 col-lg-10">
          <div class="overflow-hidden js-testimonials-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
            <div class="swiper-wrapper" id="swiper-wrapper-3d7ad1027ff21d111" aria-live="polite" style="transition-duration: 0ms; transform: translate3d(-1905px, 0px, 0px);"><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4" role="group" aria-label="5 / 5" style="width: 635px;">
                <div class="testimonials -type-2 text-center">
                  <div class="mb-40">
                    <img src="{{ url('assets/fronted/img/misc/quote.svg') }}" alt="quote">
                  </div>

                  <div class="text-22 md:text-18 fw-600 text-dark-1">
                    "Our family was traveling via bullet train between cities in Japan with our luggage - the location for this hotel made that so easy. Agoda price was fantastic."
                  </div>

                  <div class="mt-40">
                    <h5 class="text-17 lh-15 fw-500">Ali Tufan</h5>
                    <div class="">Product Manager, Apple Inc</div>
                  </div>
                </div>
              </div>

              <div class="swiper-slide" data-swiper-slide-index="0" role="group" aria-label="1 / 5" style="width: 635px;">
                <div class="testimonials -type-2 text-center">
                  <div class="mb-40">
                    <img src="{{ url('assets/fronted/img/misc/quote.svg') }}" alt="quote">
                  </div>

                  <div class="text-22 md:text-18 fw-600 text-dark-1">
                    "Our family was traveling via bullet train between cities in Japan with our luggage - the location for this hotel made that so easy. Agoda price was fantastic."
                  </div>

                  <div class="mt-40">
                    <h5 class="text-17 lh-15 fw-500">Ali Tufan</h5>
                    <div class="">Product Manager, Apple Inc</div>
                  </div>
                </div>
              </div>

              <div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="1" role="group" aria-label="2 / 5" style="width: 635px;">
                <div class="testimonials -type-2 text-center">
                  <div class="mb-40">
                    <img src="{{ url('assets/fronted/img/misc/quote.svg') }}" alt="quote">
                  </div>

                  <div class="text-22 md:text-18 fw-600 text-dark-1">
                    "Our family was traveling via bullet train between cities in Japan with our luggage - the location for this hotel made that so easy. Agoda price was fantastic."
                  </div>

                  <div class="mt-40">
                    <h5 class="text-17 lh-15 fw-500">Ali Tufan</h5>
                    <div class="">Product Manager, Apple Inc</div>
                  </div>
                </div>
              </div>

              <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="2" role="group" aria-label="3 / 5" style="width: 635px;">
                <div class="testimonials -type-2 text-center">
                  <div class="mb-40">
                    <img src="{{ url('assets/fronted/img/misc/quote.svg') }}" alt="quote">
                  </div>

                  <div class="text-22 md:text-18 fw-600 text-dark-1">
                    "Our family was traveling via bullet train between cities in Japan with our luggage - the location for this hotel made that so easy. Agoda price was fantastic."
                  </div>

                  <div class="mt-40">
                    <h5 class="text-17 lh-15 fw-500">Ali Tufan</h5>
                    <div class="">Product Manager, Apple Inc</div>
                  </div>
                </div>
              </div>

              <div class="swiper-slide swiper-slide-next" data-swiper-slide-index="3" role="group" aria-label="4 / 5" style="width: 635px;">
                <div class="testimonials -type-2 text-center">
                  <div class="mb-40">
                    <img src="{{ url('assets/fronted/img/misc/quote.svg') }}" alt="quote">
                  </div>

                  <div class="text-22 md:text-18 fw-600 text-dark-1">
                    "Our family was traveling via bullet train between cities in Japan with our luggage - the location for this hotel made that so easy. Agoda price was fantastic."
                  </div>

                  <div class="mt-40">
                    <h5 class="text-17 lh-15 fw-500">Ali Tufan</h5>
                    <div class="">Product Manager, Apple Inc</div>
                  </div>
                </div>
              </div>

              <div class="swiper-slide" data-swiper-slide-index="4" role="group" aria-label="5 / 5" style="width: 635px;">
                <div class="testimonials -type-2 text-center">
                  <div class="mb-40">
                    <img src="{{ url('assets/fronted/img/misc/quote.svg') }}" alt="quote">
                  </div>

                  <div class="text-22 md:text-18 fw-600 text-dark-1">
                    "Our family was traveling via bullet train between cities in Japan with our luggage - the location for this hotel made that so easy. Agoda price was fantastic."
                  </div>

                  <div class="mt-40">
                    <h5 class="text-17 lh-15 fw-500">Ali Tufan</h5>
                    <div class="">Product Manager, Apple Inc</div>
                  </div>
                </div>
              </div>

            <div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" role="group" aria-label="1 / 5" style="width: 635px;">
                <div class="testimonials -type-2 text-center">
                  <div class="mb-40">
                    <img src="{{ url('assets/fronted/img/misc/quote.svg') }}" alt="quote">
                  </div>

                  <div class="text-22 md:text-18 fw-600 text-dark-1">
                    "Our family was traveling via bullet train between cities in Japan with our luggage - the location for this hotel made that so easy. Agoda price was fantastic."
                  </div>

                  <div class="mt-40">
                    <h5 class="text-17 lh-15 fw-500">Ali Tufan</h5>
                    <div class="">Product Manager, Apple Inc</div>
                  </div>
                </div>
              </div></div>

            <div class="pt-60 lg:pt-40">
              <div class="pagination -avatars row x-gap-40 y-gap-20 justify-center js-testimonials-pagination">

                <div class="col-auto">
                  <div class="pagination__item">
                    <img src="{{ url('assets/fronted/img/avatars/testimonials/1.png') }}" alt="image">
                  </div>
                </div>

                <div class="col-auto">
                  <div class="pagination__item">
                    <img src="{{ url('assets/fronted/img/avatars/testimonials/2.png') }}" alt="image">
                  </div>
                </div>

                <div class="col-auto">
                  <div class="pagination__item is-active">
                    <img src="{{ url('assets/fronted/img/avatars/testimonials/3.png') }}" alt="image">
                  </div>
                </div>

                <div class="col-auto">
                  <div class="pagination__item">
                    <img src="{{ url('assets/fronted/img/avatars/testimonials/4.png') }}" alt="image">
                  </div>
                </div>

                <div class="col-auto">
                  <div class="pagination__item">
                    <img src="{{ url('assets/fronted/img/avatars/testimonials/5.png') }}" alt="image">
                  </div>
                </div>

              </div>
            </div>
          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
        </div>
      </div>
    </div>
  </section>
@endsection