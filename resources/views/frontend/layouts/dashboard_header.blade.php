<header data-add-bg="" class="header -dashboard bg-white js-header" data-x="header" data-x-toggle="is-menu-opened">
  <div data-anim="fade" class="header__container px-30 sm:px-20">
    <div class="-left-side">
      <button data-x-click="dashboard"> <i class="icon-menu-2 text-20"></i> </button>

      <a href="{{ route('home') }}" class="header-logo mr-20" data-x="header-logo" data-x-toggle="is-logo-dark">

        @if($setting->website_logo_dark != null || !empty($setting->website_logo_dark))
        <img src="{{url('storage/logo/'.$setting->website_logo_light)}}" alt="{{$setting->website_title}}"
          style="max-width: 140px;">
        @else
        <img src="{{ url('assets/admin/img/logo-def.png') }}" alt="Logo" style="max-width: 140px;">
        @endif
      </a>
    </div>
    <div class="row justify-between items-center pl-40 lg:pl-20">
      <div class="col-auto">
        <div class="d-flex items-center">
          <div class="single-field relative d-flex items-center md:d-none ml-30">
            <input class="pl-50 border-light text-dark-1 h-50 rounded-8" type="email" placeholder="Search">
            <button class="absolute d-flex items-center h-full"> <i class="icon-search text-20 px-15 text-dark-1"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="col-auto">
        <div class="d-flex items-center">
          <div class="header-menu " data-x="mobile-menu" data-x-toggle="is-menu-active">
            <div class="mobile-overlay"></div>
            <div class="header-menu__content">
              <div class="mobile-bg js-mobile-bg"></div>
              <div class="menu js-navList">
                <ul class="menu__nav text-dark-1 fw-500 -is-active">
                  <li> <a href="about.html"> About Us</a></li>
                  <li> <a href="bookservice.html"> Book Service</a></li>
                  <li> <a href="contactus.html">Contact Us</a></li>
                  <li> <a href="faq.html">FAQ</a></li>
                </ul>
              </div>
              <div class="mobile-footer px-20 py-20 border-top-light js-mobile-footer"> </div>
            </div>
          </div>
          <div class="row items-center x-gap-5 y-gap-20 pl-20 lg:d-none">
            <div class="col-auto">
              <button class="button -blue-1-05 size-50 rounded-22 flex-center"> <i
                  class="icon-notification text-20"></i> </button>
            </div>
          </div>
          <div class="pl-15"> <img src="{{ url('assets/admin/img/avatars/3.png') }}" alt="image" class="size-50 rounded-22 object-cover"> </div>
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