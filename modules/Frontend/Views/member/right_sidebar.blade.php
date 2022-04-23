<div class="px-5 mt-5 mt-md-0">
    <h1 class="title-register">{{trans('Menu')}}</h1>
    <div class="list-group">
        <a href="{{ route('get.home.voucher') }}"
           class="list-group-item cl-text-blue d-flex justify-content-between align-items-center">
            {{ trans('My Vouchers') }}
            <i class="fas fa-arrow-right"></i>
        </a>
        <a href="{{ route('get.home.order') }}"
           class="list-group-item cl-text-blue d-flex justify-content-between align-items-center">
            {{ trans('My Orders') }}
            <i class="fas fa-arrow-right"></i>
        </a>
        <a href="{{ route('get.home.logout') }}" class="list-group-item cl-text-blue">
            {{ trans('Log Out') }}
        </a>
    </div>
</div>
