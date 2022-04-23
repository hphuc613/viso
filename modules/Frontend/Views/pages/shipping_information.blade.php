@extends("Base::frontend.master")

@section("content")
    <div class="container pt-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$data->name ?? ''}}</li>
            </ol>
        </nav>
        <section id="shipping" class="shipping">
            <h1 class="title">{{$data->name ?? ''}}</h1>
            <div class="content">
                <?= $data->content ?? '' ?>
            </div>
        </section>
    </div>
@endsection
