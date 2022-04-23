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
        @foreach($options as $key => $option)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>
                    {{ $option->name }}
                    <input type="hidden" name="attr_option[{{ $option->id }}][attribute_id]"
                           value="{{ $option->attribute_id }}">
                    <input type="hidden" class="attr-option-input" name="attr_option[{{ $option->id }}][attribute_option_id]"
                           value="{{ $option->id }}">
                </td>
                <td>{{ $option->attributeModel->name ?? NULL }}</td>
                <td>
                    <input type="number" name="attr_option[{{ $option->id }}][price]" class="form-control" value="0">
                </td>
                <td class="link-action">
                    <a href="{{route('get.product.addAttributeOption') }}" class="btn btn-danger remove-attr-option-btn">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
