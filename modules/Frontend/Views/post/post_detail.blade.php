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
                <li class="breadcrumb-item"><a href="{{ route('get.post.postListing') }}">{{trans('最新消息')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $data->title ?? '' }}</li>
            </ol>
        </nav>
        <section id="skincare" class="skincare">
            <h1 class="title">{{ $data->title ?? '' }}</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="recent">
                        <h5 class="recent-title">{{trans('RECENT ARTICLES')}}</h5>
                        @foreach($data_recent as $item)
                            <div class="recent-article">
                                <a href="{{ route('get.post.postDetail', ['id' => $item->id, 'slug' => $item->key_slug]) }}">
                                    <div class="name-article">{{ $item->title ?? '' }}</div>
                                </a>
                                <div class="date-article">{{ formatDate(strtotime($item->created_at), 'F d, Y') }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="article">
                        <h4 class="name-article">{{ $data->title ?? '' }}</h4>
                        <div class="date-article">{{ formatDate(strtotime($item->created_at), 'F d, Y') }}</div>
                        <div class="content-article">
                            {!! $data->content ?? '' !!}
                        </div>
                        <div class="divider">{{trans('FEATURED PRODUCT')}}</div>
                        <div class="product-list row">
                            @foreach($products as $product)
                                <div class="col-md-3">
                                    <div class="product-item">
                                        <a href="{{ route('get.product.productDetail', $product->key_slug) }}">
                                            <img src="{{ asset($product->image ?? '') }}" class="w-100" alt="{{ asset($product->image ?? '') }}">
                                        </a>
                                        <div class="content text-md-center py-md-3">
                                            <a href="{{ route('get.product.productDetail', $product->key_slug) }}">{{ $product->name }}</a>
                                            <span class="price">${{ moneyFormat($product->price, false) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="direct">
                            <a href="@if(!empty($old_post)) {{ route('get.post.postDetail', ['id' => $old_post->id, 'slug' => $old_post->key_slug]) }} @else javascript: @endif">
                                <i class="bi bi-chevron-left"></i> <u>{{trans('OLDER POST')}}</u>
                            </a>
                            <a href="@if(!empty($new_post)) {{ route('get.post.postDetail', ['id' => $new_post->id, 'slug' => $new_post->key_slug]) }} @else javascript: @endif">
                                <u>{{trans('NEWER POST')}}</u> <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
