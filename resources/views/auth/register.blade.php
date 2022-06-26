@extends('base.app')

@section('content')
    <section class="min-vh-100 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{ asset('img/registration-banner.jpg') }}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">@lang('messages.register_welcome_title')</h1>
                        <p class="text-lead text-white">@lang('messages.register_welcome_subtitle')</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 mb-6">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>@lang('messages.register_card_title')</h5>
                        </div>
                        <div class="card-body">
                            <form role="form text-left" action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="@lang('messages.register_input_name_label')" aria-label="@lang('messages.register_input_name_label')" aria-describedby="email-addon">
                                    @error('name')
                                    <div class="alert alert-danger text-white mt-2 mb-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="input-school_id">@lang('messages.register_input_school_label')</label>
                                    <select class="form-control" name="school_id" id="input-school_id">
                                        @foreach($schools as $school)
                                            <option value="{{$school->id}}">{{ $school->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('school_id')
                                    <div class="alert alert-danger text-white mt-2 mb-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="@lang('messages.register_input_email_label')" aria-label="@lang('messages.register_input_email_label')" aria-describedby="email-addon">
                                    @error('email')
                                    <div class="alert alert-danger text-white mt-2 mb-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="@lang('messages.register_input_password_label')" aria-label="@lang('messages.register_input_password_label')" aria-describedby="password-addon">
                                    @error('password')
                                    <div class="alert alert-danger text-white mt-2 mb-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('messages.register_input_password_confirmation_label')" aria-label="@lang('messages.register_input_password_confirmation_label')" aria-describedby="password_confirmation-addon">
                                </div>
                                <div class="form-check form-check-info text-left">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        @lang('messages.register_terms_consent', [route('terms')])
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">@lang('messages.register_input_submit_label')</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">
                                    @lang('messages.register_to_login', [route('login.show')])
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
