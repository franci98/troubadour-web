<!--
=========================================================
* Soft UI Dashboard - v1.0.2
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/soft-ui-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<!DOCTYPE html>
<html lang="sl">
@include('base.app.head')
<body class="g-sidenav-show bg-gray-100">
@auth
    @include('base.app.sidenav')
@endauth
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @auth
        @include('base.app.topnav')
    @endauth
    <div class="@auth container-fluid py-4 @endauth">
        @yield('content')
    </div>
</main>
@include('base.app.scripts')
@stack('scripts')
</body>
</html>
