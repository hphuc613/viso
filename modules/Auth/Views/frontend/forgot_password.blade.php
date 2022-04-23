@extends('Base::frontend.master')

@section('content')
    <section class="bg-ccdae0 py-4 py-md-5">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-9 col-lg-7 col-xl-6">
                    <div class="card rounded">
                        <div class="card-body p-4 p-sm-5">
                            <form action="" method="post">
                                @csrf
                                <h4 class="text-center border-bottom border-3 border-primary pb-3 mb-4">
                                    {{ trans('Forgot password') }}
                                </h4>
                                @if(session('success'))
                                    <div class="mb-3">
                                        <span class="text-success"><i class="fas fa-check-circle"></i> Send email successfully. Please check your email</span>
                                    </div>
                                @endif
                                <div class="form-group mb-5">
                                    <label class="form-label mb-3" for="email">
                                        {{ trans('Please enter your account email address') }}
                                    </label>
                                    <input type="email" id="email" name="email" required class="form-control form-control-lg mb-3"/>
                                    <span><small>{{ trans('A confirmation message will be sent to your email, please check your email and click the link to continue resetting your password.') }}</small></span>
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
@endsection
