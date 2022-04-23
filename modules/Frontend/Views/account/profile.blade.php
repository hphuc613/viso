@extends('Base::frontend.master')
@php($auth = auth('web')->user())
@section('content')
    <section class="bg-ccdae0 py-4 py-md-5">
        <div class="container">
            <div class="row">
                <!-- account sidebar -->
                @include('Frontend::account.menu')
                <div class="col-md-9">
                    <div class="card rounded">
                        <div class="card-body p-4 p-sm-5 col-12 col-md-12 col-lg-10 col-xl-8 mx-auto">
                            <form action="{{ route('post.home.profile') }}" method="post" id="profile-form">
                                <div class="py-3 py-sm-4">
                                    <h3 class="">{{ trans('Account Information') }}</h3>
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="email" class="col-sm-4 col-form-label">{{ trans('Email') }}:</label>
                                        <div class="col-sm-8 d-flex align-items-center">
                                            <input type="text" readonly class="form-control-plaintext disabled me-1" id="email" name="email"
                                                   value="{{ $auth->email ?? NULL }}">
                                            <span class="badge text-success">{{ trans('Verified') }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="name" class="col-sm-4 col-form-label">{{ trans('Name' )}}:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $auth->name ?? NULL }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="phone" class="col-sm-4 col-form-label">{{ trans('Phone') }}:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control-plaintext disabled" id="phone" name="phone"
                                                   value="{{ $auth->phone ?? NULL }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-sm-4 col-form-label">{{ trans('Gender') }}:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="sex" type="radio" value="1" id="male"
                                                   @if($auth->sex !== 0) checked @endif>
                                            <label class="form-check-label" for="male">&nbsp; {{ trans('Male') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="sex" type="radio" id="female" value="0"
                                                   @if($auth->sex === 0) checked @endif>
                                            <label class="form-check-label" for="female">&nbsp; {{ trans('Female') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="pt-5">
                                        <h3 class="mb-4">{{ trans('Change Password') }}</h3>
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label">{{ trans('Password') }}:</label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label">{{ trans('Confirm password') }}:</label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" id="password_re_enter" name="password_re_enter">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 clearfix">
                                        <button type="submit" class="btn btn-primary py-0 mt-3 col-3 col-md-2 float-end">儲存</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    {!! JsValidator::formRequest('Modules\Frontend\Requests\MemberRequest', "#profile-form") !!}
@endpush
