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
      <div class="col-xl-7 col-lg-7 col-md-9">
        <div class="px-50 py-50 sm:px-20 sm:py-20 bg-white shadow-4 rounded-4">
          <div class="row">
            <div class="col-sm-12 mb-20">
                <h2 class="text-center mb-20">Quote Detail</h2>
                <hr class="mb-20" style="width: 22%;margin: auto;border: 2px solid var(--color-blue-1)!important;">
            </div>
            
            <div class="col-sm-12">
              <div class="row pb-5 pt-5">
                <div class="col-sm-8">
                  <h6 style="color:gray;font-weight:500;">Name</h6>
                </div>
                <div class="col-sm-4" style="color:gray;">{{ $quote['name'] }}</div>
              </div>
              <div class="row pb-5 pt-5">
                <div class="col-sm-8">
                  <h6 style="color:gray;font-weight:500;">Mobile No.</h6>
                </div>
                <div class="col-sm-4" style="color:gray;">{{ $quote['mobile'] }}</div>
              </div>
              <div class="row pb-5 pt-5">
                <div class="col-sm-8">
                  <h6 style="color:gray;font-weight:500;">Pickup Destination</h6>
                </div>
                <div class="col-sm-4" style="color:gray;">{{ $pickup_destination }}</div>
              </div>
              <div class="row pb-5 pt-5">
                <div class="col-sm-8">
                  <h6 style="color:gray;font-weight:500;">Pickup Pincode</h6>
                </div>
                <div class="col-sm-4" style="color:gray;">{{ $quote['pickup_pincode'] }}</div>
              </div>
              <div class="row pb-5 pt-5">
                <div class="col-sm-8">
                  <h6 style="color:gray;font-weight:500;">Drop Destination</h6>
                </div>
                <div class="col-sm-4" style="color:gray;">{{ $drop_destination }}</div>
              </div>
              <div class="row pb-5 pt-5">
                <div class="col-sm-8">
                  <h6 style="color:gray;font-weight:500;">Drop Pincode</h6>
                </div>
                <div class="col-sm-4" style="color:gray;">{{ $quote['drop_pincode'] }}</div>
              </div>
              <div class="row pb-5 pt-5" style="border-bottom:1px solid lightgray;">
                <div class="col-sm-8">
                  <h6 style="color:gray;font-weight:500;">No. Of {{ $quote['no_of_bag'] == 1 ? 'Bag':'Bags' }}</h6>
                </div>
                <div class="col-sm-4" style="color:gray;">{{ $quote['no_of_bag'] }}</div>
              </div>
              <div class="row pb-10 pt-10">
                <div class="col-sm-8">
                  <h6>Total</h6>
                </div>
                <div class="col-sm-4">₹ {{ $quote['total'] }}</div>
              </div>
              <div class="row pb-10 pt-10">
                <div class="col-sm-8">
                  <h6>Tax (18%)</h6>
                </div>
                <div class="col-sm-4">₹ {{ $quote['tax'] }}</div>
              </div>
              <div class="row pb-10 pt-10" style="border-top:1px solid lightgray;">
                <div class="col-sm-8">
                  <h6>Grand Total</h6>
                </div>
                <div class="col-sm-4">₹ {{ $quote['grand_total'] }}</div>
              </div>
              <p> <strong>Note - </strong> *Amount Calculated based on standard service. It may change according to Volumetric weight or actual weight of the bagage and also depends on pick up or destination pincode.</p>
              <a href="{{ route('book_service') }}" class="button mt-40 h-50 px-30 fw-400 text-14 bg-blue-1 text-white" style="width: 40%;margin: auto;">
                Book Now
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



@endsection