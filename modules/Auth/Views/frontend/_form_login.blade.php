<form method="POST" action="{{ route('post.home.login') }}">
    @csrf
    <div class="form-group mb-4">
        <label class="form-label" for="email">{{ trans('Email') }}</label>
        <input type="email" id="email" name="email" required class="form-control form-control-lg" value="{{ session('login.email') }}">
    </div>

    <div class="form-group mb-4 mb-sm-4 mb-md-5">
        <label class="form-label" for="password">{{ trans('Password') }}</label>
        <input type="password" id="password" name="password" required class="form-control form-control-lg" value="{{ old('password') }}">
    </div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary btn-block text-white col-12 col-sm-8">{{ trans('Login') }}</button>
    </div>

    <div class="text-center text-muted mt-4 mb-1">
        <a href="{{ route('get.home.forgotPassword') }}" class="fw-bold globe-text-link">{{ trans('Forgot password') }}</a>
    </div>
    <div class="text-center text-muted mb-0">
        {{ trans("Don't have an account?") }}
        <a href="{{ route('get.home.register') }}" class="fw-bold globe-text-link tab-auth">{{ trans('Register') }}</a>
    </div>
</form>
