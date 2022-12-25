<div class="dashboard__sidebar bg-white scroll-bar-1">
    <div class="sidebar -dashboard">
      <div class="sidebar__item">
        <div class="sidebar__button -is-active"> <a href="{{ route('customer.my_account') }}" class="d-flex items-center text-15 lh-1 fw-500"> <img src="{{ url('assets/fronted/img/dashboard/sidebar/compass.svg') }}" alt="image" class="mr-15"> Dashboard </a> </div>
      </div>
      <div class="sidebar__item">
        <div class="sidebar__button"> <a href="{{ route('customer.profile') }}" class="d-flex items-center text-15 lh-1 fw-500"> <img src="{{ url('assets/fronted/img/dashboard/sidebar/compass.svg') }}" alt="image" class="mr-15"> My Profile </a> </div>
      </div>
      <div class="sidebar__item">
        <div class="sidebar__button"> <a href="{{ route('customer.order') }}" class="d-flex items-center text-15 lh-1 fw-500"> <img src="{{ url('assets/fronted/img/dashboard/sidebar/booking.svg') }}" alt="image" class="mr-15"> My Orders </a> </div>
      </div>
      <div class="sidebar__item">
        <div class="sidebar__button"> <a href="{{ route('customer.quote') }}" class="d-flex items-center text-15 lh-1 fw-500"> <img src="{{ url('assets/fronted/img/dashboard/sidebar/bookmark.svg') }}" alt="image" class="mr-15"> My Quotes </a> </div>
      </div>
      <div class="sidebar__item">
        <div class="sidebar__button "> <a href="{{ route('customer.logout') }}" class="d-flex items-center text-15 lh-1 fw-500"> <img src="{{ url('assets/fronted/img/dashboard/sidebar/log-out.svg') }}" alt="image" class="mr-15"> Logout </a> </div>
      </div>
    </div>
  </div>