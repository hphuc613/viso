@extends("Base::backend.master")
@push('css')
    <style>
        .icon-edit {
            font-size: 2rem;
        }

        .edit-button {
            top: 0;
            right: 0;
            cursor: pointer;
        }

        .banner-image {
            width: 100%;
            height: 40rem;
            object-fit: cover;
        }

        .banner-title {
            position: absolute;
            bottom: 4rem;
            text-align: center;
            width: 100%;
            font-size: 3rem;
            font-weight: 600;
            color: #ffffff;
        }

        .product h3 {
            font-weight: bold;
        }

        .product img{
            height: 360px;
            object-fit: cover;
        }

        .btn-main {
            color: white;
            border-radius: 0;
            background-color: #9BBCD8;
            border-color: #9BBCD8;
        }

        .btn-product {
            font-size: 20px;
            font-family: Helvetica, sans-serif;
            font-weight: bold;
            box-shadow: 0 3px 6px rgba(0 0 0 0.51) !important;
            padding: 0.72rem 1.4rem;
        }

        .product-form {
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 1rem;
        }


        .natural {
            display: flex;
            position: relative;
        }

        .story-left {
            width: 50%;
            background-size: cover;
            margin-bottom: 0;
        }

        .story-left .title-story {
            font-size: 35px;
            font-family: HelveticaNeue-Thin, sans-serif;
            font-weight: 100;
            margin-bottom: 3.5rem;
            text-shadow: 0 4px 4px rgba(0, 0, 0, 0.64);
        }

        .story-left .title-description {
            padding: 0 1rem;
            font-size: 40px;
            font-family: HelveticaNeue, sans-serif;
            letter-spacing: 0.2px;
            text-shadow: 0 4px 4px rgba(0, 0, 0, 0.64);
        }

        .story-right {
            background-color: #9BBCD8;
            width: 50%;
            padding: 2rem 4rem 5rem;
        }

        .story-right .title-story {
            color: #316490;
            font-family: Analogue, sans-serif;
            letter-spacing: -2.5px;
            margin-top: 1rem;
            margin-bottom: 5rem;
        }

        .story-right .title-description {
            font-family: HelveticaNeue-Medium, sans-serif;
            line-height: 36px;
            font-weight: 600;
            padding: 0;
            margin-bottom: 6rem;
            font-size: 16px;
        }

        .img-natural {
            margin-bottom: 4rem;
        }

        .img-natural img {
            height: 75px;
            width: 75px;
        }

        .img-natural p {
            width: 164px;
            font-size: 20px;
            font-family: HelveticaNeue-Light, sans-serif;
            line-height: 30px;
            letter-spacing: -0.5px;
        }

        .story {
            position: relative;
            background-color: #d4e2ee;
        }

        .story .story-content {
            padding: 3rem 10rem;
        }

        .story .story-content .title-story {
            font-size: 65px;
            margin-top: 3rem;
            font-family: Analogue, sans-serif;
            line-height: 113px;
            color: #316490;
        }

        .story .story-content .intent {
            line-height: 55px;
            font-size: 20px;
            font-family: HelveticaNeue-Medium, sans-serif;
            font-weight: 600;
            margin-bottom: 4rem;
        }

        .story .story-content img {
            margin-bottom: 3rem;
            height: 300px;
            object-fit: cover;
        }

        .btn-learn-more {
            padding: 1.5rem 3rem;
            font-size: 20px;
            font-weight: 600;
            font-family: Helvetica, sans-serif;
            box-shadow: 0 3px 6px rgba(0 0 0 0.51) !important;
        }

        textarea{
            height: 10rem;
        }
    </style>
@endpush
@section("content")
    <div id="page-module">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans("Home") }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans("Home") }}</a></li>
                        <li class="breadcrumb-item active">{{ trans("Page") }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section id="banner">
        <div class="card">
            <div class="card-body">
                <h3>{{trans('Banner')}}</h3>
                <div class="position-relative h-auto">
                    <img class="banner-image" src="{{ asset($data[\Modules\Page\Models\Home::BANNER] ?? 'storage/upload/Home/default.png') }}"
                         alt="">
                    <a href="{{ route("get.home_banner.update")}}"
                       data-toggle="modal" data-target="#form-modal"
                       data-title="{{ trans("Banner Config")}}" class="position-absolute edit-button"><i
                            class="fa fa-edit icon-edit"></i></a>

                    <div class="banner-title">
                        {{$data[\Modules\Page\Models\Home::BANNER_TITLE] ?? 'Banner Title'}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="product">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <h3>{{trans('Product')}}</h3>
                    <a href="{{ route("get.home_product.update")}}"
                       data-toggle="modal" data-target="#form-modal"
                       data-title="{{ trans("Product Config")}}" class="position-absolute edit-button"><i
                            class="fa fa-edit icon-edit"></i></a>
                </div>
                <div class="row product">
                    @foreach(json_decode($data[\Modules\Page\Models\Home::PRODUCT],1) ?? [] as $product)
                        <div class="col-md-3">
                            <div class="card border-0">
                                <img src="{{ asset($product['image'] ?? 'storage/upload/Home/default.png') }}" alt="">
                                <div class="card-img-overlay d-flex align-items-end">
                                    <div class="w-100 text-center">
                                        <h3 class="text-white">{{$product['title'] ?? 'Title'}}</h3>
                                        <a href="#"
                                           class="btn btn-main btn-product">
                                            {{trans('SHOP NOW')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section id="our-story">
        <div class="card">
            <div class="card-body">
                <h3>{{trans('Story')}}</h3>
                <div class="our-story">
                    <div class="natural">
                        <div class="story-left card border-0"
                             style="background-image: url('{{ asset($data[\Modules\Page\Models\Home::CATALOG_LEFT_IMAGE]
                                                                ?? 'storage/upload/Home/home_natural.svg') }}')">
                            <div class="card-img-overlay d-flex align-items-center">
                                <div class="w-100 text-center">
                                    <h1 class="text-white title-story">{{$data[\Modules\Page\Models\Home::CATALOG_LEFT_TITLE] ?? 'Title'}}</h1>
                                    <h1 class="text-white title-description text-center">{{$data[\Modules\Page\Models\Home::CATALOG_LEFT_CONTENT] ?? 'Content'}}</h1>
                                </div>
                            </div>
                            <a href="{{ route("get.home_catalog_left.update")}}"
                               data-toggle="modal" data-target="#form-modal"
                               data-title="{{ trans("Story Config")}}" class="position-absolute edit-button"><i
                                    class="fa fa-edit icon-edit"></i></a>
                        </div>
                        <div id="story-right" class="story-right text-center">
                            <a href="{{ route("get.home_catalog_right.update")}}"
                               data-toggle="modal" data-target="#form-modal"
                               data-title="{{ trans("Story Config")}}" class="position-absolute edit-button"><i
                                    class="fa fa-edit icon-edit"></i></a>
                            <h1 class="cl-text-blue title-story">{{$data[\Modules\Page\Models\Home::CATALOG_RIGHT_TITLE] ?? 'Title'}}</h1>
                            <h6 class="text-white title-description">{{$data[\Modules\Page\Models\Home::CATALOG_RIGHT_CONTENT] ?? 'Content'}}</h6>
                            <div id="img-natural" class="text-center img-natural">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-4">
                                        <img
                                            src="{{ asset($data[\Modules\Page\Models\Home::CATALOG_RIGHT_IMG_1]??'storage/upload/Home/home_lotion.svg') }}"
                                            class="card-img-top"
                                            alt="{{ $data[\Modules\Page\Models\Home::CATALOG_RIGHT_IMG_1]??'' }}">
                                        <div
                                            class="card-body d-flex align-items-end text-center justify-content-center">
                                            <p class="text-white card-text">{{$data[\Modules\Page\Models\Home::CATALOG_RIGHT_CONTENT_1]??'Content'}}</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-xl-4">
                                        <img
                                            src="{{ asset($data[\Modules\Page\Models\Home::CATALOG_RIGHT_IMG_2]??'storage/upload/Home/home_wallet.svg') }}"
                                            class="card-img-top"
                                            alt="{{ $data[\Modules\Page\Models\Home::CATALOG_RIGHT_IMG_2]??'' }}">
                                        <div class="card-body d-flex align-items-end justify-content-center">
                                            <p class="text-white card-text">{{$data[\Modules\Page\Models\Home::CATALOG_RIGHT_CONTENT_2]??'Content'}}</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-xl-4">
                                        <img
                                            src="{{ asset($data[\Modules\Page\Models\Home::CATALOG_RIGHT_IMG_3]??'storage/upload/Home/home_rating.svg') }}"
                                            class="card-img-top"
                                            alt="{{ $data[\Modules\Page\Models\Home::CATALOG_RIGHT_IMG_3]??'' }}">
                                        <div class="card-body d-flex align-items-end justify-content-center">
                                            <p class="text-white card-text">{{$data[\Modules\Page\Models\Home::CATALOG_RIGHT_CONTENT_3]??'Content'}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="story" class="story container">
                        <a href="{{ route("get.home_story.update")}}"
                           data-toggle="modal" data-target="#form-modal"
                           data-title="{{ trans("Story Config")}}" class="position-absolute edit-button"><i
                                class="fa fa-edit icon-edit"></i></a>
                        <div class="text-center story-content">
                            <h1 class="title-story">{{$data[\Modules\Page\Models\Home::OUR_STORY_TITLE]??trans('OUR STORY')}}</h1>
                            <p class="text-white intent">{{$data[\Modules\Page\Models\Home::OUR_STORY_CONTENT]??'Content'}}</p>
                            <img class="w-100"
                                 src="{{ asset($data[\Modules\Page\Models\Home::OUR_STORY_IMAGE]??'storage/upload/Home/home_natural.svg') }}"
                                 alt="story">
                            <a href="#" class="btn btn-main btn-learn-more">
                                {{trans('LEARN MORE')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {!! getModal(["class" => "modal-ajax","size" => "modal-lg"]) !!}
@endsection
