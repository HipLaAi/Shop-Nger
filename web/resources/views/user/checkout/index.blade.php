@extends('user.layout')
@section('content')
        <!-- Start Banner Area -->
        <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Thanh toán</h1>
                    <nav class="d-flex align-items-center">
                        <a href="">Trang chủ<span class="lnr lnr-arrow-right"></span></a>
                        <a style="color:white">Thanh toán</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <form class="row contact_form" action="checkout" method="POST">
                        @csrf
                        <div class="col-lg-8">
                            <h3>Chi tiết thanh toán</h3>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="first" name="name" placeholder="Họ và tên" required>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="number" name="phone" placeholder="Số điện thoại" required>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="province" name="province" placeholder="Tỉnh/Thành phố" required>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="district" name="district" placeholder="Huyện/Quận" required>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="ward" name="ward" placeholder="Xã/Thị trấn" required>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="street" name="street" placeholder="Đường/Quốc lộ" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" id="zip" name="zip" placeholder="Mã bưu điện" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <h3></h3>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="creat_account">
                                        <h3>Chi tiết vận chuyển</h3>
                                    </div>
                                    <textarea class="form-control" name="message" id="message" rows="1" placeholder="Ghi chú đặt hàng"></textarea>
                                </div>
                            
                        </div>
                        <div class="col-lg-4">
                            <div class="order_box">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Đơn hàng của bạn</th>
                                        </tr>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th colspan="2">Tổng tiền(VNĐ)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartDetails as $item)
                                        <tr>
                                            <td>
                                                {{ $item->productDetails->products->name }}
                                                <input type="hidden" class="form-control" name="name_product[]" value="{{ $item->productDetails->products->name }}">
                                            </td>
                                            <td>x{{ $item->quantity }}
                                                <input type="hidden" class="form-control" name="quantity[]" value="{{ $item->quantity }}">
                                            </td>
                                            <td>{{ number_format($item->total) }}
                                                <input type="hidden" class="form-control" name="total[]" value="{{ $item->total }}">
                                            </td>
                                            <input type="hidden" class="form-control" name="id[]" value="{{ $item->id }}">
                                            <input type="hidden" class="form-control" name="prodid[]" value="{{ $item->prodid }}">
                                            <input type="hidden" class="form-control" name="size[]" value="{{ $item->productDetails->size }}">
                                            <input type="hidden" class="form-control" name="color[]" value="{{ $item->productDetails->color }}">
                                            <input type="hidden" class="form-control" name="price[]" value="{{ $item->productDetails->products->price }}">
                                            <input type="hidden" class="form-control" name="discount[]" value="{{ $item->productDetails->products->discount }}">
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <ul class="list list_2">
                                    <li style="justify-content: space-between;display: flex;">
                                        <a>
                                            Tổng tiền: 
                                        </a>
                                        <a>
                                            {{ number_format($cartDetails->sum('total'), 0) }} VNĐ
                                            <input type="hidden" class="form-control" name="totals" value="{{ $cartDetails->sum('total') }}">
                                        </a>
                                    </li>
                                </ul>
                                <div class="payment_item">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option5" name="pay" value="0">
                                        <label for="f-option5">thanh toán sau</label>
                                        <div class="check"></div>
                                    </div>
                                    <p>Vui lòng cung cấp đầy đủ thông tin về địa chỉ giao hàng để đảm bảo đơn hàng được giao đến đúng địa chỉ.</p>
                                </div>
                                <div class="payment_item active">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option6" name="pay" value="1">
                                        <label for="f-option6">thanh toán trực tuyến</label>
                                        <img src="user/img/product/card.jpg" alt="" style="right: 0;">
                                        <div class="check"></div>
                                    </div>
                                    <p>Thanh toán qua thẻ tín dụng</p>
                                </div>
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option4" name="selector">
                                    <label for="f-option4" style="font-size:11px">Tôi đã đọc và chấp nhận</label>
                                    <a href="#" style="font-size:11px">các điều khoản và điều kiện*</a>
                                </div>
                                <button class="primary-btn" type="submit">Đặt hàng</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
    @endsection