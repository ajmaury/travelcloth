<header data-add-bg="" class="header -dashboard bg-white js-header" data-x="header" data-x-toggle="is-menu-opened">
  <div data-anim="fade" class="header__container px-30 sm:px-20">
    <div class="-left-side">
      <button data-x-click="dashboard"> <i class="icon-menu-2 text-20"></i> </button>
      <a href="{{ route('home') }}" class="header-logo ml-20" data-x="header-logo" data-x-toggle="is-logo-dark">
        @if($setting->website_logo_dark != null || !empty($setting->website_logo_dark))
        <img src="{{url('storage/logo/'.$setting->website_logo_light)}}" alt="{{$setting->website_title}}"
          style="max-width: 140px;">
        @else
        <img src="{{ url('assets/admin/img/logo-def.png') }}" alt="Logo" style="max-width: 140px;">
        @endif
      </a>
    </div>
    <div class="row justify-between items-center pl-40 lg:pl-20">
      <div class="col-auto"></div>
      <div class="col-auto">
        <div class="d-flex items-center">
          <div class="header-menu " data-x="mobile-menu" data-x-toggle="is-menu-active">
            <div class="mobile-overlay"></div>
            <div class="header-menu__content">
              <div class="mobile-bg js-mobile-bg"></div>
              <div class="menu js-navList">
                <ul class="menu__nav text-dark-1 fw-500 -is-active">
                  <li> <a href="{{ route('about') }}"> About Us</a></li>
                  <li> <a href="{{ route('book_service') }}"> Book Service</a></li>
                  <li> <a href="{{ route('contact') }}">Contact Us</a></li>
                  <li> <a href="{{ route('faq') }}">FAQ</a></li>
                </ul>
              </div>
              <div class="mobile-footer px-20 py-20 border-top-light js-mobile-footer"> </div>
            </div>
          </div>

          <div class="pl-15"> 
            <img src="{{ url('/storage/customer_profile/'.Auth::guard()->user()->image) }}" alt="image" class="size-50 rounded-22 object-cover" onerror="this.src='{{ asset('assets/fronted/img/dummy.png') }}';">
          </div>
          <div class="d-none xl:d-flex x-gap-20 items-center pl-20" data-x="header-mobile-icons"
            data-x-toggle="text-white">
            <div>
              <button class="d-flex items-center icon-menu text-20"
                data-x-click="header, header-logo, header-mobile-icons, mobile-menu"></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>