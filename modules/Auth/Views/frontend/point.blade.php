<!--Modal point-->
<div class="modal-point">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 ps-0">
                <img src="{{ asset('storage/upload/Home/modal-point.svg') }}" class="modal-image d-none d-sm-block"
                     alt="">
            </div>
            <div class="col-lg-6 col-12">
                <div class="close-modal">
                    <a href="javascript:" class="d-flex align-items-end" data-bs-dismiss="modal">
                        <i class="bi-x"></i>{{trans('關閉')}}
                    </a>
                </div>
                <div class="point">
                    <div class="py-4">
                        <a href="index.html">
                            <img src="{{asset(!empty($logo) ? $logo : 'storage/upload/Home/logo-primary.svg')}}"
                                 class="logo" height="50px" alt="Logo">
                        </a>
                    </div>
                    <div class="title-point">{{trans('申請賬戶後即可參與獨家獎勵！')}}</div>
                    <div class="tab mb-4">
                        <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link w-100 active" id="reward-tab"
                                        data-bs-toggle="pill"
                                        data-bs-target="#reward" type="button" role="tab"
                                        aria-controls="reward" aria-selected="true">{{trans('獎賞')}}
                                </button>
                            </li>
                            @if(!empty($member))
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link w-100" id="point-tab" data-bs-toggle="pill"
                                            data-bs-target="#point" type="button" role="tab"
                                            aria-controls="point" aria-selected="false">{{trans('儲積分')}}
                                    </button>
                                </li>
                            @endif

                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="reward" role="tabpanel"
                                 aria-labelledby="reward-tab">
                                <div class="point-table">
                                    @if(!empty($hot_voucher))
                                        <table class="w-100">
                                            @foreach($hot_voucher as $item)
                                                <tr>
                                                    <td><img class="img-point"
                                                             src="{{ asset('storage/upload/Home/surprise.svg') }}"
                                                             alt="Icon reward"></td>
                                                    <td class="text-name">
                                                        {{trans('獎賞')}}
                                                    </td>
                                                    <td class="text-point">{{ $item->point_redeem == 0 ? trans('Free') : $item->point_redeem.' '. trans('Points') }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <div class="text-center mt-5">{{trans('No Voucher Yet')}}</div>
                                    @endif
                                </div>
                            </div>
                            @if(!empty($member))
                                <div class="tab-pane fade accumulate-points" id="point" role="tabpanel"
                                     aria-labelledby="point-tab">
                                    <div class="point-table">
                                        @if(!empty($voucher))
                                            <table class="w-100">
                                                @foreach($voucher as $item)
                                                    <tr>
                                                        <td class="text-name">{{trans('積分')}}</td>
                                                        <td class="text-point">{{ !empty($item->voucher) ? $item->voucher->point_redeem == 0 ? trans('Free') : $item->voucher->point_redeem.' '. trans('Points') : trans('Free') }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @else
                                            <div class="text-center mt-5">{{trans('No Voucher Yet')}}</div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if(empty($member))
                        <a class="btn btn-main px-4 py-2 mb-3"
                           href="{{route('get.home.register')}}">{{trans('建立帳戶')}}</a>
                        <div class="cl-text-blue p-0">
                            {{trans('己有帳戶?')}}
                            <a href="{{ route('get.home.login') }}" data-bs-toggle="modal" data-bs-target="#form-modal"
                               class="btn cl-text-primary p-0">
                                {{trans('立即登入')}}
                            </a>
                        </div>
                    @else
                        <a class="btn btn-main px-4 py-2 mb-3 mt-5" href="{{route('get.home.voucher')}}">
                            {{trans('My Voucher')}}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
