<div class="preloader js-preloader">
    <div class="preloader__wrap">
        <div class="preloader__icon">
            <img src="{{ url('assets/fronted/img/general/luggage.svg') }}" alt="luggage" width="38" height="38">
        </div>
    </div>
    <div class="preloader__title">Travel Cloth</div>
</div>
<section class="header-banner py-5 bg-blue-1 z-2">
    <div class="container">
    <div class="row items-center justify-between">
        <div class="col-auto">
        <div class="row x-gap-15 y-gap-15 items-center">
            <marquee style="padding-top: 10px;color:#fff;">Upcoming Sessions: Foundation Course – Waldorf Early Childhood Teacher Training. Dates: 10th August 2022, Location- Pune. To know more call us on 9372513103 / 9873908069</marquee>
        </div>
        </div>

    
    </div>
    </div>
</section>
@yield('inner_top_padding')
<header data-add-bg="-header-5-sticky" class="header mt-40 js-header" data-x="header" data-x-toggle="is-menu-opened"> 
    <div data-anim="fade" class="header__container container">
    <div class="row justify-between items-center">

        <div class="col-auto">
        <div class="d-flex items-center">
            <div class="mr-20">
            <button class="d-flex items-center icon-menu text-dark-1 text-20" data-x-click="desktopMenu"></button>
            </div>

            <a href="index.html" class="header-logo mr-20" data-x="header-logo" data-x-toggle="is-logo-dark">
            
            @if($setting->website_logo_dark != null || !empty($setting->website_logo_dark))
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{url('storage/logo/'.$setting->website_logo_light)}}" alt="{{$setting->website_title}}" style="max-width: 140px;">
                </a>
            @else
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ url('assets/admin/img/logo-def.png') }}" alt="Logo" style="max-width: 140px;">
                </a>
            @endif
            </a>


            <div class="header-menu " data-x="mobile-menu" data-x-toggle="is-menu-active">
            <div class="mobile-overlay"></div>

            <div class="header-menu__content">
                <div class="mobile-bg js-mobile-bg"></div>

                <div class="menu js-navList">
                <ul class="menu__nav text-dark-1 -is-active">

                    <li> <a href="about.html"> About Us</a></li>
                <li> <a href="bookservice.html"> Book Service</a></li>
                <li> <a href="contactus.html">Contact Us</a></li>
                <li> <a href="faq.html">FAQ</a></li>
                </ul>
                </div>

                <div class="mobile-footer px-20 py-20 border-top-light js-mobile-footer">
                </div>
            </div>
            </div>


            <div class="desktopMenu js-desktopMenu" data-x="desktopMenu" data-x-toggle="is-menu-active">
            <div class="desktopMenu-overlay"></div>

            <div class="desktopMenu__content">
                <div class="mobile-bg js-mobile-bg"></div>

                <div class="px-30 py-20 sm:px-20 sm:py-10 border-bottom-light">
                <div class="row justify-between items-center">
                    <div class="col-auto">
                    <div class="text-20 fw-500">Main Menu</div>
                    </div>

                    <div class="col-auto">
                    <button class="icon-close text-15" data-x-click="desktopMenu"></button>
                    </div>
                </div>
                </div>

                <div class="h-full px-30 py-30 sm:px-0 sm:py-10">
                <div class="menu js-navList">
                    <ul class="menu__nav  -is-active">

                        <li> <a href="about.html"> About Us</a></li>
                <li> <a href="bookservice.html"> Book Service</a></li>
                <li> <a href="contactus.html">Contact Us</a></li>
                <li> <a href="faq.html">FAQ</a></li>
                    </ul>
                </div>
                </div>
            </div>
            </div>

        </div>
        </div>


        <div class="col-auto">
        <div class="d-flex items-center">
            <div class="header__buttons d-flex items-center is-menu-opened-hide">
            <a href="login.html" class="button h-50 px-30 fw-400 text-14 bg-blue-1 text-white ml-20 sm:ml-0"><i class="icon-user"></i> &nbsp;Sign In</a>
            </div>
        </div>
        </div>

    </div>
    </div>
</header>