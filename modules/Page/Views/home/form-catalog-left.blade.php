<form action="" method="post" id="home-form">
    {{ csrf_field() }}
    <div class="form-group row">
        <div class="col-md-3">
            <label for="CATALOG_LEFT_IMAGE">{{ trans('Image') }}</label>
        </div>
        <div class="col-md-9">
            <div class="input-group">
                <input type="text" class="form-control" id="CATALOG_LEFT_IMAGE"
                       name="{{\Modules\Page\Models\Home::CATALOG_LEFT_IMAGE}}"
                       value="{{ $data[\Modules\Page\Models\Home::CATALOG_LEFT_IMAGE] ?? NULL }}">
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
            <label for="CATALOG_LEFT_TITLE">{{ trans('Catalog Left Title') }}</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" id="CATALOG_LEFT_TITLE"
                   name="{{\Modules\Page\Models\Home::CATALOG_LEFT_TITLE}}"
                   value="{{ $data[\Modules\Page\Models\Home::CATALOG_LEFT_TITLE] ?? NULL }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <label for="CATALOG_LEFT_CONTENT">{{ trans('Catalog Left Content') }}</label>
        </div>
        <div class="col-md-9">
            <textarea type="text" class="form-control" id="CATALOG_LEFT_CONTENT"
                      name="{{\Modules\Page\Models\Home::CATALOG_LEFT_CONTENT}}">{{ $data[\Modules\Page\Models\Home::CATALOG_LEFT_CONTENT] ?? NULL }}</textarea>
        </div>
    </div>
    <div class="input-group mt-5">
        <button type="submit" class="btn btn-info mr-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">{{ trans('Cancel') }}</button>
    </div>
</form>
