<nav id="nav-scroll" class="nav nav-scroll d-flex d-md-none">
    <nav class="navbar navbar-expand-lg navbar-dark w-100 d-flex justify-content-between">
        <a class="navbar-brand" href="{{ route('get.home.index') }}">
            <img src="{{asset(!empty($logo) ? $logo : 'storage/upload/Home/logo-primary.svg')}}" class="logo"
                 alt="Logo">
        </a>
        <div class="d-flex">
            <div class="input-group d-flex d-md-none align-items-center me-2">
                @include('Base::frontend.header.user_icon')
                @include('Base::frontend.header.cart_icon')
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbar-scroll-content" aria-controls="navbar-scroll-content"
                    aria-expanded="false" aria-label="Toggle navigation">
                <img src="{{asset('storage/upload/Home/menu.svg')}}" alt="menu">
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end px-5 pb-5 pb-sm-0" id="navbar-scroll-content">
            @include('Base::frontend.header.menu')
        </div>
        <div class=" d-none d-md-block pe-5">
            @include('Base::frontend.header.cart_icon')
        </div>
    </nav>
</nav>
