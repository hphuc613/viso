@php
    /** @var Order $data */
    use Modules\Order\Models\Order;
    use App\AppHelpers\Helper;
    $order_details = $data->orderDetails;

    $name_invoice = Helper::getSetting('NAME_INVOICE');
    $phone= Helper::getSetting('PHONE_NUMBER');
    $address = Helper::getSetting('ADDRESS')
@endphp

<style>
    .modal-lg {
        max-width: 1000px;
    }
</style>
<div id="invoice" class="container">
    <div id="company-info">
        <h3>{{$name_invoice ?? trans('GLADS BEAUTY WORKSHOP')}}</h3>
        <p class="mb-1">
            {{ trans('Address') }}: {{$address ?? ''}}
        </p>
        <p class="mb-1">
            {{ trans('Tel') }}: {{$phone ?? ''}}
        </p>
        <hr>
    </div>
    <div id="content">
        <div class="text-center title">
            <h3>{{ trans('INVOICE') }}</h3>
        </div>
        <div class="info mb-3 row">
            <div class="col-6">
                <div class="row">
                    <div class="col-4">
                        {{ trans('To') }} :
                    </div>
                    <div class="col-8">
                        {{ $data->member_name ?? "N/A"}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        {{ trans('Email') }} :
                    </div>
                    <div class="col-8">
                        {{ $data->email  ?? "N/A"}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        {{ trans('Phone') }} :
                    </div>
                    <div class="col-8">
                        {{ $data->phone ?? "N/A" }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        {{ trans('Address') }} :
                    </div>
                    <div class="col-8">
                        {{ $data->address ?? "N/A" }}
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-4">
                        {{ trans('Invoice Code') }} :
                    </div>
                    <div class="col-8">
                        <span class="font-weight-bold">{{ $data->code }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        {{ trans('Purchase/Abort At') }} :
                    </div>
                    <div class="col-8">
                        {{ formatDate(strtotime($data->updated_at), 'd-m-Y H:i') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        {{ trans('Status') }} :
                    </div>
                    <div class="col-8">
                        <span class="font-weight-bold">{{ Order::getStatus()[$data->status] }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        {{ trans('Payment Method') }} :
                    </div>
                    <div class="col-8">
                        {{ $data->paymentMethod->name ?? NULL }}
                    </div>
                </div>
            </div>
        </div>

        <div class="product-list">
            <div class="table-responsive mb-3">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th style="width: 250px">{{ trans('Product') }}</th>
                        <th>{{ trans('Capacity') }}</th>
                        <th>{{ trans('Price') }}</th>
                        <th class="text-center">{{ trans('Quantity') }}</th>
                        <th>{{ trans('Total Price') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order_details as $key => $order_detail)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $order_detail->product->name ?? $order_detail->product_name }}</td>
                            <td>{{ $order_detail->capacity }}</td>
                            <td>{{ moneyFormat($order_detail->price) }}</td>
                            <td class="text-center">{{ $order_detail->quantity }}</td>
                            <td>{{ moneyFormat($order_detail->amount) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5"></td>
                        <td colspan="1">
                            <div class="d-flex justify-content-between">
                                <h6>{{ trans('Total Price') }}:</h6> <h6>{{ moneyFormat($data->total_price, "$") }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-danger">{{ trans('Voucher') }}:</h6>
                                <h6 class="text-danger">
                                    -{{ moneyFormat((!empty($data->voucher_value) ? $data->voucher_value : 0), "$") }}
                                </h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6>{{ trans('Shipping') }}:</h6>
                                <h6> {{ moneyFormat($data->shipping_price, '$') }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 style="font-weight: 600;">{{ trans('Amount') }}:</h5>
                                <h5 class="text-success"> {{ moneyFormat($data->amount) }}</h5>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <button class="btn btn-primary print"><i class="mdi mdi-printer"></i></button>
</div>

<script>
    $(document).on('click', '.print', function () {
        printJS({
            printable: 'invoice',
            type: 'html',
            css: ['/assets/bootstrap/css/bootstrap.min.css']
        })
    });
</script>
