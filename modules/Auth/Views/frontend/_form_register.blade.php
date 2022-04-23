<form action="{{ route('post.home.register') }}" method="post" id="register-form">
    @csrf
    <div class="form-group mb-4">
        <label class="form-label" for="name">{{ trans('Name') }}</label>
        <input type="text" id="name" name="name" class="form-control form-control-lg">
    </div>
    <div class="form-group mb-4">
        <label class="form-label" for="email">{{ trans('Email') }}</label>
        <input type="email" name="email" class="form-control form-control-lg">
    </div>
    <div class="form-group mb-4">
        <label class="form-label" for="tel">{{ trans('Phone Number') }}</label>
        <input type="tel" id="tel" name="phone" class="form-control form-control-lg">
    </div>
    <div class="form-group mb-4">
        <label class="form-label" for="password">{{ trans('Password') }}</label>
        <input type="password" name="password" class="form-control form-control-lg">
    </div>
    <div class="form-group mb-4">
        <label class="form-label" for="confirmPassword">{{ trans('Confirm Password') }}</label>
        <input type="password" name="password_re_enter" id="confirmPassword" class="form-control form-control-lg">
    </div>
    {{--<div class="form-check d-flex justify-content-start mb-2">
        <input class="form-check-input me-2" type="checkbox" value="" id="subscription">
        <label class="form-check-label" for="subscription">
            {{ trans('Subscribe to emails to receive the latest news and offers') }}
        </label>
    </div>--}}
    <div class="input-group">
        <div class="form-check d-flex justify-content-start">
            <input class="form-check-input me-2" type="checkbox" id="tnc" name="agree">
            <label class="form-check-label" for="tnc">
                {{ trans('I agree to the website terms of service and privacy policy') }}
            </label>
        </div>
    </div>
    <div class="d-flex justify-content-center py-5">
        <button type="submit" class="btn btn-primary col-12 col-sm-8" id="register-btn">
            {{ trans('Register') }}
        </button>
    </div>
    <div class="text-center">
        <span>{{ trans('Already have an account?') }}</span>
        <a href="{{ route('get.home.login') }}" class="fw-bold globe-text-link tab-auth">{{ trans('Login') }}</a>
    </div>
</form>

{{-- Success --}}
<div class="modal fade show" id="reg-modal" tabindex="-1" aria-labelledby="regModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0">
                <a href="javascript:" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body text-center my-5">
                <div>{{ trans('Thank you very much for your registration') }}</div>
                <div>{{ trans('Successfully registered member') }}</div>
                <br>
                <div>{{ trans('The system has sent a confirmation email to your email address') }}</div>
                <div class="mb-5">{{ trans('Please check your email and confirm membership account') }}</div>
                <div class="mb-4">
                    <small>
                        {{ trans('The system will automatically jump to') }}
                        <a class="globe-text-link" href="{{ route('get.home.index') }}">{{ trans('the home page') }}</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

{!! JsValidator::formRequest('Modules\Auth\Requests\AuthMemberRequest','#register-form') !!}
<script !src="">
    $(document).ready(function () {
        $(document).on('submit', '#register-form', function (e) {
            e.preventDefault();
            const url = $(this).attr('action');
            const data = $(this).serialize();

            $(document).find('#register-btn').html('<span class="spinner-border text-light" role="status">\n' +
                '                <span class="visually-hidden">' + '{{ trans('Loading...') }}' + '</span>\n' +
                '            </span>');
            $.ajax({
                url: url,
                method: "post",
                data: data,
            }).done(function (response) {
                if (response.status === 200) {
                    $(document).find('#register-btn').html('{{ trans('Done') }}');
                    $(document).find('#reg-modal').modal("show");
                } else {
                    new bs5.Toast({
                        className: 'border-0 bg-danger text-white',
                        header: `
                                <i style="font-size: 24px"  class="text-danger far fa-times-circle me-2"></i>
                                <h6 class="mb-0">Fail!</h6>
                                `,
                        body: response.msg,
                    }).show()
                }
            })
        });

        $('.modal').on('hidden.bs.modal', function () {
            window.location.href = "{{ route('get.home.index') }}";
        });
    })
</script>
