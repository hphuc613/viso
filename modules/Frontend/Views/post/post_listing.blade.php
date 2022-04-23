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
                <li class="breadcrumb-item active" aria-current="page">{{trans('最新消息')}}</li>
            </ol>
        </nav>
        <section id="list-skincare" class="skincare">
            <h1 class="title">{{trans('SKINCARE')}}</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="recent">
                        <div class="recent-title">{{trans('RECENT ARTICLES')}}</div>
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
                    <div class="list-article">
                        @foreach($data as $item)
                            <div class="article">
                                <a href="{{ route('get.post.postDetail', ['id' => $item->id, 'slug' => $item->key_slug]) }}">
                                    <div class="name-article">{{ $item->title ?? '' }}</div>
                                </a>
                                <div class="date-article">{{ formatDate(strtotime($item->created_at), 'F d, Y') }}</div>
                                <a href="{{ route('get.post.postDetail', ['id' => $item->id, 'slug' => $item->key_slug]) }}">
                                    <img class="thumbnail-article" src="{{ asset($item->image ?? '') }}" alt="">
                                </a>
                                <div class="content-article">
                                    {{ $item->description ?? '' }}
                                </div>
                                <a href="{{ route('get.post.postDetail', ['id' => $item->id, 'slug' => $item->key_slug]) }}"
                                   class="btn btn-outline-main-light btn-read-more">{{trans('READ MORE')}}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex justify-content-center" id="paginate-feedback">
                    {{ $data->withQueryString()->render('vendor.pagination.frontend') }}
                </div>
            </div>
        </section>
    </div>
@endsection
