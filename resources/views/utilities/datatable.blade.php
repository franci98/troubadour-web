@extends("base.app")

@section("content")
    @isset($dataTable->title)
        <div class="card card-body mb-4 blur shadow-blur overflow-hidden">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h2>
                            {{ $dataTable->title }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    <div class="card mb-3">
        @if($dataTable->containsSearchable() || $dataTable->containsButtons())
            <div class="card-body py-3">
                <div class="row justify-content-end align-items-center">
                    @if($dataTable->containsSearchable())
                        <div class="col-12 col-md-auto">
                            <form method="GET" action="/{{ request()->path() }}" class="w-100">
                                <div class="input-group mb-3">
                                    <input type="search" name="search" class="form-control" aria-describedby="data-table-search-submit" minlength="3" aria-label="@lang("messages.search")" placeholder="@lang("messages.search")" value="{{ $dataTable->search ?? "" }}">
                                    <button class="btn btn-outline-primary mb-0" type="submit" id="data-table-search-submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                    @if($dataTable->containsButtons())
                        <div class="col-auto">
                            @isset($dataTable->buttons)
                                @foreach($dataTable->buttons as $button)
                                    <a class="btn btn-primary" href="{{ $button["href"] }}">{{ $button["title"] }}</a>
                                @endforeach
                            @endisset
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
    <div class="card">
        <div class="table-responsive px-2">
            <table class="table">
                @if($dataTable->data->total() > 0)
                    <thead>
                        <tr>
                            @foreach($dataTable->columns as $column)
                                <th class="ps-2 text-uppercase text-secondary text-xs font-weight-bolder @if($column->orderable) sort @endif @if($dataTable->sortingAsc === $column->name) sorting-asc @elseif($dataTable->sortingDesc === $column->name) sorting-desc @endif" @if($column->orderable) onclick="window.location.href = '{{ $dataTable->getSortUrl($column) }}';" @endif>{{ $column->title }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @foreach($dataTable->data as $item)
                            <tr>
                                @foreach($dataTable->columns as $i => $column)
                                    @php $link = $column->type !== "actions" && isset($dataTable->linkGetter) ? ($dataTable->linkGetter)($item) : null; @endphp
                                    @php if (isset($dataTable->linkAuthorizationGetter) && !($dataTable->linkAuthorizationGetter)($item)) $link = null; @endphp
                                    <td class="@if(isset($link)) clickable @endif" @if(isset($link)) data-href="{{ $link }}" @endif>
                                        @switch($column->type)
                                            @case("text")
                                                {!! wordwrap(($column->valueGetter)($item), 75, "<br />") !!}
                                                @isset($column->data["subtitleGetter"])
                                                    <br/>
                                                    <span class="text-break">{{ ($column->data["subtitleGetter"])($item) }}</span>
                                                @endisset
                                                @break
                                            @case("boolean")
                                                @if(($column->valueGetter)($item) === true)
                                                    @lang("messages.yes")
                                                @else
                                                    @lang("messages.no")
                                                @endif
                                                @break
                                            @case("switch")
                                                <form @if($column->data["method"] === "GET") method="GET" @else method="POST" @endif action="{{ ($column->data["linkGetter"])($item) }}">
                                                    @if($action->method !== "GET")
                                                    @csrf
                                                    @method($column->data["method"])
                                                    @endif
                                                    <label class="custom-toggle">
                                                        <input type="checkbox" name="{{ $column->name }}" @if(($column->valueGetter)($item) === true) checked @endif @if(isset($column->data["authorization"]) && ($column->data["authorization"])($item) === true) onchange="this.form.submit()" @else disabled @endcan>
                                                        <span class="custom-toggle-slider rounded-circle"></span>
                                                    </label>
                                                </form>
                                                @break
                                            @case("component")
                                                @component($column->data["component"], $column->data["dataGetter"] ? ($column->data["dataGetter"])($item) : []))@endcomponent
                                                @break
                                            @case("actions")
                                                @php $actions = $column->getAvailableActions($item); @endphp
                                                @if($column->showCondensedActions($actions))
                                                    @php $randomId = rand(); @endphp
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-icon-only" type="button" id="dropdown-{{ $randomId }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v fa-lg"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdown-{{ $randomId }}">
                                                            @foreach($actions as $action)
                                                                <li>
                                                                    <form @if($action->method === "GET") method="GET" @else method="POST" @endif action="{{ ($action->linkGetter)($item) }}">
                                                                        @if($action->method !== "GET")
                                                                            @csrf
                                                                            @method($action->method)
                                                                        @endif
                                                                        <button class="dropdown-item @if($action->type === "destructive") text-danger @elseif($action->type === "confirmable") text-success @endif" @if($action->type === "confirmable" || $action->type === "destructive") type="button" onclick="confirmAction(this.form, '{{ $action->confirmationText }}')" @else type="submit" @endif>{{ $action->title }}</button>
                                                                    </form>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @else
                                                    @foreach($actions as $action)
                                                        @if($action->method !== "GET")
                                                            <form class="d-inline-block mr-2" @if($action->method === "GET") method="GET" @else method="POST"  @endif action="{{ ($action->linkGetter)($item) }}">
                                                               @if($action->method !== "GET")
                                                                @csrf
                                                                @method($action->method)
                                                                @endif
                                                                <button class="btn btn-sm @if($action->type === "destructive") btn-danger @elseif($action->type === "confirmable") btn-success @else btn-secondary @endif" @if($action->type === "confirmable" || $action->type === "destructive") type="button" onclick="confirmAction(this.form, '{{ $action->confirmationText }}')" @else type="submit" @endif>{{ $action->title }}</button>
                                                            </form>
                                                        @else
                                                            <a href="{{ ($action->linkGetter)($item) }}" class="btn btn-sm @if($action->type === "destructive") btn-danger @elseif($action->type === "confirmable") btn-success @else btn-secondary @endif">{{ $action->title }}</a>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                @break
                                        @endswitch
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody>
                    <tr>
                        <td class="align-middle text-center">
                            <span class="text-sm d-block p-2">@lang("messages.list_is_empty")</span>
                        </td>
                    </tr>
                    </tbody>
                @endif
            </table>
        </div>
    </div>
        <div class="card mt-2">
            <div class="row justify-content-between px-4 py-2">
                <div class="col-auto text-sm d-flex align-items-center">
                    @if(isset($dataTable->search) && mb_strlen($dataTable->search) > 0)
                        @lang("messages.total_filtered")
                    @else
                        @lang("messages.total")
                    @endif
                    {{ $dataTable->data->total() }}
                </div>
                <div class="col-auto">
                    {{ $dataTable->data->appends($dataTable->request->query())->links() }}
                </div>
            </div>
        </div>
    <style>
        th.sort {
            cursor: pointer;
            position: relative;
        }
        th.sort:before {
            position: absolute;
            content: "\2191";
            right: 1em;
            opacity: 0.5;
        }
        th.sort:after {
            position: absolute;
            content: "\2193";
            right: 0.5em;
            opacity: 0.5;
        }
        th.sort.sorting-asc:before {
            opacity: 1;
        }
        th.sort.sorting-desc:after {
            opacity: 1;
        }
    </style>
@endsection
