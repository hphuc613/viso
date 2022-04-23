<nav class="py-2">
    <div class="container d-flex flex-wrap">

        <ul class="nav me-auto">
            <li class="d-flex">
                <div class="dropdown" id="lang-dd">
                    <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown">
                        {{ trans('Language') }}
                    </button>
                    <ul class="dropdown-menu">
                        @php($is_tw = session()->get('locale') === 'tw')
                        <li>
                            <a class="dropdown-item @if($is_tw) text-success @endif" href="{{ route('change_locale','tw') }}">
                                @if($is_tw) <i class="fas fa-check"></i> @endif
                                {{ trans('Chinese') }}(Traditional)
                            </a>
                        </li>
                        @php($is_eng = session()->get('locale') === 'en')
                        <li>
                            <a class="dropdown-item @if($is_eng) text-success @endif" href="{{ route('change_locale','en') }}">
                                @if($is_eng) <i class="fas fa-check"></i> @endif
                                English(US)
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

        <ul class="nav">
            <li class="nav-item"><a href="faq.html" class="nav-link link-dark px-1 px-sm-2">常見問題</a></li>
            <li class="nav-item"><a href="categories.html" class="nav-link link-dark px-1 px-sm-2">商店分類</a></li>
            <!-- <li class="nav-item"><a href="#" class="nav-link link-dark px-1 px-sm-2">商戶加盟</a></li> -->
        </ul>
    </div>
</nav>
