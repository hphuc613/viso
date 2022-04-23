@extends("Base::backend.master")

@section("content")
    <div id="role-module">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans('Point Exchange') }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.setting.list') }}">{{ trans('Setting') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Point Exchange') }}</li>
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
                    <div class="col-md-1 d-flex align-items-center">
                        1$ =
                    </div>
                    <div class="col-md-2">
                        <div class="input-group">
                            <input type="text" name="point" class="form-control rounded-0" value="{{ $data->value ?? 0 }}">
                            <span class="input-group-text rounded-0" style="background-color: #e6e2bb5e">{{ trans('Points') }}</span>
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
