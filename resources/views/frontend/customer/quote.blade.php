@extends('frontend.layouts.dashboard_master')

@section('page_title')
Order
@endsection
@section('content')
<div class="dashboard__main">
    <div class="dashboard__content bg-light-2">
      <div class="row y-gap-20 justify-between items-end pb-20 lg:pb-20 md:pb-12">
        <div class="col-auto">
          <h1 class="text-30 lh-14 fw-600"> My Quotes</h1>
        </div>
        <div class="col-auto"> </div>
      </div>
      <div class="py-30 px-30 rounded-4 bg-white shadow-3">
        <div class="overflow-scroll scroll-bar-1">
          <table class="table-3 -border-bottom col-12">
            <thead class="bg-light-2">
              <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Pickup Destination</th>
                <th>Pickup Pincode</th>
                <th>Drop Destination</th>
                <th>Drop Pincode</th>
                <th>No. of Bag</th>
                <th>Toatl</th>
                <th>Tax (18%)</th>
                <th>Grang Total</th>
              </tr>
            </thead>
            <tbody>
              @if(!empty($quotes) && $quotes->count())
                  @foreach($quotes as $key => $value)
                      <tr>
                          <td>{{ $value->name }}</td>
                          <td>{{ $value->mobile }}</td>
                          <td>{{ $value->pickup_destination }}</td>
                          <td>{{ $value->pickup_pincode }}</td>
                          <td>{{ $value->drop_destination }}</td>
                          <td>{{ $value->drop_pincode }}</td>
                          <td>{{ $value->no_of_bag }}</td>
                          <td>{{ $value->total }}</td>
                          <td>{{ $value->tax }}</td>
                          <td>{{ $value->grand_total }}</td>
                      </tr>
                  @endforeach
              @else
                  <tr>
                      <td colspan="10">There are no data.</td>
                  </tr>
              @endif
            </tbody>
          </table>
          
        </div>
        <div class="row justify-between">
          {!! $quotes->links() !!}
          
        </div>
      </div>
      <footer class="footer -dashboard mt-60">
        <div class="footer__row row y-gap-10 items-center justify-between">
          <div class="col-auto">
            <div class="row y-gap-20 items-center">
              <div class="col-auto">
                <div class="text-14 lh-14 mr-30">© 2022 GoTrip LLC All rights reserved.</div>
              </div>
              <div class="col-auto">
                <div class="row x-gap-20 y-gap-10 items-center text-14">
                  <div class="col-auto"> <a href="#" class="text-13 lh-1">Privacy</a> </div>
                  <div class="col-auto"> <a href="#" class="text-13 lh-1">Terms</a> </div>
                  <div class="col-auto"> <a href="#" class="text-13 lh-1">Site Map</a> </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <div class="d-flex x-gap-5 y-gap-5 items-center">
              <button class="text-14 fw-500 underline">English (US)</button>
              <button class="text-14 fw-500 underline">USD</button>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  @endsection