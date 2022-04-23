@extends("Base::backend.master")
@section("content")
    <div id="role-module">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans('Payment Config') }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.setting.list') }}">{{ trans('Setting') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('Payment Config') }}</li>
                    </ol>
                </div>
            </div>
        </div>

        <div id="head-page" class="mb-3 d-flex justify-content-end group-btn">
            <a href="{{ route('get.setting.list') }}" class="btn btn-info">{{ trans('Go Back') }}</a>
        </div>
    </div>

    <div id="setting">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ trans('Stripe Config') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route("post.setting.stripeConfig") }}" method="post" id="stripe-form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="STRIPE_PUBLISHABLE_KEY">{{ trans('Publishable Key') }}</label>
                                <input type="text" class="form-control" id="STRIPE_PUBLISHABLE_KEY"
                                       name="{{ \Modules\Setting\Models\PaymentConfig::STRIPE_PUBLISHABLE_KEY }}"
                                       value="{{ $config[\Modules\Setting\Models\PaymentConfig::STRIPE_PUBLISHABLE_KEY] ?? NULL}}">
                            </div>
                            <div class="form-group">
                                <label for="STRIPE_SECRET_KEY">{{ trans('Secret Key') }}</label>
                                <input type="text" class="form-control" id="STRIPE_SECRET_KEY"
                                       name="{{ \Modules\Setting\Models\PaymentConfig::STRIPE_SECRET_KEY }}"
                                       value="{{ $config[\Modules\Setting\Models\PaymentConfig::STRIPE_SECRET_KEY]  ?? NULL }}">
                            </div>
                            <div class="input-group mt-5 d-flex justify-content-between">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-info mr-2">{{ trans('Save') }}</button>
                                    <button type="reset" class="btn btn-default">{{ trans('Reset') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ trans('Paypal Config') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route("post.setting.paypalConfig") }}" method="post" id="paypal-form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="environment">ENVIRONMENT</label>
                                <select class="form-control select2 w-100" id="environment"
                                        name="{{ \Modules\Setting\Models\PaymentConfig::PAYPAL_ENVIRONMENT }}">
                                    <option @if($config[\Modules\Setting\Models\PaymentConfig::PAYPAL_ENVIRONMENT] == 'sandbox') selected @endif value="sandbox">Sandbox</option>
                                    <option @if($config[\Modules\Setting\Models\PaymentConfig::PAYPAL_ENVIRONMENT] == 'production') selected @endif value="production">Production</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="PAYPAL_CLIENT_ID">
                                    Client ID
                                </label>
                                <input type="text" class="form-control" id="PAYPAL_CLIENT_ID"
                                       name="{{ \Modules\Setting\Models\PaymentConfig::PAYPAL_CLIENT_ID }}"
                                       value="{{ $config[\Modules\Setting\Models\PaymentConfig::PAYPAL_CLIENT_ID] ?? NULL}}">
                            </div>
                            <div class="form-group">
                                <label for="PAYPAL_SECRET_KEY">Secret Key</label>
                                <input type="text" class="form-control" id="PAYPAL_SECRET_KEY"
                                       name="{{ \Modules\Setting\Models\PaymentConfig::PAYPAL_SECRET_KEY }}"
                                       value="{{ $config[\Modules\Setting\Models\PaymentConfig::PAYPAL_SECRET_KEY]  ?? NULL }}">
                            </div>
                            <div class="input-group mt-5 d-flex justify-content-between">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-info mr-2">{{ trans('Save') }}</button>
                                    <button type="reset" class="btn btn-default">{{ trans('Reset') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
