<!-- Modal Cart -->
<div class="modal modal-cart-detail border-0" id="modal-cart-detail" tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog modal-lx">
        <div class="modal-content modal-row">
            <div class="modal-body p-0">
                <div class="close-modal">
                    <a href="javascript:" class="d-flex align-items-end" data-bs-dismiss="modal">
                        <i class="bi-x"></i>
                    </a>
                </div>
                <div class="cart-content">
                    <div class="container pb-5" style="border-bottom: 1px solid #d4e2ee;">
                        <div class="modal-title pb-3 mb-5">
                            <h4>{{trans('以下產品已加⼊購物⾞')}}:</h4>
                        </div>
                        <div class="modal-cart-detail-row row">
                            <div class="col-lg-4">
                                <div class="shopping-overview">
                                    <div class="card border-0 rounded-0">
                                        <div class="card-header text-center">
                                            <h5 class="fw-bold">{{trans('查看購物⾞')}}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="cart-count-product text-center p-5">
                                                {{ $cart['quantity'] ?? 0 }}{{trans('購物⾞中的產品')}}
                                            </div>
                                            <div
                                                class="cart-total-price d-flex justify-content-between align-items-center py-3 mb-3">
                                                <h5 class="fw-bold">{{trans('總額')}}:</h5>
                                                <div class="price">${{ moneyFormat($cart['amount'] ?? 0, false) }}</div>
                                            </div>
                                            <div class="cart-btn">
                                                <button class="btn btn-outline-dark rounded-0" data-bs-dismiss="modal">
                                                    {{trans('繼續購物')}}
                                                </button>
                                                <a href="shopping-cart.html" class="btn btn-main">{{trans('付款')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="shopping-list">
                                    <div class="card border-0 rounded-0">
                                        <div class="card-header text-center">
                                            <h5 class="fw-bold">{{trans('你的訂單')}}</h5>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="cart-list">
                                                @if(isset($cart['items']))
                                                    @foreach($cart['items'] as $item)
                                                        @php($item_product = $item['product'])
                                                        <div class="cart-item row">
                                                            <div class="image col-md-2 col-4">
                                                                <a href="{{ route('get.product.productDetail', ['id' => $item_product->id, 'slug' => $item_product->key_slug]) }}">
                                                                    <img src="{{ asset($item_product->image) }}"
                                                                         width="100%" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="col-md-4 col-8">
                                                                <div class="content">
                                                                    <a href="{{ route('get.product.productDetail', ['id' => $item_product->id, 'slug' => $item_product->key_slug]) }}"
                                                                       class="title">
                                                                        {{ $item_product->name }}
                                                                    </a>
                                                                    <div class="capacity">{{ $item['capacity'] ?? NULL }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 range-quantity">
                                                                <div class="price">
                                                                    $<span class="cost-price">{{ $item['price'] }}</span>
                                                                </div>
                                                                <div class="px-2">
                                                                    <div class="input-group">
                                                                        <button type="button"
                                                                                class="btn rounded-0 border decrease">-
                                                                        </button>
                                                                        <input type="number" min="1"
                                                                               value="{{ $item['quantity'] }}"
                                                                               class="form-control text-center"
                                                                               oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
                                                                        <button type="button"
                                                                                class="btn border rounded-0 increase">+
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="price">
                                                                    $<span class="final-price">{{ $item['final_price'] }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container product-list">
                        <div class="title text-center p-4">
                            <h4 class="fw-bold">{{trans('YOU MAY ALSO LIKE')}}</h4>
                        </div>
                        <div class="container mb-5">
                            <div class="product-list row">
                                @foreach($products as $product)
                                    <div class="col-md-3">
                                        <div class="product-item">
                                            <a href="{{ route('get.product.productDetail', ['id' => $product->id, 'slug' => $product->key_slug]) }}"><img
                                                    src="{{ asset($product->image) }}"
                                                    class="mb-3"
                                                    alt="{{ asset($product->image) }}"></a>
                                            <div class="content text-md-center mb-3">
                                                <a href="{{ route('get.product.productDetail', ['id' => $product->id, 'slug' => $product->key_slug]) }}" class="title">
                                                    {{ $product->name }}
                                                </a>
                                                <div class="product-price">from <span class="price">${{ moneyFormat(!empty($product->discount) ? $product->discount : $product->price, false) }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
