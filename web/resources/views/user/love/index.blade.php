@extends('user.layout')
@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Danh sách yêu thích</h1>
                    <nav class="d-flex align-items-center">
                        <a href="">Trang chủ<span class="lnr lnr-arrow-right"></span></a>
                        <a style="color:white">Yêu thích</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive" style="overflow-x:visible">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loveDetail as $item)
                            <tr data-row="{{ $item->id }}">
                                <td onclick="window.location.href='{{ url('product/'.$item->products->id) }}'" style="cursor:pointer">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img style="width:100px;height:100px" src="images/{{ $item->products->images[0]->image }}" alt="">
                                        </div>
                                        <div class="media-body">
                                            <p>{{ $item->products->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>{{ number_format($item->products->discount) }}</h5>
                                </td>
                                <td>
                                    <a href="javascript:deleteLove({{ $item->id }})" class="genric-btn primary-border circle arrow">Xóa</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
    @endsection