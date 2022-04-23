@extends('Base::frontend.master')

@section('content')
    <div class="container pt-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{trans('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('My Order')}}</li>
            </ol>
        </nav>
        <section id="voucher" class="register">
            <h1 class="title-register">{{trans('My Order')}}</h1>
            <hr class="mb-3">
            <div class="row">
                <div class="col-md-8">
                    <div id="order-listing">
                        @foreach($data as $item)
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4>{{ $item->code ?? '' }} - {{ formatDate(strtotime($item->created_at), 'd-m-Y H:i:s') }}</h4>
                                </div>
                                <div class="card-body payment">
                                    <div class="order-detail bg-transparent">
                                        <div class="product-list">
                                            @foreach($item->orderDetails as $detail)
                                                @php($product = $detail->product)
                                                <div class="product-item">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="d-flex mb-5 mb-md-0">
                                                                <div class="flex-shrink-0 position-relative">
                                                                    <a href="{{ route('get.product.productDetail', $product->key_slug) }}">
                                                                        <img src="{{ asset($product->image ?? '') }}"
                                                                             alt="{{ asset($product->image ?? '') }}">
                                                                    </a>
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <a href="{{ route('get.product.productDetail', $product->key_slug) }}">
                                                                        <h6 class="mb-0">{{ $product->name ?? '' }}</h6>
                                                                    </a>
                                                                    <div class="text mb-0">{{ $detail->capacity ?? NULL }}</div>
                                                                    <div class="text">{{ $detail->quantity ?? '' }} x
                                                                        ${{ moneyFormat($detail->price ?? 0, 0) }}</div>
                                                                    <div class="price">{{ moneyFormat($detail->amount ?? 0) }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a href="{{ route('get.product.productDetail', $product->key_slug) }}"
                                                               class="btn btn-outline-main mb-2 w-100">
                                                                {{ trans('Review') }}
                                                            </a>
                                                            <a href="{{ route('get.product.productDetail', [$product->key_slug, '#customer-reviews' ]) }}"
                                                               class="btn btn-warning text-white w-100">{{ trans('Feedback') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="float-md-end">
                                        <h3>{{ trans('Total price') }}: {{ moneyFormat($item->amount ?? 0) }}</h3>
                                        <a href="{{ route('get.home.orderDetail', $item->id) }}"
                                           class="btn btn-outline-main mb-2 w-100"
                                           data-bs-toggle="modal" data-bs-target="#form-modal">
                                            {{ trans('Order Detail') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <a href="{{ $data->nextPageUrl() }}"
                           class="btn btn-outline-main btn-shop-more @if(!$data->hasMorePages()) d-none @endif" id="show-more"
                           data-check="{{ $data->hasMorePages() }}">SHOW MORE</a>
                    </div>
                </div>
                <div class="col-md-4">
                    @include('Frontend::member.right_sidebar')
                </div>
            </div>
        </section>
    </div>
@endsection
@push('js')
    <script>
        $(function () {
            var listing = $('#order-listing');
            var show_more = $("a#show-more");
            show_more.click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr("href"),
                    type: "get"
                }).done(function (response) {
                    var show_more_ajax = $(response).find("a#show-more");
                    listing.append($(response).find("#order-listing").html());
                    show_more.attr("href", show_more_ajax.attr("href"));
                    if (show_more_ajax.attr("data-check") !== "1") {
                        show_more.hide();
                    }
                });
            });
        });

        $(document).on('click', '.print', function () {
            printJS({
                printable: 'invoice',
                type: 'html',
                css: ['/assets/bootstrap/css/bootstrap.min.css']
            })
        });
    </script>
@endpush
