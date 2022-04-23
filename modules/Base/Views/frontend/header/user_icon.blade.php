@if(!auth('web')->check())
    <a href="{{ route('get.home.login') }}" data-bs-toggle="modal"
       data-bs-target="#form-modal"
       class="me-2">
        <img class="user-icon" src="{{ asset('storage/upload/Home/user.svg') }}" alt="Icon user">
    </a>
@else
    <div class="dropdown user-dropdown">
        <a href="javascript:" id="user-dropdown-content" class="me-2" data-bs-toggle="dropdown">
            <img class="user-icon" src="{{ asset('storage/upload/Home/user.svg') }}" alt="Icon user">
        </a>
        <ul class="dropdown-menu border-0 shadow-036 rounded-0" aria-labelledby="user-dropdown-content">
            <li class="dropdown-item"><a href="{{ route('get.home.profile') }}">{{ trans('Profile') }}</a></li>
            <li class="dropdown-item dropdown dropdown-hover">
                <a href="javascript:" class="dropdown-toggle language-setting" id="user-dropdown-language" data-bs-toggle="dropdown">
                    {{ trans('Languages') }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="user-dropdown-language">
                    @php($is_tw = session()->get('locale') === 'tw')
                    <li class="dropdown-item">
                        <a @if($is_tw) class="text-success" @endif href="{{ route('change_locale','tw') }}">
                            @if($is_tw) <i class="fas fa-check"></i> @endif
                            {{ trans('Chinese') }}(Traditional)
                        </a>
                    </li>
                    {{--@php($is_cn = session()->get('locale') === 'cn')
                    <li class="dropdown-item">
                        <a @if($is_cn) class="text-success" @endif href="{{ route('change_locale','cn') }}">
                            @if($is_cn) <i class="fas fa-check"></i> @endif
                            {{ trans('Chinese') }}(Simplify)
                        </a>
                    </li>--}}
                    @php($is_eng = session()->get('locale') === 'en')
                    <li class="dropdown-item">
                        <a @if($is_eng) class="text-success" @endif href="{{ route('change_locale','en') }}">
                            @if($is_eng) <i class="fas fa-check"></i> @endif
                            English(US)
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown-item"><a href="{{ route('get.home.voucher') }}">{{ trans('My Voucher') }}</a></li>
            <li class="dropdown-item"><a href="{{ route('get.home.order') }}">{{ trans('My Order') }}</a></li>
            <li class="dropdown-item"><a href="{{ route('get.home.logout') }}">{{ trans('Logout') }}</a></li>
        </ul>
    </div>
@endif

