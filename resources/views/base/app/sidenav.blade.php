<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 ps ps--active-y bg-white" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}">
            <img src="{{ asset('img/wl-logo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto max-height-vh-100 h-100 ps" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link @if(request()->route()->named('admin-home')) active @endif" href="{{ route('home') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-columns"></i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('messages.dashboard')</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->route()->named('events.create')) active @endif" href="{{ route('events.create') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-columns"></i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('messages.new_order')</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->route()->named('events.index')) active @endif" href="{{ route('events.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-columns"></i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('messages.orders')</span>
                </a>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#stockDropdown" class="nav-link @if(request()->route()->named('stock.*')) active @endif" aria-controls="applicationsExamples" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center me-2">
                        <i class="fa fa-columns"></i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('messages.stock')</span>
                </a>
                <div class="collapse" id="stockDropdown">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item ">
                            <a class="nav-link @if(request()->route()->named('stock.current')) active @endif" href="{{ route('stock.current') }}">
                                <span class="sidenav-normal"> @lang('messages.current_stock') </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link @if(request()->route()->named('stock.monthly')) active @endif" href="{{ route('stock.monthly') }}">
                                <span class="sidenav-normal"> @lang('messages.monthly_stock') </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->route()->named('logs.index')) active @endif" href="{{ route('logs.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-columns"></i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('messages.logs')</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->route()->named('reports.index')) active @endif" href="{{ route('reports.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-columns"></i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('messages.invoices')</span>
                </a>
            </li>
        </ul>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 690px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 460px;"></div></div></aside>
