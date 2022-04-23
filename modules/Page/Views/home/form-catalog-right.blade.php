<form action="" method="post" id="home-form">
    {{ csrf_field() }}
    <div class="form-group row">
        <div class="col-md-3">
            <label for="CATALOG_RIGHT_TITLE">{{ trans('Catalog Right Title') }}</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" id="CATALOG_RIGHT_TITLE"
                   name="{{\Modules\Page\Models\Home::CATALOG_RIGHT_TITLE}}"
                   value="{{ $data[\Modules\Page\Models\Home::CATALOG_RIGHT_TITLE] ?? NULL }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <label for="CATALOG_RIGHT_CONTENT">{{ trans('Catalog Right Content') }}</label>
        </div>
        <div class="col-md-9">
            <textarea type="text" class="form-control" id="CATALOG_RIGHT_CONTENT"
                      name="{{\Modules\Page\Models\Home::CATALOG_RIGHT_CONTENT}}">{{ $data[\Modules\Page\Models\Home::CATALOG_RIGHT_CONTENT] ?? NULL }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <label for="CATALOG_RIGHT_IMG_1">{{ trans('Image 1') }}</label>
        </div>
        <div class="col-md-9">
            <div class="input-group">
                <input type="text" class="form-control" id="CATALOG_RIGHT_IMG_1"
                       name="{{\Modules\Page\Models\Home::CATALOG_RIGHT_IMG_1}}"
                       value="{{ $data[\Modules\Page\Models\Home::CATALOG_RIGHT_IMG_1] ?? NULL }}">
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
            <label for="CATALOG_RIGHT_CONTENT_1">{{ trans('Description 1') }}</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" id="CATALOG_RIGHT_CONTENT_1"
                   name="{{\Modules\Page\Models\Home::CATALOG_RIGHT_CONTENT_1}}"
                   value="{{ $data[\Modules\Page\Models\Home::CATALOG_RIGHT_CONTENT_1] ?? NULL }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <label for="CATALOG_RIGHT_IMG_2">{{ trans('Image 2') }}</label>
        </div>
        <div class="col-md-9">
            <div class="input-group">
                <input type="text" class="form-control" id="CATALOG_RIGHT_IMG_2"
                       name="{{\Modules\Page\Models\Home::CATALOG_RIGHT_IMG_2}}"
                       value="{{ $data[\Modules\Page\Models\Home::CATALOG_RIGHT_IMG_2] ?? NULL }}">
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
            <label for="CATALOG_RIGHT_CONTENT_2">{{ trans('Description 2') }}</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" id="CATALOG_RIGHT_CONTENT_2"
                   name="{{\Modules\Page\Models\Home::CATALOG_RIGHT_CONTENT_2}}"
                   value="{{ $data[\Modules\Page\Models\Home::CATALOG_RIGHT_CONTENT_2] ?? NULL }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <label for="CATALOG_RIGHT_IMG_3">{{ trans('Image 3') }}</label>
        </div>
        <div class="col-md-9">
            <div class="input-group">
                <input type="text" class="form-control" id="CATALOG_RIGHT_IMG_3"
                       name="{{\Modules\Page\Models\Home::CATALOG_RIGHT_IMG_3}}"
                       value="{{ $data[\Modules\Page\Models\Home::CATALOG_RIGHT_IMG_3] ?? NULL }}">
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
            <label for="CATALOG_RIGHT_CONTENT_3">{{ trans('Description 3') }}</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" id="CATALOG_RIGHT_CONTENT_3"
                   name="{{\Modules\Page\Models\Home::CATALOG_RIGHT_CONTENT_3}}"
                   value="{{ $data[\Modules\Page\Models\Home::CATALOG_RIGHT_CONTENT_3] ?? NULL }}">
        </div>
    </div>
    <div class="input-group mt-5">
        <button type="submit" class="btn btn-info mr-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">{{ trans('Cancel') }}</button>
    </div>
</form>
