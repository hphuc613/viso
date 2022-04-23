<form action="" method="post" id="home-form">
    {{ csrf_field() }}
    <div class="form-group row">
        <div class="col-md-3">
            <label for="BANNER">{{ trans('Banner Image') }}</label>
        </div>
        <div class="col-md-9">
            <div class="input-group">
                <input type="text" class="form-control" id="BANNER" name="{{\Modules\Page\Models\Home::BANNER}}"
                       value="{{ $data[\Modules\Page\Models\Home::BANNER] ?? NULL }}">
                <div class="input-group-prepend">
                    <button class="btn btn-primary btn-elfinder" type="button">
                        {{ trans('Open File Manager') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <label for="BANNER_TITLE">{{ trans('Banner Title') }}</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" id="BANNER_TITLE"
                   name="{{\Modules\Page\Models\Home::BANNER_TITLE}}"
                   value="{{ $data[\Modules\Page\Models\Home::BANNER_TITLE] ?? old(\Modules\Page\Models\Home::BANNER_TITLE) }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <label for="BANNER_LINK">{{ trans('Banner Link') }}</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" id="BANNER_LINK" name="{{\Modules\Page\Models\Home::BANNER_LINK}}"
                   value="{{ $data[\Modules\Page\Models\Home::BANNER_LINK] ?? old(\Modules\Page\Models\Home::BANNER_LINK) }}">
        </div>
    </div>
    <div class="input-group mt-5">
        <button type="submit" class="btn btn-info mr-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">{{ trans('Cancel') }}</button>
    </div>
</form>
