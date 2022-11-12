<!-- Topbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        @include('base.app.breadcrumbs')
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="ms-md-auto navbar-nav justify-content-end">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="profileMenuDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="profileMenuDropdownButton">
                        @if(auth()->user()->isSuperAdmin())
                        <li>
                            <a class="dropdown-item border-radius-md" href="{{ route('admin.game-types.index') }}">
                                <i class="fa fa-gear me-2" aria-hidden="true"></i>
                                <span>@lang('messages.topnav_dropdown_game_types')</span>
                            </a>
                        </li>
                        @endif
                        <li>
                            <form class="mb-0" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item border-radius-md">
                                    <i class="fa fa-sign-out-alt me-2" aria-hidden="true"></i>
                                    <span>@lang('messages.logout')</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End of Topbar -->
