@extends("Base::frontend.master")

@section("content")
    <div class="pt-3">
        <nav class="container" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('Offer of the month')}}</li>
            </ol>
        </nav>
        <section id="offer-month" class="offer-month">
            <div class="container mb-5 title">
                <h1 class="cl-text-blue">{{trans('Offer of the month')}}</h1>
            </div>
            <div class="banner-latest-product d-flex align-items-center justify-content-center">
                <h1 class="cl-text-blue">{{trans('Latest Product')}}</h1>
            </div>
            <div class="container">
                <div class="offer-list">
                    @foreach($data as $item)
                        <div class="offer-item d-md-flex">
                            <div class="flex-shrink-0 mb-2 mb-md-0 offer-image">
                                <a href="{{route('get.offer.bundle',$item->id)}}">
                                    <img src="{{asset($item->image ?? '')}}" width="100%"
                                         alt="{{$item->image ?? ''}}">
                                </a>
                            </div>
                            <div class="flex-grow-1 ms-md-5 offer-content">
                                <div class="content">
                                    <div class="mb-5">
                                        <a href="{{route('get.offer.bundle',$item->id)}}" class="title">
                                            <h3>{{$item->name ?? ''}}</h3>
                                        </a>
                                    </div>
                                    <div class="description">
                                        <?= $item->description ?? '' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
