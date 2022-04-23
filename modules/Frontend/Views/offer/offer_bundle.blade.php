@extends("Base::frontend.master")

@section("content")
    <div class="pt-3">
        <nav class="container" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('Bundles')}}</li>
            </ol>
        </nav>
        <section id="offer-month-bundle" class="offer-month">
            <div class="container mb-5 title">
                <h1 class="cl-text-blue text-uppercase">{{trans('Bundles')}}</h1>
            </div>
            <div class="banner-latest-product d-flex align-items-center justify-content-center mb-5">
                <h1 class="cl-text-blue">Latest Product</h1>
            </div>
            <div class="container product-also-like text-center py-5 mb-5">
                <div class="product-list row">
                    @foreach($data as $item)
                        <div class="col-md-3">
                            <div class="product-item">
                                <a href="{{ route('get.product.productDetail', $item->key_slug) }}">
                                    <img src="{{asset($item->image ?? '')}}" class="mb-3" alt="../images/cate.png">
                                </a>
                                <div class="content text-md-center mb-3">
                                    <a href="{{ route('get.product.productDetail', $item->key_slug) }}"
                                       class="title">{{$item->name ?? ''}}</a>
                                    {{--<div class="description">Moistening Hamamelis Clearing Treatment</div>--}}
                                    <div class="product-price">from <span class="price">${{$item->price ?? ''}}</span></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="return-product-text">
                <div class="container">
                    <div class="d-flex">
                        <img src="{{asset('storage/upload/Home/offer-bundle-return.svg')}}" width="155" alt="">
                        <div class="text fw-bold">{{trans('If you are not satisfied or encounter sensitive issues, you can send it back to us within 14 days.')}}</div>
                    </div>
                </div>
            </div>
            <div class="register-email">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="cl-text-blue">{{trans('Want more information? Register now')}}</h1>
                            <div class="text cl-text-blue">{{trans('Register to join us to get the latest news, new product releases and discount details')}}</div>
                        </div>
                        <div class="col-md-6">
                            <form action="#">
                                <div class="form-group">
                                    <input type="text" class="form-control border-0 rounded-0" placeholder="{{trans('Enter your email address')}}">
                                </div>
                                <div class="py-2">
                                    <button class="btn btn-light border-0 rounded-0 w-100 fw-bold">{{trans('Send')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
