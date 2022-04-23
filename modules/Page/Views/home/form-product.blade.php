<form action="" method="post" id="product-form">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="product-form">
                <h3>{{trans('Product')}} 1</h3>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="image">{{ trans('Image') }}</label>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="text" class="form-control" id="image" name="product[product1][image]"
                                   value="{{$product['product1']['image'] ?? ''}}">
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
                        <label for="title">{{ trans('Title') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="title" name="product[product1][title]"
                               value="{{$product['product1']['title'] ?? ''}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="link">{{ trans('Link') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="link" name="product[product1][link]"
                               value="{{$product['product1']['link'] ?? ''}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="product-form">
                <h3>{{trans('Product')}} 2</h3>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="image">{{ trans('Image') }}</label>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="text" class="form-control" id="image" name="product[product2][image]"
                                   value="{{$product['product2']['image'] ?? ''}}">
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
                        <label for="title">{{ trans('Title') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="title" name="product[product2][title]" value="{{$product['product2']['title'] ?? ''}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="link">{{ trans('Link') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="link" name="product[product2][link]" value="{{$product['product2']['link'] ?? ''}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="product-form">
                <h3>{{trans('Product')}} 3</h3>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="image">{{ trans('Image') }}</label>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="text" class="form-control" id="image" name="product[product3][image]"
                                   value="{{$product['product3']['image'] ?? ''}}">
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
                        <label for="title">{{ trans('Title') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="title" name="product[product3][title]" value="{{$product['product3']['title'] ?? ''}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="link">{{ trans('Link') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="link" name="product[product3][link]" value="{{$product['product3']['link'] ?? ''}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="product-form">
                <h3>{{trans('Product')}} 4</h3>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="image">{{ trans('Image') }}</label>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="text" class="form-control" id="image" name="product[product4][image]"
                                   value="{{$product['product4']['image'] ?? ''}}">
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
                        <label for="title">{{ trans('Title') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="title" name="product[product4][title]" value="{{$product['product4']['title'] ?? ''}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="link">{{ trans('Link') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="link" name="product[product4][link]" value="{{$product['product4']['link'] ?? ''}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="input-group mt-5">
        <button type="submit" class="btn btn-info mr-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">{{ trans('Cancel') }}</button>
    </div>
</form>
