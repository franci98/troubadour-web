@extends("base.app")

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                @isset($dataForm->title)
                    <div class="card card-body mb-4 blur shadow-blur overflow-hidden">
                        <div class="row gx-4">
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h2 class="mb-1">
                                        {{ $dataForm->title }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
                @component("utilities.dataform", array_merge(["dataForm" => $dataForm], $dataForm->extras))@endcomponent
            </div>
        </div>
    </div>
@endsection
