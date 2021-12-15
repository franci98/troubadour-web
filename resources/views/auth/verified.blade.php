@extends('base.app')

@section('content')
    <div class="row mt-4">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>@lang('messages.email_verified')</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
