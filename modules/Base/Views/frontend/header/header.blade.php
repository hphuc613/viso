<header class="bg-white">
    @include('Base::frontend.header.top_bar')

    <div id="logo" class="container-xxl text-start text-lg-center">
        <a href="{{ route('get.home.index') }}" class="d-inline-block col-3 col-md-2 col-lg-2 mt-2 mb-lg-4">
            <img class="d-block col-12 mx-auto" src="{{ asset('images/nav_logo.png') }}" alt="">
        </a>
    </div>

    <!-- Shop quick link -->
    <div id="navFeatureShop" class="bg-00a9e0 py-2">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

                <div class="dropdown col-12">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="navQuickLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        精選商店
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="navQuickLink">
                        <li><a class="dropdown-item current" href="categories.html">VISO MALL</a></li>
                        <li><a class="dropdown-item" href="categories.html">超級市場</a></li>
                        <li><a class="dropdown-item" href="categories.html">士多A</a></li>
                        <li><a class="dropdown-item" href="categories.html">士多B</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <!-- dropdown menu, search bar, login -->
    <div class="bg-3A5057">
        <div class="container-fluid px-xl-4">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-between py-3">
                @include('Base::frontend.header.menu')
                @include('Base::frontend.header.task_menu')

                <form id="nav-search" class="nav col-12 col-xs-12">
                    <div class="col-12 col-md-4 mx-auto pt-3 pt-md-0">
                        <div class="input-group">
                            <input type="search" class="form-control border-end-0 border" placeholder="{{ trans('Search for products') }}">
                            <button type="button" class="input-group-text btn bg-white">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</header>

