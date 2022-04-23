<form action="" method="post" id="product-form" enctype=multipart/form-data>
    <div class="input-group mb-5">
        <button type="submit" class="btn btn-info mr-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">{{ trans('Cancel') }}</button>
    </div>
    @csrf
    @php($prompt = ['' => trans('Select')])
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="sku" class="title">{{ trans('SKU') }}</label>
                <input type="text" class="form-control" id="sku" name="sku"
                       value="{{ $data->sku ?? null }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="store" class="title">{{ trans('Store') }}</label>
                {!! Form::select('store_id', $prompt + $stores, $data->store_id ?? request()->store_id ?? 1 ?? NULL, [
                    'id' => 'store',
                    'class' => 'select2 form-control']) !!}
            </div>
        </div>
        <div class="col-md-12"></div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="title">{{ trans('Name') }}</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ $data->name ?? null }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="capacity" class="title">{{ trans('Capacity') }}</label>
                <input type="text" name="capacity" id="capacity" class="form-control"
                       value="{{ $data->capacity ?? NULL }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="price" class="title">{{ trans('Price') }}</label>
                <input type="number" name="price" class="form-control" id="price" value="{{ $data->price ?? NULL }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="description" class="title">{{ trans('Description') }}</label>
                <input type="text" name="description" id="description" class="form-control"
                       value="{{ $data->description ?? NULL }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="stock-in" class="title">{{ trans('Stock In') }}</label>
                <input type="number" id="stock-in" name="stock_in" class="form-control"
                       value="{{ $data->stock_in ?? 0 }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="status" class="title">{{ trans('Status') }}</label>
                {!! Form::select('status', $prompt + $statuses, $data->status ?? NULL, [
                    'id' => 'status',
                    'class' => 'select2 form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-8 col-md-10 form-group">
                            <label for="cate_id" class="title">{{ trans('Category') }}</label>
                            {!! Form::select('cate_id', $prompt + $categories, $data->cate_id ?? NULL, [
                                'id' => 'cate_id',
                                'class' => 'select2 form-control']) !!}
                        </div>
                        <div class="col-4 col-md-2 form-group d-flex align-items-end">
                            <a href="{{ route('get.product_category.create_realtime') }}" class="btn btn-primary"
                               data-toggle="modal" data-target="#form-modal"
                               data-title="{{ trans("Create Product Category") }}">
                                <i class="fa fa-plus"></i>&nbsp; {{ trans("Add New") }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-8 col-md-10 form-group">
                            <label for="cate_id" class="title">{{ trans('Brand') }}</label>
                            {!! Form::select('brand_id', $prompt + $brands, $data->brand_id ?? NULL, [
                                'id' => 'brand_id',
                                'class' => 'select2 form-control']) !!}
                        </div>
                        <div class="col-4 col-md-2 form-group d-flex align-items-end">
                            <a href="{{ route('get.product_brand.create_realtime') }}" class="btn btn-primary"
                               data-toggle="modal" data-target="#form-modal"
                               data-title="{{ trans("Create Product Brand") }}">
                                <i class="fa fa-plus"></i>&nbsp; {{ trans("Add New") }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="image" class="title">{{ trans('Image') }}</label>
                <input type="file" id="image" class="dropify" name="image" value="{{ $data->image ?? null }}"
                       data-default-file="{{ asset($data->image ?? null) }}"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="ingredient" class="title">{{ trans('Ingredient') }}</label>
                <textarea name="ingredient" id="ingredient" class="form-control"
                          rows="6">{{ $data->ingredient ?? NULL }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="shipping_info" class="title">{{ trans('Shipping Information') }}</label>
                <textarea name="shipping_info" id="shipping_info" class="form-control"
                          rows="6">{{ $data->shipping_info ?? NULL }}</textarea>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            <h4 class="title mb-3">{{ trans('Add Attribute') }}</h4>
            <div class="add-attribute-option-group">
                @include('Product::backend.product._add_attribute')
            </div>
        </div>
    </div>
    <div class="input-group mt-5">
        <button type="submit" class="btn btn-info mr-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">{{ trans('Cancel') }}</button>
    </div>
</form>
{!! getModal(["class" => "modal-ajax"]) !!}
@push('js')
    {!! JsValidator::formRequest('Modules\Product\Requests\ProductRequest','#product-form') !!}

    <script !src="">
        $(document).ready(function () {
            $('.dropify').dropify();
            $('.tag-select2').select2({
                tags: true
            });

            /** Hot add category */
            hotAddParent('#product-category-form', '#cate_id');

            /** Hot add brand */
            hotAddParent('#product-brand-form', '#brand_id');

            /** Hot add parent function */
            function hotAddParent(formId, dropdownId) {
                $(document).on('submit', formId, function (e) {
                    e.preventDefault();
                    let dropdown = $(document).find(dropdownId);
                    let modal = $(this).parents('.modal');
                    let url = $(this).attr('action');
                    let data = $(this).serialize();
                    $.ajax({
                        url: url,
                        data: data,
                        method: 'post'
                    }).done(function (response) {
                        modal.modal('hide');
                        if (response.status === 200) {
                            dropdown.find("option").remove();
                            dropdown.select2({
                                data: jQuery.parseJSON(response.data)
                            });

                            $.toast({
                                heading: "Success",
                                text: response.msg,
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 10000,
                                stack: 6
                            });
                        } else {
                            $.toast({
                                heading: "Fail",
                                text: response.msg,
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'error',
                                hideAfter: 10000,
                                stack: 6
                            });
                        }
                    })
                });
            }
        });
    </script>
@endpush
