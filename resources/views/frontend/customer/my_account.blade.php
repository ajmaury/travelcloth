@extends('frontend.layouts.dashboard_master')

@section('page_title')
My Account
@endsection
@section('content')
<div class="dashboard__main">
    <div class="dashboard__content bg-light-2">
        <div class="row y-gap-20 justify-between items-end pb-20 lg:pb-20 md:pb-12">
            <div class="col-auto">
                <h1 class="text-30 lh-14 fw-600">Dashboard</h1>
            </div>
            <div class="col-auto"> </div>
        </div>
        <div class="row y-gap-30">
            
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