@extends('frontend.layouts.hotelpartner.dashboard_master')
@section('page_title')
Refer Now
@endsection
@section('content')
<div class="dashboard__main">
    <div class="dashboard__content bg-light-2">
        <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
            <div class="col-auto">
                <h1 class="text-30 lh-14 fw-600">Add Refer </h1>
            </div>
            <div class="col-auto"> </div>
        </div>
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="row x-gap-20 y-gap-20">
                <div class="col-4">
                    <div class="form-input ">
                        <input type="text" required>
                        <label class="lh-1 text-16 text-light-1">Name</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-input ">
                        <input type="email">
                        <label class="lh-1 text-16 text-light-1">Email</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-input ">
                        <input type="tel" required>
                        <label class="lh-1 text-16 text-light-1">Phone</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-inline-block"> <a href="#"
                            class="button h-50 px-24 -dark-1 bg-blue-1 text-white"> Submit
                            <div class="icon-arrow-top-right ml-15"></div>
                        </a> </div>
                </div>
            </div>
        </div>
        <footer class="footer -dashboard mt-60">
            <div class="footer__row row y-gap-10 items-center justify-between">
                <div class="col-auto">
                    <div class="row y-gap-20 items-center">
                        <div class="col-auto">
                            <div class="text-14 lh-14 mr-30">© 2022 Travel Cloth All rights reserved.</div>
                        </div>
                        <div class="col-auto">
                            <div class="row x-gap-20 y-gap-10 items-center text-14">
                                <div class="col-auto"> <a href="privacy.html" class="text-13 lh-1">Privacy</a> </div>
                                <div class="col-auto"> <a href="terms.html" class="text-13 lh-1">Terms</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection