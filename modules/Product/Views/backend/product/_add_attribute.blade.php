<div class="row">
    <div class="col-md-8">
        @foreach($attributes as $attribute)
            @php($option_selected = isset($data) ? $data->attributeOptions->where('attribute_id', $attribute->id)->pluck("id")->toArray() : [])
            <div class="attribute-group ml-5 mb-4" id="attribute-{{ $attribute->key_slug }}">
                <h5 class="title">{{ $attribute->name }}</h5>
                <div class="input-group">
                    {!! Form::select('', $attribute->getOptionArray(), $option_selected ?? [], [
                            'id' => 'attribute-option-dropdown',
                            'multiple' => 'multiple',
                            'class' => 'select2 form-control']) !!}
                    <div class="input-group-prepend">
                        <a href="{{route('get.product.addAttributeOption') }}"
                           class="btn btn-primary add-attr-option-btn">{{ trans('Add Option') }}</a>
                    </div>
                </div>
                <div class="option-listing">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('Attribute Option') }}</th>
                                <th>{{ trans('Attribute') }}</th>
                                <th style="width: 200px;">{{ trans('Price') }}</th>
                                <th class="action">{{ trans('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($product_options = isset($data) ? $data->productAttributeOptions()->where('attribute_id', $attribute->id)->get() : [])
                            @php($key = 0)
                            @foreach($product_options as $key => $product_option)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        {{ $product_option->option->name ?? NULL}}
                                        <input type="hidden"
                                               name="attr_option[{{ $product_option->attribute_option_id }}][attribute_id]"
                                               value="{{ $product_option->attribute_id }}">
                                        <input type="hidden" class="attr-option-input"
                                               name="attr_option[{{ $product_option->attribute_option_id }}][attribute_option_id]"
                                               value="{{ $product_option->attribute_option_id }}">
                                    </td>
                                    <td>{{ $product_option->option->attributeModel->name ?? NULL }}</td>
                                    <td>
                                        <input type="number" class="form-control"
                                               name="attr_option[{{ $product_option->attribute_option_id }}][price]"
                                               value="{{ $product_option->price }}">
                                    </td>
                                    <td class="link-action">
                                        <a href="{{route('get.product.addAttributeOption') }}"
                                           class="btn btn-danger remove-attr-option-btn">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    </div>
</div>
@push('js')
    <script !src="">
        /** Add Attribute Option **/
        $(document).on('click', '.add-attr-option-btn', function (e) {
            e.preventDefault();
            let parent = $(this).parents('.attribute-group');
            let option_dropdown = parent.find('select');
            let listing = parent.find('.option-listing');
            let url = $(this).attr('href');
            $.ajax({
                url: url + "?option_ids=" + option_dropdown.val(),
                method: 'get'
            }).done(function (response) {
                listing.html(response);
            })
        });

        /** Remove Attribute Option **/
        $(document).on('click', '.remove-attr-option-btn', function (e) {
            e.preventDefault();
            let parent = $(this).parents('.attribute-group');
            let option_dropdown = parent.find('select');
            let url = $(this).attr('href');
            let table = $(this).parents('table');
            let listing = $(this).parents('.option-listing');
            $(this).parents('tr').remove();

            let inputs = table.find('.attr-option-input');
            let option_ids = [];
            inputs.each(function (i, item) {
                option_ids.push($(item).val());
            });

            $.ajax({
                url: url + "?option_ids=" + option_ids,
                method: 'get'
            }).done(function (response) {
                listing.html(response);
                option_dropdown.select2().val(option_ids).trigger('change');
            })
        });
    </script>
@endpush
