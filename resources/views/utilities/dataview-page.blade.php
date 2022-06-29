@extends("base.app")

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="@if($dataView->objects != []) col-8 @else col-12 @endif">
                @isset($dataView->title)
                    <div class="card card-body mb-4 blur shadow-blur overflow-hidden">
                        <div class="row gx-4">
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h2>
                                        {{ $dataView->title }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
                @component("utilities.dataview", array_merge(["dataView" => $dataView]))@endcomponent
            </div>
            @if($dataView->objects != [])
                @if(get_class($dataView->objects[0]) == "App\Models\Company")
                    <div class="col-4">
                        @component("components.sidepanel", array_merge(["company" => $dataView->objects[0]]))@endcomponent
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
