<div class="card card-body pt-3">
    <div class="row">
        @if (session('status_message'))
            <div class="col-12" role="alert">
                <div class="alert alert-success text-white" role="alert">
                    <span class="alert-icon"><i class="fa fa-check"></i></span>
                    <span class="alert-text">{{ session('status_message') }}</span>
                </div>
            </div>
        @endif
        @foreach($dataView->items as $item)
                @component("utilities.dataview-item", ["item" => $item])@endcomponent
        @endforeach
    </div>
</div>
@if(isset($dataView->editRoute) || isset($dataView->deleteRoute))
    <div class="card card-body mt-4">
        <div class="row justify-content-end">
            @isset($dataView->editRoute)
                <div class="col-auto">
                    <a class="btn btn-secondary mb-0" href="{{ $dataView->editRoute }}"><i class="fa fa-edit me-2"></i>@lang("messages.edit")</a>
                </div>
            @endisset
            @isset($dataView->deleteRoute)
                <div class="col-auto">
                    <form method="POST" action="{{ $dataView->deleteRoute }}">
                        @csrf
                        @method("DELETE")
                        <button type="button" class="btn btn-danger" onclick="confirmDeletion(this.form)">@lang("messages.delete")</button>
                    </form>
                </div>
            @endisset
        </div>
    </div>
@endisset
