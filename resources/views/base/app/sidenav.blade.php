<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 ps ps--active-y bg-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto max-height-vh-100 h-100 ps" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if(auth()->user()->isSuperAdmin())
                <li class="nav-item">
                    <a class="nav-link text-white @if(request()->routeIs("super-admin.index")) active @endif" href="{{ route('super-admin.index') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-columns text-reset"></i>
                        </div>
                        <span class="nav-link-text ms-1">@lang('messages.sidenav_super_admin_index')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if(request()->routeIs("super-admin.game-types.*")) active @endif" href="{{ route('super-admin.game-types.index')  }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-gear text-reset"></i>
                        </div>
                        <span class="nav-link-text ms-1">@lang('messages.sidenav_super_admin_settings')</span>
                    </a>
                </li>
            @endif
            @if(auth()->user()->isSchoolAdmin())
                <li class="nav-item">
                    <a class="nav-link text-white @if(request()->routeIs("schools.show")) active @endif" href="{{ route('schools.show', auth()->user()->school_id) }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-school text-reset"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ auth()->user()->school->name }}</span>
                    </a>
                </li>
            @endif
            @if(auth()->user()->isTeacher())
                <li class="nav-item">
                    <a class="nav-link text-white @if(request()->routeIs("teacher.index")) active @endif" href="{{ route('teacher.index') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-school text-reset"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ auth()->user()->school->name }} - Učitelj</span>
                    </a>
                </li>
            @endif
            @can('viewAny', \App\Models\School::class)
                <li class="nav-item">
                    <a class="nav-link text-white @if(request()->routeIs("schools.*")) active @endif" href="{{ route('schools.index') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-school text-reset"></i>
                        </div>
                        <span class="nav-link-text ms-1">@lang('messages.sidenav_school_index')</span>
                    </a>
                </li>
            @endcan
            @can('viewAny', \App\Models\Classroom::class)
                <li class="nav-item">
                    <a class="nav-link text-white @if(request()->routeIs("classrooms.*")) active @endif" href="{{ route('classrooms.index') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-chalkboard-user text-reset"></i>
                        </div>
                        <span class="nav-link-text ms-1">@lang('messages.sidenav_classroom_index')</span>
                    </a>
                </li>
            @endcan
            @can('viewAny', \App\Models\User::class)
                <li class="nav-item">
                    <a class="nav-link text-white @if(request()->routeIs("users.*")) active @endif" href="{{ route('users.index') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-users text-reset"></i>
                        </div>
                        <span class="nav-link-text ms-1">@lang('messages.sidenav_user_index')</span>
                    </a>
                </li>
            @endcan

        </ul>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 690px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 460px;"></div></div></aside>
