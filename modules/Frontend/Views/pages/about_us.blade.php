@extends("Base::frontend.master")

@section("content")
    <div class="container pt-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$data->name ?? ''}}</li>
            </ol>
        </nav>
        <section id="about-us" class="about-us">
            <h1 class="title">{{$data->name ?? ''}}</h1>
            <div class="row">
                <div class="col-md-6">
                    <img src="{{asset($data->image ?? '')}}" class="image" alt="{{$data->image ?? ''}}">
                </div>
                <div class="col-md-6">
                    <div class="content">
                        <?= $data->content ?? '' ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
