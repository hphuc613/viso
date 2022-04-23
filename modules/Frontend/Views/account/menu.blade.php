<div class="dropdown col-md-3">
    <button class="btn btn-secondary dropdown-toggle col-12" type="button" id="accSidebar"
            data-bs-toggle="dropdown" aria-expanded="false">{{ trans('Menu') }}</button>
    <div class="dropdown-menu" aria-labelledby="accSidebar">
        <a class="list-group-item list-group-item-action @if(segmentUrl(1) === '/') active @endif"
           href="{{ route('get.home.profile') }}">{{ trans('Profile') }}</a>
        <a class="list-group-item list-group-item-action @if(segmentUrl(1) === 'delivery-address') active @endif"
           href="{{ route('get.home.delivery_address') }}">{{ trans('Shipping Address') }}</a>
        <a class="list-group-item list-group-item-action @if(segmentUrl(1) === '/') active @endif" href="myhistory.html">訂單紀錄</a>
        <a class="list-group-item list-group-item-action @if(segmentUrl(1) === '/') active @endif" href="myfavourite.html">我的收藏</a>
        <a class="list-group-item list-group-item-action @if(segmentUrl(1) === '/') active @endif" href="index.html">登出</a>
    </div>
</div>
