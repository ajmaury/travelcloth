@extends('frontend.layouts.associate.dashboard_master')

@section('page_title')
Change Mobile No.
@endsection
@section('content')
<div class="dashboard__main">
    <div class="dashboard__content bg-light-2">
        <div class="row y-gap-20 justify-between items-end pb-20 lg:pb-20 md:pb-12">
            <div class="col-auto">
                <h1 class="text-30 lh-14 fw-600">Change Mobile No.</h1>
            </div>
            <div class="col-auto"> </div>
        </div>
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="tabs -underline-2 js-tabs">
                @include('frontend.associate.profile.menu')
                <form action="{{ route('associate.changePass.post') }}" method="POST">
                    @csrf
                <div class="row">
                    <div class="col-4 pt-30">
                        <div class="form-input">
                            <input type="tel" name="mobile" readonly value="{{ $customer->mobile }}">
                            <label class="lh-1 text-16 text-light-1" style="top:15px;">Current Mobile No.</label>
                        </div>
                    </div>
                    <div class="col-4 pt-40">
                        <div class="d-inline-block">
                            <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                Send OTP
                                <div class="icon-arrow-top-right ml-15"></div>
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <footer class="footer -dashboard mt-60">
            <div class="footer__row row y-gap-10 items-center justify-between">
                <div class="col-auto">
                    <div class="row y-gap-20 items-center">
                        <div class="col-auto">
                            <div class="text-14 lh-14 mr-30">© 2022 Travel Cloth All rights reserved.</div>
                        </div>

                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection