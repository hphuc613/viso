@extends('Base::frontend.master')

@section('content')
    <section class="bg-ccdae0 py-4 py-md-5">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card rounded">
                        <div class="card-body p-4 p-sm-5">
                            <ul id="login-tab" class="nav nav-tabs" role="tablist">
                                <li class="nav-item col-6" role="presentation">
                                    <a href="{{ route('get.home.login') }}"
                                       class="text-center nav-link col-12 tab-auth active" data-bs-toggle="tab"
                                       role="tab">
                                        {{ trans('Login') }}
                                    </a>
                                </li>
                                <li class="nav-item col-6" role="presentation">
                                    <a href="{{ route('get.home.register') }}"
                                       class="text-center nav-link tab-auth col-12" data-bs-toggle="tab" role="tab">
                                        {{ trans('Register') }}
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show py-3 py-sm-4 active" id="tab-form" role="tabpanel"
                                     aria-labelledby="login-tab">
                                    @include('Auth::frontend._form_login')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(document).find('#reg-modal').modal("show");
            $(document).on('click', '.tab-auth', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                getForm(url)
            });

            function getForm(url) {
                $.ajax({
                    url: url,
                    method: 'get'
                }).done(function (response) {
                    $(document).find('#tab-form').html(response);
                });
            }
        });
    </script>
@endpush
