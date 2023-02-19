@extends('frontend.layouts.associate.dashboard_master')

@section('page_title')
Change Password
@endsection
@section('content')
<div class="dashboard__main">
    <div class="dashboard__content bg-light-2">
        <div class="row y-gap-20 justify-between items-end pb-20 lg:pb-20 md:pb-12">
            <div class="col-auto">
                <h1 class="text-30 lh-14 fw-600">Change Password</h1>
            </div>
            <div class="col-auto"> </div>
        </div>
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="tabs -underline-2 js-tabs">
                @include('frontend.associate.profile.menu')
                <form action="{{ route('associate.changePass.post') }}" method="POST">
                    @csrf
                    
                <div class="col-12 pt-30">
                    <div class="form-input">
                        <input type="password" name="current_password">
                        <label class="lh-1 text-16 text-light-1">Current Password</label>
                    </div>
                    <div class="form-input pt-10">
                        <input type="password" name="new_password">
                        <label class="lh-1 text-16 text-light-1">New Password</label>
                    </div>
                    <div class="form-input pt-10">
                        <input type="password" name="new_confirm_password">
                        <label class="lh-1 text-16 text-light-1">Confirm Password</label>
                    </div>
                    <div class="border-top-light mt-30 mb-30"></div>
                    <div class="d-inline-block">
                        <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                            Change Password
                            <div class="icon-arrow-top-right ml-15"></div>
                        </button>
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