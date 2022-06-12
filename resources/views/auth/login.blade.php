@extends('base.app')

@section('content')
    <section class="min-vh-100 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{ asset('img/login-banner.jpg') }}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">@lang('messages.login_welcome_title')</h1>
                        <p class="text-lead text-white">@lang('messages.login_welcome_subtitle')</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 mb-6">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>@lang('messages.login_card_title')</h5>
                        </div>
                        <div class="card-body">
                            <form role="form text-left" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="@lang('messages.login_input_email_label')" aria-label="@lang('messages.login_input_email_label')" aria-describedby="email-addon">
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="@lang('messages.login_input_password_label')" aria-label="@lang('messages.login_input_password_label')" aria-describedby="password-addon">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">@lang('messages.login_input_submit_label')</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">
                                    @lang('messages.login_to_register', [route('register.show')])
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
