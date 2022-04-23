@extends('Base::frontend.master')
@section('content')
    <div class="container pt-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{trans('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('Shopping Cart')}}</li>
            </ol>
        </nav>
        <section id="cart-detail" class="shopping-cart">
            <div class="d-flex justify-content-between align-items-cente mb-5">
                <div class="title">
                    <h1 class="cl-text-blue">{{trans('我的購物車')}}</h1>
                </div>
                <a href="{{ route('get.product.productListing') }}" class="continue-shopping">
                    {{trans('繼續購物')}} <i class="fas fa-chevron-right"></i>
                </a>
            </div>
            <form action="">
                <div class="cart-content">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="shopping-list card border-0 rounded-0">
                                <div class="card-header">
                                    <h5>{{trans('產品')}}</h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="cart-list">
                                        @foreach($cart['items'] as $key => $item)
                                            @php($item_product = $item['product'])
                                            <div class="cart-item selector-close row">
                                                <div class="image col-md-3 col-4">
                                                    <img src="{{ asset($item_product->image) }}" width="100%"
                                                         alt="{{ asset($item_product->image) }}">
                                                </div>
                                                <div class="content col-md-7 col-8">
                                                    <div class="top">
                                                        <div class="title m-0">
                                                            {{ $item_product->name }}
                                                        </div>
                                                        <div class="capacity">{{ $item["capacity"] ?? NULL }}</div>
                                                        <div class="price">{{ moneyFormat($item["price"], "$") }}</div>
                                                    </div>
                                                    <div class="bottom">
                                                        <div class="mb-1">{{trans('數量')}}:</div>
                                                        <div class="range-quantity">
                                                            <div class="input-group">
                                                                <button type="button" class="btn border decrease">-
                                                                </button>
                                                                <div class="d-none cart-item">{{ $key }}</div>
                                                                <input type="number" min="1"
                                                                       value="{{ $item["quantity"] ?? 0 }}"
                                                                       class="form-control cart-item-quantity">
                                                                <button type="button" class="btn border increase">+
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="remove-cart-item close" data-key="{{ $key }}">
                                                        <i class="bi bi-x-lg"></i>
                                                        {{trans('移除')}}
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="shopping-overview card border-0 rounded-0">
                                <div class="card-header text-center">
                                    <h5>{{trans('訂單')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="input-group">
                                        <a href="{{ route('get.home.getApplyVoucher') }}" data-bs-toggle="modal"
                                           data-bs-target="#form-modal-normal"
                                           class="form-control voucher-applied rounded-0 d-flex align-items-center">
                                            @if(isset($cart['voucher']) && !empty($cart['voucher']))
                                                <span class="text-secondary py-1 px-2 text-truncate border text-white"
                                                      style="max-width: 100%; background-color: #ff6200">
                                                    {{ ($cart['voucher'])->name ?? NULL }}
                                                </span>
                                            @else
                                                <span class="text-secondary text-truncate w-100">
                                                    {{ trans('Gift card or discount code') }}
                                                </span>
                                            @endif
                                        </a>
                                        <button type="button"
                                                class="btn btn-main btn-clear-voucher" style="width: 6rem">{{trans('Clear')}}</button>
                                    </div>
                                    <div
                                        class="cart-total-price d-flex align-items-end border-bottom border-cl-secondary py-4 mb-4">
                                        <h5 class="fw-bold me-2">{{trans('總額')}}:</h5>
                                        <div class="price" id="cart-amount">
                                            ${{ moneyFormat($cart['amount'] ?? 0, false) }}</div>
                                    </div>
                                    <div class="comment">
                                        <div class="form-group">
                                            <label class="note fw-bold mb-2">
                                                <span
                                                    class="text-light fw-normal cl-bg-primary px-2 me-2">{{trans('Note')}}</span>
                                                {{trans('Additional comments')}}
                                            </label>
                                            <textarea class="form-control mb-3" name="" id="" rows="5"></textarea>
                                        </div>
                                        <a href="{{ route('get.payment.getPaymentInfo', ['code' => $cart['code'] ?? NULL ]) }}"
                                           class="btn btn-main w-100">付款</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-5">
                        <div class="title py-5">
                            <h4 class="fw-bold cl-text-blue">{{trans('BEST SELLERS')}}</h4>
                        </div>
                        <div class="product-list owl-carousel">
                            @foreach($products as $product)
                                <div class="product-item d-block">
                                    <a href="{{ route('get.product.productDetail', $product->key_slug) }}">
                                        <img src="{{ asset($product->image) }}" class="mb-3 me-0 w-100"
                                             alt="{{ asset($product->image) }}">
                                    </a>
                                    <div class="content text-center mb-3">
                                        <a href="{{ route('get.product.productDetail', $product->key_slug) }}"
                                           class="title">{{ $product->name }}</a>
                                        <div class="product-price">
                                            {{trans('from')}} <span
                                                class="price"> {{ !empty($capacity = $product->capacities->sortBy('price')->first()) ? (!empty($capacity->discount) ? $capacity->discount : $capacity->price) : $product->price }} </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel({
                margin: 21,
                responsiveClass: true,
                nav: true,
                navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
                responsive: {
                    0: {
                        items: 2,
                    },
                    750: {
                        items: 4,
                    },
                }
            });

            updateGeneralCart("{{ route('get.cart.updateCart') }}");
        });
    </script>
@endpush
