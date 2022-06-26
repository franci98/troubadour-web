@extends('base.app')

@section('content')
    <section class="min-vh-100 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{ asset('img/login-banner.jpg') }}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <div class="card z-index-0">
                            <div class="card-header text-center pt-4">
                                <h5>@lang('messages.classroom_select_title')</h5>
                            </div>
                            <div class="card-body">
                                @foreach($classrooms as $classroom)
                                    <a href="{{ route('classrooms.select', ['classroom' => $classroom->id]) }}" class="btn btn-block btn-primary">
                                        {{ $classroom->name }}
                                    </a>
                                @endforeach
                                <form  action="{{ route('classrooms.store') }}" method="POST" class="mt-2">
                                    @csrf
                                    <input class="form-control mb-3" type="text" name="name">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn btn-block btn-success">@lang('messages.classroom_create_button')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
