<style>
    .active{
        color: var(--color-blue-1)!important;
        border-bottom: 2px solid;
    }
</style>

<div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">
    <div class="col-auto">
        <a href="{{ route('hotelpartner.profile') }}" class="tabs__button text-18 lg:text-16 text-light-1 fw-500 {{ Request::segment(2) == 'profile' ? 'active':'' }}">Personal Information</a>
    </div>
    <div class="col-auto">
        <a href="{{ route('hotelpartner.changemobile') }}" class="tabs__button text-18 lg:text-16 text-light-1 fw-500 {{ Request::segment(2) == 'change-mobile-number' ? 'active':'' }}">Change Mobile No.</a>
    </div>
    <div class="col-auto">
        <a href="{{ route('hotelpartner.address') }}" class="tabs__button text-18 lg:text-16 text-light-1 fw-500 {{ Request::segment(2) == 'address' ? 'active':'' }}">My Address</a>
    </div>
    <div class="col-auto">
        <a href="{{ route('hotelpartner.kyc') }}" class="tabs__button text-18 lg:text-16 text-light-1 fw-500 {{ Request::segment(2) == 'kyc' ? 'active':'' }}">KYC</a>
    </div>
    <div class="col-auto">
        <a href="{{ route('hotelpartner.changePass') }}" class="tabs__button text-18 lg:text-16 text-light-1 fw-500 {{ Request::segment(2) == 'change-password' ? 'active':'' }}">Change Password</a>
    </div>
</div>