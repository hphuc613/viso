<div class="col-md-4 text-end nowrap">
    @if(auth('web')->check())
        <a href="{{ route('get.home.profile') }}" type="button" class="btn nav-member text-white p-1 p-sm-2">
            {{ trans('My Account') }}
        </a>
        <a href="{{ route('get.home.logout') }}" type="button" class="btn nav-member text-white p-1 p-sm-2">
            {{ trans('Logout') }}
        </a>
    @else
        <a href="{{ route('get.home.login_page') }}" type="button" class="btn nav-member text-white p-1 p-sm-2">
            {{ trans('Login') }}/{{ trans('Register') }}
        </a>
    @endif
    <button type="button" class="btn nav-member text-white btn-cart" data-bs-toggle="modal"
            data-bs-target="#cartModal">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
             style="display:block;position:relative;height:100%;width:100%;left:0;top:0;"
             fill="currentColor"
             preserveAspectRatio="xMidYMid meet" viewBox="0 0 22.5 20"
             style="enable-background:new 0 0 22.5 20;"
             xml:space="preserve">
                <path d="M20.6,11.8l1.8-8.1c0.1-0.5-0.2-1-0.7-1.1c-0.1,0-0.1,0-0.2,0H6.2L5.9,0.8
                    C5.8,0.3,5.4,0,4.9,0h-4C0.4,0,0,0.4,0,0.9c0,0,0,0,0,0v0.6c0,0.5,0.4,0.9,0.9,0.9c0,0,0,0,0,0h2.7l2.7,13.4c-1,0.6-1.4,1.9-0.8,3
                    c0.6,1,1.9,1.4,3,0.8c1-0.6,1.4-1.9,0.8-3c-0.1-0.2-0.2-0.3-0.4-0.5h8.2c-0.9,0.8-0.9,2.2,0,3.1c0.8,0.9,2.2,0.9,3.1,0
                    c0.9-0.8,0.9-2.2,0-3.1c-0.2-0.2-0.4-0.3-0.6-0.4l0.2-0.9c0.1-0.5-0.2-1-0.7-1.1c-0.1,0-0.1,0-0.2,0H8.5l-0.3-1.3h11.5
                    C20.2,12.5,20.5,12.2,20.6,11.8z"/>
              </svg>
    </button>
</div>
