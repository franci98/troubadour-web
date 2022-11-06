@if(sizeof($item->items) > 0)
    <div class="col-12 mt-3">
        <div class="row">
            <div class="col-12">
                <h6 class="h5 mb-0 text-primary text-uppercase">{{ $item->title }}</h6>
            </div>
            <div class="col-12">
                <div class="row align-items-center ml-0 mt-1">
                    @foreach($item->items as $subItem)
                        @component("utilities.dataview-item", ["item" => $subItem])@endcomponent
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@else
    <div class="@isset($item->sizeClasses) {{ $item->sizeClasses }} @else col @endif mt-2">
        @switch($item->type)
            @case("status")
            <h5 class="mb-0">{{ $item->title }}</h5>
            {!! $item->value !!}
            @break
            @case("text")
                <span class="text-muted">{{ $item->title }}</span>
                <h5 class="mb-0">{{ $item->value }}</h5>
            @break
            @case("category")
                <div class="alert bg-primary mb-0" role="alert">
                    <h5 class="mb-0 text-white">{{ $item->title }}</h5>
                </div>
            @break
            @case("subCategory")
            <div class="mb-0" role="alert">
                <h4 class="mb-0 border-bottom" style="@if($item->extras["border_only_text"]) display: inline; @endif border-width:3px !important;">{{ $item->title }}</h4>
            </div>
            @break
            @case("richText")
                <h5 class="mb-0 text-primary">{{ $item->title }}</h5>
                {!! $item->value !!}
            @break
            @case("button")
                <a class="{{ $item->extras["classes"] }}" href="{{ $item->value }}">{{ $item->title }}</a>
            @break
            @case("formButton")
                <form action="{{ $item->value }}" method="POST">
                    @method($item->extras["method"])
                    @csrf
                    @foreach($item->extras["data"] as $name => $value)
                        <input type="hidden" name="{{ $name }}" value="{{ $value }}" />
                    @endforeach
                    <button type="submit" class="{{ $item->extras["classes"] }}">{{ $item->title }}</button>
                </form>
            @break
            @case("anchor")
                <a class="{{ $item->extras["classes"] }}" href="{{ $item->value }}">{{ $item->title }}</a>
            @break
            @case("component")
                @component($item->viewName, $item->objects)@endcomponent
            @break
            @case("span")
                @isset($item->title)
                    <h5 class="mb-0">{{ $item->title }}</h5>
                @endisset
                <span class="{{ $item->extras["classes"] }}">{{ $item->value }}</span>
                @break
        @endswitch
    </div>
@endif
