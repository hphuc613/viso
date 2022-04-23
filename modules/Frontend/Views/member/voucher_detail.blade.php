@extends('Base::frontend.master')

@section('content')
    <div class="container pt-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{trans('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('My Voucher')}}</li>
            </ol>
        </nav>
        <section id="voucher" class="register">
            <h1 class="title-register">{{trans('Voucher').': '. $data->name ?? ''}}</h1>
            <hr class="mb-3">
            <div class="table-responsive mb-3">
                <table class="table table-voucher-detail">
                    <tbody>
                    <tr>
                        <td class="title">{{trans('Name')}}</td>
                        <td>{{$data->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td class="title">{{trans('Code')}}</td>
                        <td>{{$data->code ?? ''}}</td>
                    </tr>
                    <tr>
                        <td class="title">{{trans('Discount')}}</td>
                        <td>{{($data->value ?? '').\Modules\Voucher\Models\Voucher::getType($data->type ?? '')}}</td>
                    </tr>
                    <tr>
                        <td class="title">{{trans('Points to Redeem')}}</td>
                        <td>{{ $data->point_redeem == 0 ? trans('Free') : $data->point_redeem.' '. trans('points') }}</td>
                    </tr>
                    <tr>
                        <td class="title">{{trans('Quantity')}}</td>
                        <td>{{$data->quantity ?? '∞'}}</td>
                    </tr>
                    <tr>
                        <td class="title">{{trans('Expiration Date')}}</td>
                        <td>{{$data->expiration_date != null
                                ? formatDate(strtotime($data->expiration_date ?? ''), 'd-m-Y H:i')
                                : trans('Unlimited')
                            }}
                        </td>
                    </tr>
                    <tr>
                        <td class="title">{{trans('Description')}}</td>
                        <td>{{$data->description ?? ''}}</td>
                    </tr>
                    <tr>
                        <td class="title">{{trans('Apply to products')}}</td>
                        <td>{{empty($data->product_ids) ? trans('All products') : ''}}</td>
                    </tr>
                    </tbody>
                </table>
                @if(!empty($data->product_ids))
                    <table class="table table-voucher mt-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('Name') }}</th>
                            <th class="text-center">{{ trans('Price') }}</th>
                            <th class="text-center">{{ trans('View') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data->product_ids as $key => $item)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{ $item->name ?? '' }}</td>
                                <td class="text-center">${{moneyFormat($item->price ?? '', false)}}</td>
                                <td class="text-center">
                                    <a href="{{route('get.product.productDetail',$item->key_slug)}}"
                                       class="cl-text-blue">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <div class="text-center mt-5">
                    @if($data->quantity === 0
                                        || ($data->point_redeem == 0
                                            && !\Modules\Voucher\Models\VoucherMember::isReceiveVoucher($member->id,$data->id))
                                        || $data->point_redeem > $member->point
                                        )
                        <div class="btn cl-text-primary cl-bg-gray px-4 py-3 fw-bold" style="cursor: default">
                            {{trans('Redeem')}}
                        </div>
                    @else
                        <a id="redeem" class="btn text-white cl-bg-primary px-4 py-3 fw-bold"
                           data-href="{{route('get.home.redeemVoucher',$data->key_slug)}}"
                           data-point="{{$data->point_redeem ?? 0}}">
                            {{trans('Redeem')}}
                        </a>
                    @endif
                </div>
            </div>
        </section>
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
