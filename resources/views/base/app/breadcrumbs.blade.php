@isset($breadcrumbs)
    <nav aria-label="breadcrumb" class="mx-2">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            @foreach($breadcrumbs as $i => $breadcrumb)
                @if($i != count($breadcrumbs) - 1)
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['title'] }}</a></li>
                @endif
            @endforeach
        </ol>
        <h6 class="font-weight-bolder mb-0">{{ $breadcrumbs[count($breadcrumbs) - 1]['title'] }}</h6>
    </nav>
@endisset
