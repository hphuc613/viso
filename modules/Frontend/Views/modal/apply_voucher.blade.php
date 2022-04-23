<div class="card apply-voucher-modal" id="apply-voucher-modal">
    <div class="card-header d-flex justify-content-between align-items-start">
        <h5 class="cl-text-blue">Voucher</h5>
        <div class="close-modal p-0">
            <a href="javascript:" class="d-flex align-items-end" data-bs-dismiss="modal">
                <i class="bi-x"></i>
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(auth('web')->check())
            <div class="input-group mb-3">
                <input class="form-control rounded-0" placeholder=" {{ trans('Gift card or discount code') }}">
                <button class="btn btn-main w-25">{{trans('Search')}}</button>
            </div>
            <hr>
            <div class="voucher-list">
                @foreach($data as $item)
                    <div class="w-100 bg-transparent voucher-item border mb-2 d-flex">
                        <div class="w-25 logo">
                            <img src="{{asset(!empty($logo) ? $logo : 'storage/upload/Home/logodâc.svg')}}"
                                 alt="{{asset(!empty($logo) ? $logo : 'storage/upload/Home/logodâc.svg')}}">
                        </div>
                        <div class="w-50 content">
                            <h5 class="title">{{ trans('Sale off'). ' ' . (($item->voucher->value ?? '') . (\Modules\Voucher\Models\Voucher::getType($item->voucher->type ?? ''))) }}</h5>
                            <div class="description">
                                {{ $item->voucher->name ?? '' }}
                                @if(!empty($item->voucher->expiration_date))
                                    <div class="exp_date">{{ trans('To day') }}
                                        : {{ formatDate($item->voucher->expiration_date) }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="w-25 button-group p-1 d-flex align-items-center">
                            <div class="w-100">
                                <button data-voucher="{{ $item->id }}" data-bs-dismiss="modal"
                                        class="btn btn-outline-main btn-apply-voucher w-100 mb-2">
                                    {{ trans('Apply') }}
                                </button>
                                <a href="{{ route('get.home.voucherDetail',$item->voucher->key_slug ?? '') }}"
                                   target="_blank" class="btn btn-warning text-white rounded-0 w-100">
                                    {{ trans('Detail') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center">
                <div class="mb-5">
                    <h4 class="cl-text-blue">{{ trans('Please register to get more vouchers!') }}</h4>
                </div>
                <a href="{{ route('get.home.register') }}" class="btn btn-main px-4 py-2 mb-3">{{trans('建立帳戶')}}</a>
                <div class="cl-text-blue p-0">
                    {{trans('己有帳戶?')}}
                    <a href="{{ route('get.home.login') }}" data-bs-dismiss="modal" data-bs-toggle="modal"
                       data-bs-target="#form-modal"
                       class="btn cl-text-primary p-0">
                        {{trans('立即登入')}}
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
