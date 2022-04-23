@extends("Base::frontend.master")
<?php
$title = trans('All Items');
if (isset(request()->cate)) {
    $title = $data->first()->category->name;
    if (request()->cate === "best-seller") {
        $title = trans('Best Seller');
    }
}
?>
@section("content")
    <div class="container pt-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"
                    aria-current="page"> {{ $title }} </li>
            </ol>
        </nav>
    </div>
    <section id="all-item" class="all-item">
        <div class="container mb-5 title">
            <h1 class="cl-text-blue">{{ $title }}</h1>
        </div>
        <div class="container mb-5">
            <div id="product-list" class="product-list row">
                @foreach($data as $item)
                    <div class="col-md-3">
                        <div class="product-item @if((int)$item->discount > 0) sale-off @endif">
                            <a href="{{ route('get.product.productDetail', $item->key_slug) }}"><img
                                    src="{{ asset($item->image ?? '') }}" class="mb-3"
                                    alt="{{ asset($item->image ?? '') }}"></a>
                            <div class="content text-md-center mb-3">
                                <div class="description">
                                    <a href="{{ route('get.product.productDetail', $item->key_slug) }}"
                                       class="title">{{ $item->name ?? '' }}</a>
                                </div>
                                <div class="product-price">
                                    @if(!empty($capacity = $item->capacities->sortBy('price')->first()))
                                        from <span
                                            class="price">${{ moneyFormat(!empty($capacity->discount) ? $capacity->discount : $capacity->price, false) }}</span>
                                    @else
                                        @if((int)$item->discount > 0)
                                            <span
                                                class="price text-secondary text-decoration-line-through">${{ moneyFormat($item->price, false) }}</span>
                                            <span
                                                class="price text-danger">${{ moneyFormat($item->discount, false) }}</span>
                                        @else
                                            <span
                                                class="price">${{ moneyFormat($item->price, false) }}</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center py-5 mb-5">
                @php
                    $check_has_next_page = ($data->currentPage()+1 <= $data->lastPage());
                    $next_page = ($check_has_next_page) ? $data->currentPage()+1 : $data->currentPage()
                @endphp
                <a href="{{ route('get.product.productListing', ['cate' => request('cate') ?? null, 'page' => $next_page]) }}"
                   class="btn btn-outline-main btn-shop-more @if(!$check_has_next_page) d-none @endif" id="show-more"
                   data-check="{{ $check_has_next_page }}">{{trans('SHOW MORE')}}</a>
            </div>
            <hr class="mb-5">
            <div class="product-recently-see py-5">
                <h2 class="cl-text-blue text-capitalize">{{ trans("Recently viewed products") }}</h2>
                <div class="product-list py-5 row">
                    @foreach($product_recentlies as $product)
                        <div class="col-md-3">
                            <div class="product-item">
                                <a href="{{route('get.product.productDetail',$product->key_slug)}}"><img
                                        src="{{asset($product->image ?? '')}}" class="mb-3"
                                        alt="{{asset($product->image ?? '')}}"></a>
                                <div class="content text-md-center mb-3">
                                    <a href="{{route('get.product.productDetail',$product->key_slug)}}" class="title">
                                        {{$product->name ?? ''}}
                                    </a>
                                    <div class="product-price">{{trans('from')}} <span
                                            class="price">${{moneyFormat($product->price, false)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script !src="">
        $(function () {
            var listing = $('#product-list');
            var show_more = $("a#show-more");
            show_more.click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr("href"),
                    type: "get"
                }).done(function (response) {
                    var show_more_ajax = $(response).find("a#show-more");
                    listing.append($(response).find("#product-list").html());
                    show_more.attr("href", show_more_ajax.attr("href"));
                    if (show_more_ajax.attr("data-check") !== "1") {
                        show_more.hide();
                    }
                });
            });
        });
    </script>
@endpush
