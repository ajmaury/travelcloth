@extends('frontend.layouts.master')

@section('page_title')
   Quote
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
            <div class="row y-gap-20">
              <div class="col-12">
                <h1 class="text-22 fw-500">Quote</h1>
                <p class="mt-10">Please register/login to avail quote <a href="login.html" class="text-blue-1">Log in</a></p>
              </div>



<div class="col-12">

                <div class="form-input ">
                  <input type="text" required>
                  <label class="lh-1 text-14 text-light-1">First Name</label>
                </div>

              </div>

              <div class="col-12">

                <div class="form-input ">
                  <input type="text" required>
                  <label class="lh-1 text-14 text-light-1">Mobile No</label>
                </div>

              </div>





<div class="col-12">
              <div class="select js-select js-liveSearch" data-select-value="">
            <button class="select__button js-button">
              <span class="js-button-title">Enter Pick Up Destination</span>
              <i class="select__icon" data-feather="chevron-down"></i>
            </button>

            <div class="select__dropdown js-dropdown">
              <input type="text" placeholder="Search" class="select__search js-search">

              <div class="select__options js-options">
                 

<div class="select__options__button" data-value="Customer">Adugodi</div> 
<div class="select__options__button" data-value="Customer">Agara</div> 
<div class="select__options__button" data-value="Customer">Agram</div> 
<div class="select__options__button" data-value="Customer">Bangalore</div> 
<div class="select__options__button" data-value="Customer">South Bangalore</div> 
<div class="select__options__button" data-value="Customer">Ashoknagar</div> 
<div class="select__options__button" data-value="Customer">Bangalore</div> 
<div class="select__options__button" data-value="Customer">Bannerghatta </div> 

              </div>
            </div>
          </div>
</div>


<div class="col-12">
              <div class="select js-select js-liveSearch" data-select-value="">
            <button class="select__button js-button">
              <span class="js-button-title">Enter Pick Up Destination Pin Code</span>
              <i class="select__icon" data-feather="chevron-down"></i>
            </button>

            <div class="select__dropdown js-dropdown">
              <input type="text" placeholder="Search" class="select__search js-search">

              <div class="select__options js-options">
                 

<div class="select__options__button" data-value="Customer">400091</div> 
<div class="select__options__button" data-value="Customer">400097</div> 
<div class="select__options__button" data-value="Customer">400099</div> 
<div class="select__options__button" data-value="Customer">400092</div> 
<div class="select__options__button" data-value="Customer">400095</div> 
<div class="select__options__button" data-value="Customer">400094</div> 
<div class="select__options__button" data-value="Customer">400092</div> 
<div class="select__options__button" data-value="Customer">400093 </div> 

              </div>
            </div>
          </div>
</div>



<div class="col-12">
              <div class="select js-select js-liveSearch" data-select-value="">
            <button class="select__button js-button">
              <span class="js-button-title">Enter Drop Destination </span>
              <i class="select__icon" data-feather="chevron-down"></i>
            </button>

            <div class="select__dropdown js-dropdown">
              <input type="text" placeholder="Search" class="select__search js-search">

              <div class="select__options js-options">
                 

<div class="select__options__button" data-value="Customer">Adugodi</div> 
<div class="select__options__button" data-value="Customer">Agara</div> 
<div class="select__options__button" data-value="Customer">Agram</div> 
<div class="select__options__button" data-value="Customer">Bangalore</div> 
<div class="select__options__button" data-value="Customer">South Bangalore</div> 
<div class="select__options__button" data-value="Customer">Ashoknagar</div> 
<div class="select__options__button" data-value="Customer">Bangalore</div> 
<div class="select__options__button" data-value="Customer">Bannerghatta </div> 

              </div>
            </div>
          </div>
</div>


<div class="col-12">
              <div class="select js-select js-liveSearch" data-select-value="">
            <button class="select__button js-button">
              <span class="js-button-title">Enter Drop Destination Pin Code</span>
              <i class="select__icon" data-feather="chevron-down"></i>
            </button>

            <div class="select__dropdown js-dropdown">
              <input type="text" placeholder="Search" class="select__search js-search">

              <div class="select__options js-options">
                 

<div class="select__options__button" data-value="Customer">400091</div> 
<div class="select__options__button" data-value="Customer">400097</div> 
<div class="select__options__button" data-value="Customer">400099</div> 
<div class="select__options__button" data-value="Customer">400092</div> 
<div class="select__options__button" data-value="Customer">400095</div> 
<div class="select__options__button" data-value="Customer">400094</div> 
<div class="select__options__button" data-value="Customer">400092</div> 
<div class="select__options__button" data-value="Customer">400093 </div> 

              </div>
            </div>
          </div>
</div>
              



              <div class="col-12">

                <div class="form-input ">
                  <input type="password" required>
                  <label class="lh-1 text-14 text-light-1">No of Bags</label>
                </div>

              </div>

              
               


               

              <div class="col-12">

                <a href="thank-you.html" class="button py-20 -dark-1 bg-blue-1 text-white">
                  Submit <div class="icon-arrow-top-right ml-15"></div>
                </a>

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