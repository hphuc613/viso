<form action="" method="post" id="home-form">
    {{ csrf_field() }}
    <div class="form-group row">
        <div class="col-md-3">
            <label for="OUR_STORY_TITLE">{{ trans('Story Title') }}</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control" id="OUR_STORY_TITLE"
                   name="{{\Modules\Page\Models\Home::OUR_STORY_TITLE}}"
                   value="{{ $data[\Modules\Page\Models\Home::OUR_STORY_TITLE] ?? old(\Modules\Page\Models\Home::OUR_STORY_TITLE) }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <label for="OUR_STORY_CONTENT">{{ trans('Story Content') }}</label>
        </div>
        <div class="col-md-9">
            <textarea style="height: 300px" type="text" class="form-control" id="OUR_STORY_CONTENT"
                      name="{{\Modules\Page\Models\Home::OUR_STORY_CONTENT}}">
                {{ $data[\Modules\Page\Models\Home::OUR_STORY_CONTENT]}}
            </textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <label for="OUR_STORY_IMAGE">{{ trans('Story Image') }}</label>
        </div>
        <div class="col-md-9">
            <div class="input-group">
                <input type="text" class="form-control" id="OUR_STORY_IMAGE"
                       name="{{\Modules\Page\Models\Home::OUR_STORY_IMAGE}}"
                       value="{{ $data[\Modules\Page\Models\Home::OUR_STORY_IMAGE] ?? NULL }}">
                <div class="input-group-prepend">
                    <button class="btn btn-primary btn-elfinder" type="button">
                        {{ trans('Open File Manager') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="input-group mt-5">
        <button type="submit" class="btn btn-info mr-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">{{ trans('Cancel') }}</button>
    </div>
</form>
