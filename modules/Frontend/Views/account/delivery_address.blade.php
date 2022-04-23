@extends('Base::frontend.master')
@php($auth = auth('web')->user())
@section('content')
    <section class="bg-ccdae0 py-4 py-md-5">
        <div class="container">
            <div class="row">
                <!-- account sidebar -->
                @include('Frontend::account.menu')
                <div class="col-md-9">
                    <div class="card rounded">
                        <div class="card-body p-4 p-sm-5 col-12 col-md-12 col-lg-8 col-xl-9 mx-auto">
                            <h3 class=""><b>送貨地址</b></h3>
                            <h4 class="my-3"><b>已儲存地址 1</b></h4>
                            <!-- delivery address form -->
                            <form action="" method="post" id="profile" class="my-3 my-sm-4">

                                <div class="mb-3">
                                    <label for="name" class="col col-form-label">收貨人姓名*</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="name" placeholder="例如: 陳大文">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="tel" class="col col-form-label">聯絡電話*</label>
                                    <div class="col">
                                        <input type="tel" class="form-control" id="tel" placeholder="9123 4567">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address1" class="col col-form-label">地址</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="address1" placeholder="大廈名稱/樓宇/室">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address2" class="col col-form-label">地區*</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="address2" placeholder="地區/街道">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="col col-form-label">區域*</label>
                                    <div class="col-6 col-md-4 col-xl-3">
                                        <select class="form-select" aria-label="region">
                                            <option value="hk">港島區</option>
                                            <option value="kw">九龍區</option>
                                            <option value="nt">新界區</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 clearfix">
                                    <!-- remove data-bs-toggle="modal" data-bs-target="#saveModal" to stop the modal being callout everytime -->
                                    <!-- button type should be type="submit" -->
                                    <button type="button" class="btn btn-primary py-0 mt-3 col-3 col-md-2 float-end" data-bs-toggle="modal" data-bs-target="#saveModal">儲存</button>
                                </div>

                            </form>
                            <!-- end of delivery address form -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
@endpush
