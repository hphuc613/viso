<div class="modal-group">
    <!-- Cart -->
    <div id="cart-box"></div>
    <!-- Modal ajax frame -->
    <div class="modal modal-home modal-ajax border-0" id="form-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content modal-row">
                <div class="modal-body p-0">
                    {{-- Content--}}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal ajax size-small frame -->
    <div class="modal modal-home modal-ajax border-0" id="form-modal-normal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-body p-0">
                    {{-- Content--}}
                </div>
            </div>
        </div>
    </div>
    <!--Modal Register Email-->
    <div class="modal modal-register-email modal-home border-0" id="modal-register-email" tabindex="-1"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content modal-row">
                <div class="modal-body p-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <img class="modal-image d-none d-sm-block w-100"
                                 src="{{ asset('storage/upload/Home/regist_email.svg') }}"
                                 alt="Modal Register Email">
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="h-100">
                                <div class="close-modal">
                                    <a href="javascript:" class="d-flex align-items-end" data-bs-dismiss="modal">
                                        <i class="bi-x"></i>{{trans('關閉')}}
                                    </a>
                                </div>
                                <div class="form text-center">
                                    <h3 class="fw-bold title">{{trans('HELLO!')}}</h3>
                                    <div class="description">
                                        {{trans('新⽤⼾登記EMAIL將會收到9折優惠碼亦誠邀')}}
                                        <a href="#"
                                           class="cl-text-primary">{{trans('加入FB群組!')}}</a> {{trans('睇更多⽤家分享')}}
                                    </div>
                                    <form action="{{route('post.home.registerEmail')}}" method="POST" class="mb-5"
                                          id="voucher-form">
                                        @csrf
                                        <div class="input-group">
                                            <input type="email" class="form-control rounded-0" placeholder="登記你的電郵地址"
                                                   aria-describedby="basic-addon2" name="email" required>
                                            <button type="submit" class="btn" id="basic-addon2">{{trans('提交')}}</button>
                                        </div>
                                        <div class="form-group text-start">
                                            <label class="checkmark-group">{{trans('想收取更多驚喜資訊！')}}
                                                <input type="checkbox" id="check-register-email" class="me-2">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </form>
                                    <div class="d-flex justify-content-center">
                                        <div class="d-flex justify-content-between w-25">
                                            <a href="#"><img src="{{ asset('storage/upload/Home/icon-fb-light.svg') }}"
                                                             alt=""></a>
                                            <a href="#"><img src="{{ asset('storage/upload/Home/icon-ins-light.svg') }}"
                                                             alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Limit Purchase Offer -->
    <div class="modal modal-purchase-offer-limit border-0" id="modal-purchase-offer-limit"
         tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content modal-row">
                <div class="modal-body p-0">
                    <div class="close-modal">
                        <a href="javascript:" class="d-flex align-items-end" data-bs-dismiss="modal">
                            <i class="bi-x"></i>
                        </a>
                    </div>
                    <div class="title text-center mb-3">
                        <h5 class="fw-bold cl-text-blue">{{trans('限時加購優惠')}}</h5>
                    </div>
                    <div class="date-end">
                        <h4 class="fw-bold">{{trans('限時優惠快將完結:')}} <span
                                class="remain-time fw-bold text-danger">10:40</span></h4>
                    </div>
                    <div class="container content px-md-5">
                        <div class="product-info border-bottom">
                            <div class="flex-shrink-0 image">
                                <img src="{{ asset('storage/upload/Home/home_lavender_oil.svg') }}"
                                     alt="{{ asset('storage/upload/Home/home_lavender_oil.svg') }}">
                            </div>
                            <div class="flex-grow-2 info px-md-5">
                                <div class="title m-0">
                                    <h5 class="fw-bold">{{trans('瑰麗亮肌煥彩護療霜 NOURISHING ROSANNA RENEWED TREATMENT')}}</h5>
                                </div>
                                <div class="price-group d-flex align-items-center">
                                    <div class="price">
                                        $000.0
                                    </div>
                                    <div class="discount-price">
                                        $000.0
                                    </div>
                                    <div class="discount text-success">
                                        (15%OFF)
                                    </div>
                                </div>
                                <div class="description">
                                    {{trans('坊間玫瑰乳霜大多為白色，若將玫瑰籽油去除顏色和氣味
                                    ，則大大減低營養價值。本產採用的玫瑰籽油保留了原有色澤，所以調製出來的乳霜偏黃，但絕對不令皮膚變黃，使用後反能提亮膚色。')}}
                                </div>
                            </div>
                            <div class="flex-grow-1 d-flex align-items-center">
                                <button class="btn btn-main btn-add-to-cart rounded w-100" data-product="">
                                    {{trans('加入購物車')}}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="container button-group p-md-5">
                        <button class="btn btn-outline-main">{{trans('不需要此優惠')}}</button>
                        <button class="btn btn-main">{{trans('付款')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
