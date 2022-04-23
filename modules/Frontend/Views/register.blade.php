@extends('Base::frontend.master')

@section('content')
    <div class="container pt-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{trans('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('Create new account')}}</li>
            </ol>
        </nav>
        <section id="register" class="register">
            <h1 class="title-register">{{trans('Create new account')}}</h1>
            <hr class="mb-3">
            <form class="form-register" action="" method="post">
                @csrf
                <div class="form-group">
                    <label class="label-input-login" for="name">
                        {{trans('Name')}}
                    </label>
                    <input type="text" id="name" name="name" placeholder="{{trans('Name')}}"
                           class="form-control input-login">
                </div>
                <div class="form-group">
                    <label class="label-input-login" for="last_name">
                        {{trans('Last name')}}
                    </label>
                    <input type="text" id="last_name" name="last_name" placeholder="{{trans('Last name')}}"
                           class="form-control input-login">
                </div>
                <div class="form-group">
                    <label class="label-input-login" for="email">
                        {{trans('Email address')}} <span> *</span>
                    </label>
                    <input type="email" id="email" name="email" placeholder="{{trans('Email address')}}"
                           class="form-control input-login">
                </div>
                <div class="form-group">
                    <label class="label-input-login" for="password">
                        {{trans('Password')}} <span> *</span>
                    </label>
                    <input type="password" id="password" name="password" placeholder="{{trans('Password')}}"
                           class="form-control input-login">
                </div>
                <div class="form-group">
                    <label class="label-input-login" for="password_re_enter">
                        {{trans('Confirm Password')}} <span> *</span>
                    </label>
                    <input type="password" id="password_re_enter" name="password_re_enter"
                           placeholder="{{trans('Confirm Password')}}"
                           class="form-control input-login">
                </div>
                <button type="submit" class="btn btn-main btn-register">{{trans('Create new account')}}</button>
            </form>
        </section>
    </div>
@endsection
@push('js')
    {!! JsValidator::formRequest('Modules\Auth\Requests\AuthMemberRequest') !!}
@endpush
