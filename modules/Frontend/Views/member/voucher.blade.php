@extends('Base::frontend.master')

@section('content')
    <div class="container pt-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{trans('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('My Voucher')}}</li>
            </ol>
        </nav>
        <section id="voucher" class="register mb-5">
            <h1 class="title-register">{{trans('My Voucher')}}</h1>
            <hr class="mb-3">
            <div class="table-responsive mb-3">
                <table class="table table-voucher">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('Code') }}</th>
                        <th>{{ trans('Name') }}</th>
                        <th style="width: 10%" class="text-center">{{ trans('Value') }}</th>
                        <th style="width: 13%">{{ trans('Expiration Date') }}</th>
                        <th style="width: 5%" class="text-center">{{ trans('View') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key => $item)
                        @if(!empty($item->voucher))
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{ $item->voucher->code ?? '' }}</td>
                                <td>{{ $item->voucher->name ?? '' }}</td>
                                <td class="text-center">{{ ($item->voucher->value ?? '') . (\Modules\Voucher\Models\Voucher::getType($item->voucher->type ?? '')) }}</td>
                                <td>{{ $item->voucher->expiration_date != null ? formatDate(strtotime($item->voucher->expiration_date), 'd-m-Y H:i') : trans('Unlimited')}}</td>
                                <td class="text-center">
                                    <a href="{{ route('get.home.voucherDetail',$item->voucher->key_slug ?? '') }}"
                                       class="btn cl-text-blue">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $data->withQueryString()->render("vendor/pagination/frontend") }}
            </div>
        </section>
        @if(!empty($hot_voucher))
            <section id="hot-voucher" class="register">
                <div class="row">
                    <div class="col-6"><h1 class="title-register">{{trans('Hot Voucher')}}</h1></div>
                    <div class="col-6 text-warning mt-2 text-end" style="font-size: 28px">
                        {{trans('Current Accumulated Points')}}: {{ number_format($member->point ?? 0)}}
                    </div>
                </div>
                <hr class="mb-3">
                <div class="table-responsive mb-3">
                    <table class="table table-voucher">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('Code') }}</th>
                            <th>{{ trans('Name') }}</th>
                            <th class="text-center">{{ trans('Value') }}</th>
                            <th>{{ trans('Expiration Date') }}</th>
                            <th>{{ trans('Points to Redeem') }}</th>
                            <th style="width: 8%" class="text-center">{{ trans('Quantity') }}</th>
                            <th style="width: 8%" class="text-center">{{ trans('View') }}</th>
                            <th style="width: 8%" class="text-center">{{ trans('Redeem') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hot_voucher as $key => $item)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{ $item->code ?? '' }}</td>
                                <td>{{ $item->name ?? '' }}</td>
                                <td class="text-center">{{ ($item->value ?? '') . (\Modules\Voucher\Models\Voucher::getType($item->type ?? '')) }}</td>
                                <td>{{ $item->expiration_date != null ? formatDate(strtotime($item->expiration_date), 'd-m-Y H:i') : trans('Unlimited') }}</td>
                                <td>{{ $item->point_redeem == 0 ? trans('Free') : $item->point_redeem.' '. trans('points') }}</td>
                                <td class="text-center">{{ ($item->quantity ?? '∞')}}</td>
                                <td class="text-center">
                                    <a href="{{ route('get.home.voucherDetail',$item->key_slug ?? '') }}"
                                       class="btn cl-text-blue">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if($item->quantity === 0
                                        || ($item->point_redeem == 0
                                            && !\Modules\Voucher\Models\VoucherMember::isReceiveVoucher($member->id,$item->id))
                                        || $item->point_redeem > $member->point
                                        )
                                        <div class="btn cl-text-primary cl-bg-gray" style="cursor: default">
                                            <i class="fa fa-exchange-alt"></i>
                                        </div>
                                    @else
                                        <a id="redeem" class="btn text-white cl-bg-primary"
                                           data-href="{{route('get.home.redeemVoucher',$item->key_slug)}}"
                                           data-point="{{$item->point_redeem ?? 0}}">
                                            <i class="fa fa-exchange-alt"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $data->withQueryString()->render("vendor/pagination/frontend") }}
                </div>
            </section>
        @endif
    </div>
@endsection
@push('js')
    <script>
        $(document).on('click', '#redeem', function () {
            let href = $(this).data('href');
            let point = $(this).data('point');
            if (point !== 0) {
                Swal.fire({
                    title: '{{trans('Are you sure?')}}',
                    text: '{{trans('Are you sure to use ')}}' + point + '{{trans(' points to redeem this voucher?')}}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#9BBCD8',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{trans('Yes, sure!')}}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = href;
                    }
                })
            } else {
                location.href = href;
            }
        });
    </script>
@endpush
