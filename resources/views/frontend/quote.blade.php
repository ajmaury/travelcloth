@extends('frontend.layouts.master')

@section('page_title')
Quote
@endsection
@section('inner_top_padding')
<div class="header-margin"></div>
@endsection
@section('content')
<link href="{{ url('assets/fronted/css/select2.min.css') }}" rel="stylesheet" />
<section class="layout-pt-lg layout-pb-lg bg-blue-2">
  <div class="container">
    <div class="row justify-center">
      <div class="col-xl-10 col-lg-7 col-md-9">
        <div class="px-50 py-50 sm:px-20 sm:py-20 bg-white shadow-4 rounded-4">
          <form action="{{ route('quote_gen') }}" method="POST">
            @csrf
            <div class="row y-gap-20">
              <div class="col-12">
                <h2 class="text-center mb-20">Generate Your Quote</h2>
                <hr class="mb-20" style="width: 38%;margin: auto;border: 2px solid var(--color-blue-1)!important;">
              </div>
              <div class="col-sm-6">
                <div class="form-group select_box">
                  <label for="pickup_destination" class="required">Pickup Destination</label>
                  <select class="js-example-basic-single" name="pickup_destination" id="pickup_destination" data-live-search="true">
                    <option value="">Select </option>
                    @foreach ($citys as $city)
                    <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group select_box">
                  <label for="drop_destination" class="required">Drop Destination</label>
                  <select class="js-example-basic-single" name="drop_destination" id="drop_destination" data-live-search="true">
                    <option value="">Select </option>
                    @foreach ($citys as $city)
                    <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-input ">
                  <input type="text" name="pickup_pincode" value="{{ old('pickup_pincode') }}">
                  <label class="lh-1 text-14 text-light-1">Pickup Pincode </label>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-input ">
                  <input type="text" name="drop_pincode" value="{{ old('drop_pincode') }}">
                  <label class="lh-1 text-14 text-light-1">Drop Pincode </label>
                </div>
              </div>
  
              <div class="col-sm-6">
                <div class="form-input ">
                  <input type="text" name="name" value="{{ old('name') }}">
                  <label class="lh-1 text-14 text-light-1">Name</label>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-input ">
                  <input type="tel" name="mobile" value="{{ old('mobile') }}">
                  <label class="lh-1 text-14 text-light-1">Mobile No.</label>
                </div>
              </div>
              <div class="col-12">
                <div class="form-input ">
                  <input type="number" name="no_of_bag" value="{{ old('no_of_bag') }}">
                  <label class="lh-1 text-14 text-light-1">No of Bags</label>
                </div>
              </div>
              <div class="col-12 mt-20">
                <button type="submit" class="button py-20 -dark-1 bg-blue-1 text-white" style="width: 20%;margin: auto;">
                  Submit <div class="icon-arrow-top-right ml-15"></button>
                    {{ Session::get('test') }}
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('scripts')

<script src="{{ url('assets/fronted/js/select2.min.js') }}"></script>
<script>  
  $(document).ready(function() {
      $('.js-example-basic-single').select2();
  });
</script>
@endpush