@extends("Base::backend.master")

@section("content")
    <div id="role-module">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans('Website Config') }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.setting.list') }}">{{ trans('Setting') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('Website Config') }}</li>
                    </ol>
                </div>
            </div>
        </div>

        <div id="head-page" class="mb-3 d-flex justify-content-end group-btn">
            <a href="{{ route('get.setting.list') }}" class="btn btn-info">{{ trans('Go Back') }}</a>
        </div>
    </div>

    <div id="user" class="card">
        <div class="card-body">
            <form action="" method="post" id="role-form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="LOGO">{{ trans('Logo Home') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="LOGO"
                                       name="{{ \Modules\Setting\Models\Website::LOGO }}"
                                       value="{{ $website_config[\Modules\Setting\Models\Website::LOGO] ?? null}}">
                                <div class="input-group-prepend">
                                    <button class="btn btn-main-color btn-elfinder" type="button">
                                        {{ trans('Open File Manager') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="LOGO_NORMAL">{{ trans('Logo Normal') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="LOGO_NORMAL"
                                       name="{{ \Modules\Setting\Models\Website::LOGO_NORMAL }}"
                                       value="{{ $website_config[\Modules\Setting\Models\Website::LOGO_NORMAL] ?? null}}">
                                <div class="input-group-prepend">
                                    <button class="btn btn-main-color btn-elfinder" type="button">
                                        {{ trans('Open File Manager') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="LOGO_PAYMENT_PAGE">{{ trans('Logo Payment Page') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="LOGO_PAYMENT_PAGE"
                                       name="{{ \Modules\Setting\Models\Website::LOGO_PAYMENT_PAGE }}"
                                       value="{{ $website_config[\Modules\Setting\Models\Website::LOGO_PAYMENT_PAGE] ?? null}}">
                                <div class="input-group-prepend">
                                    <button class="btn btn-main-color btn-elfinder" type="button">
                                        {{ trans('Open File Manager') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="FAVICON">{{ trans('Favicon') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="FAVICON"
                                       name="{{ \Modules\Setting\Models\Website::FAVICON }}"
                                       value="{{ $website_config[\Modules\Setting\Models\Website::FAVICON] ?? null}}">
                                <div class="input-group-prepend">
                                    <button class="btn btn-main-color btn-elfinder" id="elfinder-popup"
                                            type="button">
                                        {{ trans('Open File Manager') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="WEBSITE_NAME">{{ trans('Website Name') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="WEBSITE_NAME"
                                       name="{{ \Modules\Setting\Models\Website::WEBSITE_NAME }}"
                                       value="{{ $website_config[\Modules\Setting\Models\Website::WEBSITE_NAME] ?? null}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="NAME_INVOICE">{{ trans('Name On Invoice') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="NAME_INVOICE"
                                       name="{{ \Modules\Setting\Models\Website::NAME_INVOICE }}"
                                       value="{{ $website_config[\Modules\Setting\Models\Website::NAME_INVOICE] ?? null}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="PHONE_NUMBER">{{ trans('Phone Number') }}</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="PHONE_NUMBER"
                                       name="{{ \Modules\Setting\Models\Website::PHONE_NUMBER }}"
                                       value="{{ $website_config[\Modules\Setting\Models\Website::PHONE_NUMBER] ?? null}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="EMAIL">{{ trans('Email') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="EMAIL"
                                       name="{{ \Modules\Setting\Models\Website::EMAIL }}"
                                       value="{{ $website_config[\Modules\Setting\Models\Website::EMAIL] ?? null}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="FACEBOOK">{{ trans('Facebook') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="FACEBOOK"
                                       name="{{ \Modules\Setting\Models\Website::FACEBOOK }}"
                                       value="{{ $website_config[\Modules\Setting\Models\Website::FACEBOOK] ?? null}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="INSTAGRAM">{{ trans('Instagram') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="INSTAGRAM"
                                       name="{{ \Modules\Setting\Models\Website::INSTAGRAM }}"
                                       value="{{ $website_config[\Modules\Setting\Models\Website::INSTAGRAM] ?? null}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ADDRESS">{{ trans('Address') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="ADDRESS"
                                       name="{{ \Modules\Setting\Models\Website::ADDRESS }}"
                                       value="{{ $website_config[\Modules\Setting\Models\Website::ADDRESS] ?? null}}">
                            </div>
                        </div>
                    </div>
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
@endsection
