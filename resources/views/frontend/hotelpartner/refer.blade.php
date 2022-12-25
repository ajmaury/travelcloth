@extends('frontend.layouts.hotelpartner.dashboard_master')
@section('page_title')
Refer Now
@endsection
@section('content')
<div class="dashboard__main">
  <div class="dashboard__content bg-light-2">
    <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
      <div class="row">
        <div class="col-xl-9 col-md-9">
          <h1 class="text-30 lh-14 fw-600"> Refer Now</h1>
        </div>
        <div class="col-xl-3 col-md-3">
          <button style="margin-left: 55px;" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
            <i class="icon-upload-file text-20 mr-10"></i> <a href="{{ route('hotelpartner.add_refer') }}"> Add More</a>
          </button>
        </div>
      </div>
      <div class="col-auto"> </div>
    </div>
    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
      <div class="tabs -underline-2 js-tabs">
        <div class="tabs__content pt-30 js-tabs-content">
          <div class="tabs__pane -tab-item-1 is-tab-el-active">
            <div class="overflow-scroll scroll-bar-1">
              <table class="table-3 -border-bottom col-12">
                <thead class="bg-light-2">
                  <tr>
                    <th>No.</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>sushant@yahoo.com</td>
                    <td>9619816519</td>
                    <td class="lh-16">05/14/2022</td>
                    <td><span
                        class="rounded-100 py-4 px-10 text-center text-14 fw-500 bg-yellow-4 text-yellow-3">Pending</span>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>ram@yahoo.com</td>
                    <td>9619816519</td>
                    <td class="lh-16">05/14/2022</td>
                    <td><span
                        class="rounded-100 py-4 px-10 text-center text-14 fw-500 bg-blue-1-05 text-blue-1">Confirmed</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="pt-30">
        <div class="row justify-between">
          <div class="col-auto">
            <button class="button -blue-1 size-40 rounded-full border-light"> <i class="icon-chevron-left text-12"></i>
            </button>
          </div>
          <div class="col-auto">
            <div class="row x-gap-20 y-gap-20 items-center">
              <div class="col-auto">
                <div class="size-40 flex-center rounded-full">1</div>
              </div>
              <div class="col-auto">
                <div class="size-40 flex-center rounded-full bg-dark-1 text-white">2</div>
              </div>
              <div class="col-auto">
                <div class="size-40 flex-center rounded-full">3</div>
              </div>
              <div class="col-auto">
                <div class="size-40 flex-center rounded-full bg-light-2">4</div>
              </div>
              <div class="col-auto">
                <div class="size-40 flex-center rounded-full">5</div>
              </div>
              <div class="col-auto">
                <div class="size-40 flex-center rounded-full">...</div>
              </div>
              <div class="col-auto">
                <div class="size-40 flex-center rounded-full">20</div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <button class="button -blue-1 size-40 rounded-full border-light"> <i class="icon-chevron-right text-12"></i>
            </button>
          </div>
        </div>
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
      </div>
    </footer>
  </div>
</div>
@endsection