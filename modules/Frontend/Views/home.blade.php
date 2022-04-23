@extends("Base::frontend.master")

@section("content")
    <div id="home">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-item-p" style="background-image: url('images/index_banner_p1.jpg')"></div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-item-p" style="background-image: url('images/index_banner_p1.jpg')"></div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-item-p" style="background-image: url('images/index_banner_p1.jpg')"></div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Best sale -->
        <section class="bg-00a9e0 p-2 p-sm-3 p-md-4 p-lg-5">
            <div class="row">
                <h4 class="globe_title pb-0 pb-md-4 text-white">熱賣之選</h4>
            </div>

            <div class="container-xxl bg-white p-0 py-4 p-md-3 rounded">
                <div class="row py-0 py-md-3 d-flex align-items-md-start align-items-lg-center">

                    <div class="col-12 col-md-6 col-lg-4 px-md-0 px-3">
                        <div class="container-xxl text-center">
                            <img src="images/top1.svg" class="col-5 col-sm-6 px-sm-5 col-md-8 col-lg-9 mx-auto">

                            <span class="pd-listing-each d-inline-block text-center col-10 col-sm-6 col-md-12 col-lg-12 col-xl-9 my-2 border border-5 top1">
              <div class="d-flex flex-column-reverse overflow-hidden">
                <a href="product_details.html" class="text-decoration-none">
                  <ul class="list-unstyled text-center py-3">
                    <li id="pd-listing-name">可口可樂 (罐裝)</li>
                    <li id="pd-capacity">330 ml</li>
                    <li id="pd-price" class="mt-2">HKD $4.00</li>
                  </ul>
                </a>
                <div class="pd-p" style="background-image:url('images/dummy_pd_p3.png')">
                  <div class="pd-p-inner flex-column">
                    <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                    <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                  </div>
                </div>
              </div>
              <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap mb-4">&nbsp; 加入購物車</button>
            </span>
                        </div>
                    </div>

                    <div id="bestSale-listing" class="col-12 col-md-6 col-lg-8">
                        <div class="container-xxl">

                            <div class="row row-cols-2 g-2 row-cols-sm-3 g-sm-3 row-cols-md-2 g-md-3 row-cols-lg-4 g-lg-2 row-cols-xl-4 g-xl-3 my-4">

              <span class="col pd-listing-each text-center my-4 h-100">
                <img src="images/top2.svg" class="col-8 mx-auto">

                <div class="d-flex flex-column-reverse overflow-hidden">
                  <a href="product_details.html" class="text-decoration-none">
                    <ul class="list-unstyled text-center py-3">
                      <li id="pd-listing-name">UCC - [香港官方行貨]<br> UCC ORIGIN BLACK藍山莫卡咖啡 x 12</li>
                      <li id="pd-capacity">330 ml</li>
                      <li id="pd-price" class="mt-2">HKD $4.00</li>
                    </ul>
                  </a>
                  <div class="pd-p" style="background-image:url('images/dummy_pd_p4.png')">
                    <div class="pd-p-inner flex-column">
                      <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                      <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                    </div>
                  </div>
                </div>

                <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
              </span>

                                <span class="col pd-listing-each text-center my-4 h-100">
                <img src="images/top3.svg" class="col-8 mx-auto">
                <div class="d-flex flex-column-reverse overflow-hidden">
                  <a href="product_details.html" class="text-decoration-none">
                    <ul class="list-unstyled text-center py-3">
                      <li id="pd-listing-name">可口可樂 (罐裝)</li>
                      <li id="pd-capacity">330 ml</li>
                      <li id="pd-price" class="mt-2">HKD $4.00</li>
                    </ul>
                  </a>
                  <div class="pd-p" style="background-image:url('images/dummy_pd_p4.png')">
                    <div class="pd-p-inner flex-column">
                      <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                      <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
              </span>

                                <span class="col pd-listing-each text-center my-4">
                <img src="images/top4.svg" class="col-8 mx-auto">
                <div class="d-flex flex-column-reverse overflow-hidden">
                  <a href="product_details.html" class="text-decoration-none">
                    <ul class="list-unstyled text-center py-3">
                      <li id="pd-listing-name">可口可樂 (罐裝)</li>
                      <li id="pd-capacity">330 ml</li>
                      <li id="pd-price" class="mt-2">HKD $4.00</li>
                    </ul>
                  </a>
                  <div class="pd-p" style="background-image:url('images/dummy_pd_p4.png')">
                    <div class="pd-p-inner flex-column">
                      <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                      <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
              </span>

                                <span class="col pd-listing-each text-center my-4">
                <img src="images/top5.svg" class="col-8 mx-auto">
                  <div class="d-flex flex-column-reverse overflow-hidden">
                  <a href="product_details.html" class="text-decoration-none">
                    <ul class="list-unstyled text-center py-3">
                      <li id="pd-listing-name">可口可樂 (罐裝)</li>
                      <li id="pd-capacity">330 ml</li>
                      <li id="pd-price" class="mt-2">HKD $4.00</li>
                    </ul>
                  </a>
                  <div class="pd-p" style="background-image:url('images/dummy_pd_p4.png')">
                    <div class="pd-p-inner flex-column">
                      <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                      <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
              </span>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </section>
        <!-- end of Best sale -->

        <!-- cheapest products -->
        <div class="bg-ccdae0 p-2 p-sm-3 p-md-4 p-lg-5">

            <div class="row">
                <h4 class="globe_title pb-0 pb-md-4 text-dark">最抵之選</h4>
            </div>

            <div class="container-xxl bg-white p-0 py-5 p-xl-3 rounded">
                <div class="row py-0 py-md-3 d-flex align-items-center flex-column flex-md-row ">

                    <div class="col col-md-4 col-lg-4 col-xl-4 px-3">
                        <div class="container text-center ms-auto ms-md-4">
                            <div class="text-fire text-center text-lg-left">
                                <img src="images/fire_icon.svg" class="d-inline-block align-middle">
                                <h6 class="d-inline-block align-middle">本週最抵</h6>
                            </div>
                            <span class="pd-listing-each d-inline-block text-center col-6 col-md-12 col-lg-10 col-xl-9 my-4">

              <div class="d-flex flex-column-reverse overflow-hidden">
                <a href="product_details.html" class="text-decoration-none">
                  <ul class="list-unstyled text-center py-3">
                    <li id="pd-listing-name">可口可樂 (罐裝)</li>
                    <li id="pd-capacity">330 ml</li>
                    <li id="pd-price" class="mt-2">HKD $4.00</li>
                  </ul>
                </a>
                <div class="pd-p" style="background-image:url('images/dummy_pd_p2.png')">
                  <div class="pd-p-inner flex-column">
                    <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                    <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                  </div>
                </div>
              </div>

              <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
            </span>
                        </div>
                    </div>

                    <div id="cheapestProduct-listing" class="col col-md-8 col-lg-8 col-xl-8">
                        <div class="container-xxl">
                            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

              <span class="col col-sm-4 pd-listing-each text-center my-4">

                <div class="d-flex flex-column-reverse overflow-hidden">
                  <a href="product_details.html" class="text-decoration-none">
                    <ul class="list-unstyled text-center py-3">
                      <li id="pd-listing-name">可口可樂 (罐裝)</li>
                      <li id="pd-capacity">330 ml</li>
                      <li id="pd-price" class="mt-2">HKD $4.00</li>
                    </ul>
                  </a>
                  <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
                    <div class="pd-p-inner flex-column">
                      <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                      <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                    </div>
                  </div>
                </div>

                <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
              </span>

                                <span class="col col-sm-4 pd-listing-each text-center my-4">
                <div class="d-flex flex-column-reverse overflow-hidden">
                  <a href="product_details.html" class="text-decoration-none">
                    <ul class="list-unstyled text-center py-3">
                      <li id="pd-listing-name">可口可樂 (罐裝)</li>
                      <li id="pd-capacity">330 ml</li>
                      <li id="pd-price" class="mt-2">HKD $4.00</li>
                    </ul>
                  </a>
                  <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
                    <div class="pd-p-inner flex-column">
                      <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                      <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
              </span>

                                <span class="col col-sm-4 pd-listing-each text-center my-4">
                <div class="d-flex flex-column-reverse overflow-hidden">
                  <a href="product_details.html" class="text-decoration-none">
                    <ul class="list-unstyled text-center py-3">
                      <li id="pd-listing-name">可口可樂 (罐裝)</li>
                      <li id="pd-capacity">330 ml</li>
                      <li id="pd-price" class="mt-2">HKD $4.00</li>
                    </ul>
                  </a>
                  <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
                    <div class="pd-p-inner flex-column">
                      <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                      <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
              </span>

                                <span class="col col-sm-4 pd-listing-each text-center my-4">
                <div class="d-flex flex-column-reverse overflow-hidden">
                  <a href="product_details.html" class="text-decoration-none">
                    <ul class="list-unstyled text-center py-3">
                      <li id="pd-listing-name">可口可樂 (罐裝)</li>
                      <li id="pd-capacity">330 ml</li>
                      <li id="pd-price" class="mt-2">HKD $4.00</li>
                    </ul>
                  </a>
                  <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
                    <div class="pd-p-inner flex-column">
                      <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                      <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
              </span>

                                <span class="col col-sm-4 pd-listing-each text-center my-4">
                <div class="d-flex flex-column-reverse overflow-hidden">
                  <a href="product_details.html" class="text-decoration-none">
                    <ul class="list-unstyled text-center py-3">
                      <li id="pd-listing-name">可口可樂 (罐裝)</li>
                      <li id="pd-capacity">330 ml</li>
                      <li id="pd-price" class="mt-2">HKD $4.00</li>
                    </ul>
                  </a>
                  <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
                    <div class="pd-p-inner flex-column">
                      <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                      <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
              </span>

                                <span class="col col-sm-4 pd-listing-each text-center my-4">
                <div class="d-flex flex-column-reverse overflow-hidden">
                  <a href="product_details.html" class="text-decoration-none">
                    <ul class="list-unstyled text-center py-3">
                      <li id="pd-listing-name">可口可樂 (罐裝)</li>
                      <li id="pd-capacity">330 ml</li>
                      <li id="pd-price" class="mt-2">HKD $4.00</li>
                    </ul>
                  </a>
                  <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
                    <div class="pd-p-inner flex-column">
                      <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                      <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
              </span>

                                <span class="col col-sm-4 pd-listing-each text-center my-4">
                <div class="d-flex flex-column-reverse overflow-hidden">
                  <a href="product_details.html" class="text-decoration-none">
                    <ul class="list-unstyled text-center py-3">
                      <li id="pd-listing-name">可口可樂 (罐裝)</li>
                      <li id="pd-capacity">330 ml</li>
                      <li id="pd-price" class="mt-2">HKD $4.00</li>
                    </ul>
                  </a>
                  <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
                    <div class="pd-p-inner flex-column">
                      <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                      <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
              </span>

                                <span class="col col-sm-4 pd-listing-each text-center my-4">
                <div class="d-flex flex-column-reverse overflow-hidden">
                  <a href="product_details.html" class="text-decoration-none">
                    <ul class="list-unstyled text-center py-3">
                      <li id="pd-listing-name">可口可樂 (罐裝)</li>
                      <li id="pd-capacity">330 ml</li>
                      <li id="pd-price" class="mt-2">HKD $4.00</li>
                    </ul>
                  </a>
                  <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
                    <div class="pd-p-inner flex-column">
                      <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                      <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
              </span>

                                <span class="col col-sm-4 pd-listing-each text-center my-4">
                <div class="d-flex flex-column-reverse overflow-hidden">
                  <a href="product_details.html" class="text-decoration-none">
                    <ul class="list-unstyled text-center py-3">
                      <li id="pd-listing-name">可口可樂 (罐裝)</li>
                      <li id="pd-capacity">330 ml</li>
                      <li id="pd-price" class="mt-2">HKD $4.00</li>
                    </ul>
                  </a>
                  <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
                    <div class="pd-p-inner flex-column">
                      <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                      <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
              </span>

                                <span class="col col-sm-4 pd-listing-each text-center my-4">
                <div class="d-flex flex-column-reverse overflow-hidden">
                  <a href="product_details.html" class="text-decoration-none">
                    <ul class="list-unstyled text-center py-3">
                      <li id="pd-listing-name">可口可樂 (罐裝)</li>
                      <li id="pd-capacity">330 ml</li>
                      <li id="pd-price" class="mt-2">HKD $4.00</li>
                    </ul>
                  </a>
                  <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
                    <div class="pd-p-inner flex-column">
                      <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                      <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
              </span>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="row py-4 my-4">
                    <a href="product_listing.html" class="btn btn-primary mx-auto col-6 col-sm-4 col-md-4 col-lg-2">查看全部商品</a>
                </div>
            </div>

        </div>
        <!-- end of cheapest products -->

        <!-- latest products -->
        <div class="bg-ff9122 p-2 p-sm-3 p-md-4 p-lg-5">
            <div class="row">
                <h4 class="globe_title pb-0 pb-md-4">最新上架</h4>
            </div>

            <div id="latestProduct-listing" class="container-xxl bg-white p-3 rounded">
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 py-0 py-md-3">

        <span class="col pd-listing-each text-center my-4">

          <div class="d-flex flex-column-reverse overflow-hidden">
            <a href="product_details.html" class="text-decoration-none">
              <ul class="list-unstyled text-center py-3">
                <li id="pd-listing-name">可口可樂 (罐裝)</li>
                <li id="pd-capacity">330 ml</li>
                <li id="pd-price" class="mt-2">HKD $4.00</li>
              </ul>
            </a>
            <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
              <div class="pd-p-inner flex-column">
                <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
              </div>
            </div>
          </div>

          <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
        </span>

                    <span class="col pd-listing-each text-center my-4">
          <div class="d-flex flex-column-reverse overflow-hidden">
            <a href="product_details.html" class="text-decoration-none">
              <ul class="list-unstyled text-center py-3">
                <li id="pd-listing-name">可口可樂 (罐裝)</li>
                <li id="pd-capacity">330 ml</li>
                <li id="pd-price" class="mt-2">HKD $4.00</li>
              </ul>
            </a>
            <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
              <div class="pd-p-inner flex-column">
                <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
              </div>
            </div>
          </div>
          <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
        </span>

                    <span class="col pd-listing-each text-center my-4">
          <div class="d-flex flex-column-reverse overflow-hidden">
            <a href="product_details.html" class="text-decoration-none">
              <ul class="list-unstyled text-center py-3">
                <li id="pd-listing-name">可口可樂 (罐裝)</li>
                <li id="pd-capacity">330 ml</li>
                <li id="pd-price" class="mt-2">HKD $4.00</li>
              </ul>
            </a>
            <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
              <div class="pd-p-inner flex-column">
                <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
              </div>
            </div>
          </div>
          <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
        </span>

                    <span class="col pd-listing-each text-center my-4">
          <div class="d-flex flex-column-reverse overflow-hidden">
            <a href="product_details.html" class="text-decoration-none">
              <ul class="list-unstyled text-center py-3">
                <li id="pd-listing-name">可口可樂 (罐裝)</li>
                <li id="pd-capacity">330 ml</li>
                <li id="pd-price" class="mt-2">HKD $4.00</li>
              </ul>
            </a>
            <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
              <div class="pd-p-inner flex-column">
                <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
              </div>
            </div>
          </div>
          <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
        </span>

                    <span class="col pd-listing-each text-center my-4">
          <div class="d-flex flex-column-reverse overflow-hidden">
            <a href="product_details.html" class="text-decoration-none">
              <ul class="list-unstyled text-center py-3">
                <li id="pd-listing-name">可口可樂 (罐裝)</li>
                <li id="pd-capacity">330 ml</li>
                <li id="pd-price" class="mt-2">HKD $4.00</li>
              </ul>
            </a>
            <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
              <div class="pd-p-inner flex-column">
                <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
              </div>
            </div>
          </div>
          <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
        </span>

                    <span class="col pd-listing-each text-center my-4">
          <div class="d-flex flex-column-reverse overflow-hidden">
            <a href="product_details.html" class="text-decoration-none">
              <ul class="list-unstyled text-center py-3">
                <li id="pd-listing-name">可口可樂 (罐裝)</li>
                <li id="pd-capacity">330 ml</li>
                <li id="pd-price" class="mt-2">HKD $4.00</li>
              </ul>
            </a>
            <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
              <div class="pd-p-inner flex-column">
                <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
              </div>
            </div>
          </div>
          <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
        </span>

                    <span class="col pd-listing-each text-center my-4">
          <div class="d-flex flex-column-reverse overflow-hidden">
            <a href="product_details.html" class="text-decoration-none">
              <ul class="list-unstyled text-center py-3">
                <li id="pd-listing-name">可口可樂 (罐裝)</li>
                <li id="pd-capacity">330 ml</li>
                <li id="pd-price" class="mt-2">HKD $4.00</li>
              </ul>
            </a>
            <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
              <div class="pd-p-inner flex-column">
                <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
              </div>
            </div>
          </div>
          <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
        </span>

                    <span class="col pd-listing-each text-center my-4">
          <div class="d-flex flex-column-reverse overflow-hidden">
            <a href="product_details.html" class="text-decoration-none">
              <ul class="list-unstyled text-center py-3">
                <li id="pd-listing-name">可口可樂 (罐裝)</li>
                <li id="pd-capacity">330 ml</li>
                <li id="pd-price" class="mt-2">HKD $4.00</li>
              </ul>
            </a>
            <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
              <div class="pd-p-inner flex-column">
                <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
              </div>
            </div>
          </div>
          <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
        </span>

                    <span class="col pd-listing-each text-center my-4">
          <div class="d-flex flex-column-reverse overflow-hidden">
            <a href="product_details.html" class="text-decoration-none">
              <ul class="list-unstyled text-center py-3">
                <li id="pd-listing-name">可口可樂 (罐裝)</li>
                <li id="pd-capacity">330 ml</li>
                <li id="pd-price" class="mt-2">HKD $4.00</li>
              </ul>
            </a>
            <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
              <div class="pd-p-inner flex-column">
                <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
              </div>
            </div>
          </div>
          <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
        </span>

                    <span class="col pd-listing-each text-center my-4">
          <div class="d-flex flex-column-reverse overflow-hidden">
            <a href="product_details.html" class="text-decoration-none">
              <ul class="list-unstyled text-center py-3">
                <li id="pd-listing-name">可口可樂 (罐裝)</li>
                <li id="pd-capacity">330 ml</li>
                <li id="pd-price" class="mt-2">HKD $4.00</li>
              </ul>
            </a>
            <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
              <div class="pd-p-inner flex-column">
                <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
              </div>
            </div>
          </div>
          <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
        </span>

                    <span class="col pd-listing-each text-center my-4">
          <div class="d-flex flex-column-reverse overflow-hidden">
            <a href="product_details.html" class="text-decoration-none">
              <ul class="list-unstyled text-center py-3">
                <li id="pd-listing-name">可口可樂 (罐裝)</li>
                <li id="pd-capacity">330 ml</li>
                <li id="pd-price" class="mt-2">HKD $4.00</li>
              </ul>
            </a>
            <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
              <div class="pd-p-inner flex-column">
                <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
              </div>
            </div>
          </div>
          <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
        </span>

                    <span class="col pd-listing-each text-center my-4">
          <div class="d-flex flex-column-reverse overflow-hidden">
            <a href="product_details.html" class="text-decoration-none">
              <ul class="list-unstyled text-center py-3">
                <li id="pd-listing-name">可口可樂 (罐裝)</li>
                <li id="pd-capacity">330 ml</li>
                <li id="pd-price" class="mt-2">HKD $4.00</li>
              </ul>
            </a>
            <div class="pd-p" style="background-image:url('images/dummy_pd_p1.png')">
              <div class="pd-p-inner flex-column">
                <button type="button" class="btn btn-primary text-white fa fa-search my-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#pdQuickModal">&nbsp; 快速預覽</button>
                <button type="button" class="btn btn-primary text-white fa fa-heart my-2" data-bs-toggle="modal" data-bs-target="#collectionModal">&nbsp; 收藏</button>
              </div>
            </div>
          </div>
          <button class="btn btn-primary text-white fa fa-shopping-cart text-nowrap">&nbsp; 加入購物車</button>
        </span>


                </div>
                <div class="row py-4 my-4">
                    <a href="product_listing.html" class="btn btn-primary mx-auto col-6 col-sm-4 col-md-4 col-lg-2">查看全部商品</a>
                </div>
            </div>

        </div>
        <!-- end of latest products -->
    </div>
@endsection
@push('js')
    <script>
        $(".owl-carousel").owlCarousel({
            margin: 10,
            responsiveClass: true,
            dots: true,
            navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
            dotsContainer: '#dots',
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                750: {
                    items: 3,
                    nav: false
                },
            }
        });
    </script>
@endpush
