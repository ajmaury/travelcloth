@php
    $setting = \App\Models\Setting::find(1);
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>@if($setting->website_title != null || !empty($setting->website_title)) {{ $setting->website_title }} @endif | @yield('page_title')</title>
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

<!-- Stylesheets -->
<link rel="stylesheet" href="{{ url('assets/fronted/css/vendors.css') }}">
<link rel="stylesheet" href="{{ url('assets/fronted/css/main.css') }}">

</head>

<body>
<main>
@include('frontend.layouts.header')
@yield('content')
@include('frontend.layouts.footer')
</main>
 
<!-- JavaScript --> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAz77U5XQuEME6TpftaMdX0bBelQxXRlM"></script> 
<script src="{{ url('assets/fronted/js/vendors.js') }}"></script> 
<script src="{{ url('assets/fronted/js/main.js') }}"></script>
</body>
</html>