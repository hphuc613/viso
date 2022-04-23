<form action="" method="post" id="attribute-option-form">
    {{ csrf_field() }}
    <input type="hidden" name="attribute_id" value="{{ $attribute->id ?? $data->attribute_id }}">
    <div class="form-group row">
        <div class="col-md-4">
            <label for="name">{{ trans('Name') }}</label>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control" id="name" name="name" value="{{ $data->name ?? old('name') }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <label for="description">{{ trans('Description') }}</label>
        </div>
        <div class="col-md-8">
            <textarea name="description" id="description" class="form-control"
                      rows="5">{{ $data->description ?? NULL }}</textarea>
        </div>
    </div>
    <div class="input-group mt-5">
        <button type="submit" class="btn btn-info mr-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">{{ trans('Cancel') }}</button>
    </div>
</form>
{!! JsValidator::formRequest('Modules\Product\Requests\AttributeOptionRequest','#attribute-option-form') !!}
