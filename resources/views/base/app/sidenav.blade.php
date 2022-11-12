<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 ps ps--active-y bg-white" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto max-height-vh-100 h-100 ps" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @foreach(auth()->user()->teachersClassrooms as $classroom)
            <li class="nav-item">
                <a class="nav-link @if(request()->is("*/classrooms/$classroom->id*")) active @endif" href="{{ route('classrooms.show', $classroom) }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-columns"></i>
                    </div>
                    <span class="nav-link-text ms-1">{{ $classroom->name }}</span>
                </a>
            </li>
            @endforeach
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs("classrooms.create")) active @endif" href="{{ route('classrooms.create') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-columns"></i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('messages.sidenav_classroom_create')</span>
                </a>
            </li>
            @can('viewAny', \App\Models\School::class)
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs("schools.*")) active @endif" href="{{ route('schools.index') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-columns"></i>
                        </div>
                        <span class="nav-link-text ms-1">@lang('messages.sidenav_school_index')</span>
                    </a>
                </li>
            @endcan
            @can('viewAny', \App\Models\User::class)
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs("users.*")) active @endif" href="{{ route('users.index') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-users"></i>
                        </div>
                        <span class="nav-link-text ms-1">@lang('messages.sidenav_user_index')</span>
                    </a>
                </li>
            @endcan

        </ul>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 690px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 460px;"></div></div></aside>
