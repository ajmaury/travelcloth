<style>
    .active{
        color: var(--color-blue-1)!important;
        border-bottom: 2px solid;
    }
</style>

<div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">
    <div class="col-auto">
        <a href="{{ route('customer.profile') }}" class="tabs__button text-18 lg:text-16 text-light-1 fw-500 {{ Request::segment(1) == 'profile' ? 'active':'' }}">Personal Information</a>
    </div>
    <div class="col-auto">
        <a href="{{ route('customer.changemobile') }}" class="tabs__button text-18 lg:text-16 text-light-1 fw-500 {{ Request::segment(1) == 'change-mobile-number' ? 'active':'' }}">Change Mobile No.</a>
    </div>
    <div class="col-auto">
        <a href="{{ route('customer.address') }}" class="tabs__button text-18 lg:text-16 text-light-1 fw-500 {{ Request::segment(1) == 'address' ? 'active':'' }}">My Address</a>
    </div>
    <div class="col-auto">
        <a href="{{ route('customer.kyc') }}" class="tabs__button text-18 lg:text-16 text-light-1 fw-500 {{ Request::segment(1) == 'kyc' ? 'active':'' }} {{ Request::segment(1) == 'kyc-update' ? 'active':'' }}">KYC</a>
    </div>
    <div class="col-auto">
        <a href="{{ route('customer.changePass') }}" class="tabs__button text-18 lg:text-16 text-light-1 fw-500 {{ Request::segment(1) == 'change-password' ? 'active':'' }}">Change Password</a>
    </div>
</div>