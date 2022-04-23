<div id="customer-reviews" class="container customer-reviews my-5">
    <div class="title">
        <h1 class="cl-text-blue">{{trans('Customer reviews')}}</h1>
    </div>
    <div class="vote-star-section row">
        <div class="col-md-6">
            <div class="row-star d-md-flex">
                <div class="col-default">
                    <div class="vote-star">
                        {!! getStar($data->vote ?? 0, 'frontend-feedback-color') !!}
                    </div>
                    <div class="text">{{trans('Base on')." ".count($data->feedback)." ".trans('reviews')}} </div>
                </div>
                <div class="col-vote">
                    <div class="star-vote-group">
                        <div class="vote-star p-0">
                            {!! getStar(5) !!}
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar"
                                 style="width: {{ $data->getPercentStar(5) }}"
                                 aria-valuenow="{{ $data->getPercentStar(5, false) }}" aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                        <div class="count">
                            <span class="vote-ratio">{{ $data->getPercentStar(5) }}</span>
                            <span class="vote-quantity">({{ $data->feedback->where('vote', 5)->count() }})</span>
                        </div>
                    </div>
                    <div class="star-vote-group">
                        <div class="vote-star p-0">
                            {!! getStar(4) !!}
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar"
                                 style="width: {{ $data->getPercentStar(4) }}"
                                 aria-valuenow="{{ $data->getPercentStar(4, false) }}" aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                        <div class="count">
                            <span class="vote-ratio">{{ $data->getPercentStar(4) }}</span>
                            <span class="vote-quantity">({{ $data->feedback->where('vote', 4)->count() }})</span>
                        </div>
                    </div>
                    <div class="star-vote-group">
                        <div class="vote-star p-0">
                            {!! getStar(3) !!}
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar"
                                 style="width: {{ $data->getPercentStar(3) }}"
                                 aria-valuenow="{{ $data->getPercentStar(3, true) }}" aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                        <div class="count">
                            <span class="vote-ratio">{{ $data->getPercentStar(3) }}</span>
                            <span class="vote-quantity">({{ $data->feedback->where('vote', 3)->count() }})</span>
                        </div>
                    </div>
                    <div class="star-vote-group">
                        <div class="vote-star p-0">
                            {!! getStar(2) !!}
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar"
                                 style="width: {{ $data->getPercentStar(2) }}"
                                 aria-valuenow="{{ $data->getPercentStar(2, true) }}" aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                        <div class="count">
                            <span class="vote-ratio">{{ $data->getPercentStar(2) }}</span>
                            <span class="vote-quantity">({{ $data->feedback->where('vote', 2)->count() }})</span>
                        </div>
                    </div>
                    <div class="star-vote-group">
                        <div class="vote-star p-0">
                            {!! getStar(1) !!}
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar"
                                 style="width: {{ $data->getPercentStar(1) }}"
                                 aria-valuenow="{{ $data->getPercentStar(1, true) }}" aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                        <div class="count">
                            <span class="vote-ratio">{{ $data->getPercentStar(1) }}</span>
                            <span class="vote-quantity">({{ $data->feedback->where('vote', 1)->count() }})</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <a href="{{ route('get.product.feedback', $data->key_slug) }}"
                   class="btn btn-outline-main-light btn-write-review" data-bs-toggle="modal"
                   data-bs-target="#feedback-modal">{{trans('WRITE A REVIEW')}}</a>
            </div>
        </div>
    </div>
    <div class="sort-order-group">
        {!! Form::select('feedback_filter', $feedback_filter, request()->feedback_filter ?? NULL, [
                'id' => 'feedback_filter',
                'class' => 'select2 form-control']) !!}
    </div>
    <hr>
    <div id="feedback">
        <div id="feedback-list" class="feedback-list feedback-list-has-image ajax-listing row">
            @foreach($feedback as $item)
                <div class="col-md-4">
                    <div class="feedback-item card">
                        @if(!empty($item->image))
                            <img src="{{asset($item->image)}}" class="card-img-top"
                                 alt="{{$item->image}}">
                        @endif
                        <div class="card-body">
                            <div class="card-info mb-5">
                                <h6 class="fw-bold m-0">{{($item->member->name ?? '') . ' ' . ($item->member->last_name ?? '')}}</h6>
                                <div
                                    class="date">{{formatDate(strtotime($item->updated_at ?? ''),'d/m/Y')}}</div>
                                <div class="vote-star vote-default p-0">

                                    {!! getStar($item->vote, 'frontend-feedback-color') !!} {{-- Don't use default color --}}
                                </div>
                            </div>
                            <div class="card-text">
                                <?= $item->content ?? '' ?>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center ajax-paginate" id="paginate-feedback" data-listing-id="feedback-list">
            {{ $feedback->withQueryString()->links('vendor.pagination.frontend') }}
        </div>
    </div>

    <div class="modal modal-home modal-ajax border-0" id="feedback-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content modal-row">
                <div class="modal-body p-0">
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {
            var listing = "#feedback_filter";
            $(document).on('change', listing, function (e) {
                var url = "{{ route('get.product.productDetail', $data->key_slug) }}" + "?feedback_filter=" + $(this).val();
                $.ajax({
                    url: url,
                    type: 'GET'
                }).done(function (response) {
                    $("#feedback").html($(response).find("#feedback").html());
                });
            });
        });
    </script>
@endpush
