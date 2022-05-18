@extends("Base::backend.master")

@section("content")
    <div id="product-module">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans("Attribute") }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans("Home") }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.attribute.list') }}">{{ trans("Attribute") }}</a></li>
                        <li class="breadcrumb-item active">{{ trans("Update") }}</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="mb-3 d-flex justify-content-end group-btn">
            <a href="{{ route("get.attribute.list") }}" class="btn btn-cyan">{{ trans("Back") }}</a>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ trans('Update Attribute') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" id="attribute-form">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="name">{{ trans('Name') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ $data->name ?? old('name') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="status">{{ trans('Status') }}</label>
                                </div>
                                <div class="col-md-8">
                                    @php($prompt = ['' => trans('Select')])
                                    {!! Form::select('status', $prompt + $statuses, $data->status ?? NULL, [
                                        'id' => 'status',
                                        'class' => 'select2 form-control',
                                        'style' => 'width: 100%']) !!}
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
                                <button type="reset" class="btn btn-default"
                                        data-dismiss="modal">{{ trans('Cancel') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4>{{ trans('Attribute Options') }}</h4>
                            <a href="{{ route('get.attribute_option.create', $data->id ?? NULL) }}" class="btn btn-primary"
                               data-toggle="modal" data-target="#form-modal"
                               data-title="{{ trans("Create Attribute Option") }}">
                                <i class="fa fa-plus"></i>&nbsp; {{ trans("Add New") }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="sumary">
                            {!! summaryListing($options) !!}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('Name') }}</th>
                                    <th>{{ trans('Description') }}</th>
                                    <th>{{ trans('Created At') }}</th>
                                    <th class="action">{{ trans('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($key = ($options->currentpage()-1)*$options->perpage()+1)
                                @foreach($options as $item)
                                    <tr>
                                        <td>{{$key++}}</td>
                                        <td>{{ trans($item->name) }}</td>
                                        <td>{{ $item->description ?? null }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i:s')}}</td>
                                        <td class="link-action">
                                            <a href="{{ route('get.attribute_option.update', $item->id) }}"
                                               data-toggle="modal" data-target="#form-modal"
                                               data-title="{{ trans("Update Attribute Option") }}"
                                               class="btn btn-primary">
                                                <i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('get.attribute_option.delete', $item->id) }}"
                                               class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="mt-5  pagination-style pagination-index">
                                {{ $options->withQueryString()->render('vendor/pagination/default') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! getModal(["class" => "modal-ajax"]) !!}
@endsection
@push('js')
    {!! JsValidator::formRequest('Modules\Product\Requests\AttributeRequest','#attribute-form') !!}
@endpush
