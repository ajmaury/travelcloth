@php
$setting = \App\Models\Setting::find(1);
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@if($setting->website_title != null || !empty($setting->website_title)) {{ $setting->website_title }} @endif
        | @yield('page_title')</title>
    <!-- Favicon -->
    @if($setting->website_favicon != null || !empty($setting->website_favicon))
    <link rel="shortcut icon" type="image/x-icon" href="{{url('storage/logo/'.$setting->website_favicon)}}">
    @else
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/admin/img/favicon-def.png') }}">
    @endif

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&amp;display=swap" rel="stylesheet">
    <!-- toastr CSS -->
    <link rel="stylesheet" href="{{ url('assets/admin/css/toastr.min.css') }}">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ url('assets/fronted/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ url('assets/fronted/css/main.css') }}">
</head>

<body data-barba="wrapper">
    <div class="preloader js-preloader">
        <div class="preloader__wrap">
            <div class="preloader__icon"> <img src="{{ url('assets/fronted/img/general/luggage.svg') }}" alt="luggage" width="38" height="38">
            </div>
        </div>
        <div class="preloader__title">Travel Cloth</div>
    </div>
    <div class="header-margin"></div>
    @include('frontend.layouts.associate.dashboard_header')

    <div class="dashboard" data-x="dashboard" data-x-toggle="-is-sidebar-open">
        @include('frontend.layouts.associate.dashboard_sidebar')
        @yield('content')
    </div>

    <!-- jQuery -->
    <script src="{{ url('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
    <!-- JavaScript -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAz77U5XQuEME6TpftaMdX0bBelQxXRlM"></script>

    <!-- toastr JS -->
    <script src="{{ url('assets/admin/js/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}
    <link rel="stylesheet"
        href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css') }}" />
    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js') }}"></script>
    <script src="{{ url('assets/fronted/js/vendors.js') }}"></script>
    <script src="{{ url('assets/fronted/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>