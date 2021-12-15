<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('base.landing.head')
<body class="index-page">
@include('base.landing.topnav')
@yield('content')
@include('base.landing.footer')
</body>

</html>
