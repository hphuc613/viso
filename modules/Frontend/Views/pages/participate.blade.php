@extends("Base::frontend.master")

@section("content")
    <div class="container pt-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('過往參與攤位')}}</li>
            </ol>
        </nav>
        <section id="about-us-participating" class="about-us">
            <h1 class="title">{{trans('過往參與攤位')}}</h1>
            <?php $i = 0 ?>
            @foreach($data as $item)
                @if($i++%2 == 0)
                <div class="row participating">
                    <div class="col-md-6">
                        <div class="participate-name cl-text-blue">
                            <h1>{{$item->name ?? ''}}</h1>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="participate-logo border">
                            <img src="{{$item->image ?? ''}}" alt="{{$item->image ?? ''}}">
                        </div>
                    </div>
                </div>
                @else
                    <div class="row participating row-reverse">
                        <div class="col-md-6">
                            <div class="participate-name cl-text-blue">
                                <h1>{{$item->name ?? ''}}</h1>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="participate-logo border">
                                <img src="{{$item->image ?? ''}}" alt="{{$item->image ?? ''}}">
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </section>
    </div>
@endsection
