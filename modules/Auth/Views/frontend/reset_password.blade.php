@extends('Base::frontend.master')

@section('content')
    <section class="bg-ccdae0 py-4 py-md-5">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-9 col-lg-7 col-xl-6">
                    <div class="card rounded">
                        <div class="card-body p-4 p-sm-5">
                            <form action="{{ route('post.home.resetPassword') }}" method="post" id="reset-password-form">
                                @csrf
                                <input type="hidden" name="reset_code" value="{{ request()->reset_code ?? NULL }}">
                                <h4 class="text-center border-bottom border-3 border-primary pb-3 mb-5"><b>{{ trans('Reset Password') }}</b></h4>
                                <div class="form-group mb-4">
                                    <label class="form-label" for="password">{{ trans('New Password') }}</label>
                                    <input type="password" id="password" name="password" class="form-control form-control-lg"/>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label" for="confirmPassword">{{ trans('Confirm Password') }}</label>
                                    <input type="password" name="password_re_enter" id="confirmPassword" class="form-control form-control-lg">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary col-sm-8">{{ trans('Confirm') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- reset password modal -->
    <div class="modal fade" id="reset-modal" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center my-5">
                    <div class="mb-5">{{ trans('Password reset successfully') }}</div>
                    <div class="text-muted">
                        <small>{{ trans('The system will jump to') }} <a class="globe-text-link" href="{{ route('get.home.index') }}">{{ trans('the home page') }}</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    {!! JsValidator::formRequest('Modules\Auth\Requests\MemberResetPasswordRequest','#reset-password-form') !!}
    <script>
        $(document).ready(function () {
            $('.modal').on('hidden.bs.modal', function () {
                window.location.href="{{ route('get.home.index') }}";
            });

            $(document).on('submit', '#reset-password-form', function (e) {
                e.preventDefault();
                const url = $(this).attr('action');
                const data = $(this).serialize();
                $.ajax({
                   url: url,
                   data: data,
                   method: 'post'
                }).done(function (response) {
                    if (response.status === 200){
                        $('#reset-modal').modal('show');
                    }
                });
            })
        });
    </script>
@endpush
