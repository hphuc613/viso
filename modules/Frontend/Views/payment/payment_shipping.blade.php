@extends('Frontend::payment.master_payment')
@php($auth = auth('web'))
@php($request = request())
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('Cart') }}</li>
            <li class="breadcrumb-item" aria-current="page">{{ trans('Information') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ trans('Shipping') }}</li>
            <li class="breadcrumb-item" aria-current="page">{{ trans('Payment') }}</li>
        </ol>
    </nav>
    <form action="{{ route('get.payment.getPaymentNow') }}" method="get" class="form">
        <input type="hidden" name="code" value="{{ request('code') }}">
        <div class="shipping-info table-responsive">
            <table class="table mb-0">
                <tbody>
                <tr>
                    <td><label>{{ trans('Contact') }}</label></td>
                    <td>
                        <div class="text">{{ $data['email'] }}</div>
                    </td>
                    <td><a href="{{ route('get.payment.getPaymentInfo', $data) }}">{{ trans('Change') }}</a></td>
                </tr>
                <tr>
                    <td><label>{{ trans('Ship to') }}</label></td>
                    <td>{{ $data['address'] }}, {{ $data['district'] }}
                        , {{ $data['region'] }} {{ $data['country'] }}</td>
                    <td><a href="{{ route('get.payment.getPaymentInfo', $data) }}">{{ trans('Change') }}</a></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="shipping-method">
            <div class="label">
                <h4>Shipping method</h4>
            </div>
            <table class="table table-responsive">
                @foreach($shipping_list as $key => $item)
                    @if (!isset($request->shipping) || empty($request->shipping))
                        <tr class="tr">
                            <td>
                                <label class="checkmark-group">
                                    <input type="radio" name="shipping" id="{{ $item->key_slug }}"
                                           value="{{ $item->key_slug }}"
                                           @if($key == 0) checked @endif>
                                    <span class="checkmark checkmark-radio"></span>
                                </label>
                            </td>
                            <td><label for="{{ $item->key_slug }}">{{ $item->name }}</label></td>
                            <td>
                                <div class="price">{{ moneyFormat($item->value) }}</div>
                            </td>
                        </tr>
                    @else
                        <tr class="tr">
                            <td>
                                <label class="checkmark-group">
                                    <input type="radio" name="shipping" id="{{ $item->key_slug }}"
                                           value="{{ $item->key_slug }}"
                                           @if($request->shipping == $item->key_slug) checked @endif>
                                    <span class="checkmark checkmark-radio"></span>
                                </label>
                            </td>
                            <td><label for="{{ $item->key_slug }}">{{ $item->name }}</label></td>
                            <td>
                                <div class="price">{{ moneyFormat($item->value) }}</div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
            <div class="group-btn">
                <button type="submit"
                        class="btn btn-dark text-light me-2">{{ trans('Continue to payment') }}</button>
                <a href="{{ route('get.payment.getPaymentInfo', $data) }}"
                   class="btn cl-text-primary">{{ trans('Return to information') }}</a>
            </div>
        </div>
    </form>
    <hr>
@endsection
@push('js')

@endpush
