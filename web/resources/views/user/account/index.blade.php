@extends('user.layout')
@section('content')
        <!-- Start Banner Area -->
        <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Thông tin tài khoản</h1>
                    <nav class="d-flex align-items-center">
                        <a href="">Trang chủ<span class="lnr lnr-arrow-right"></span></a>
                        <a style="color:white">Tài khoản</a>
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
                @if($account->roleid != 1)
                <div class="row">
                    <div class="col-lg-8" style="width:780px">
                    <form class="row contact_form" action="account" method="POST" enctype="multipart/form-data">
                    @csrf
                        <h3 style="width:100%">Thông tin đơn hàng</h3>
                        <div class="col-md-12 form-group p_star" style="font-size:60px;display: flex; justify-content: space-around">
                            <span class="ti-home" style="text-align:center; position: relative">
                                <h5>Chờ xét duyệt</h5>
                                @if(count($orderWait) != 0)
                                <h5 style="position: absolute;
                                    right: 0;top: 0; 
                                    background: #ffba00a3;
                                    width: 25px;
                                    border-radius: 50%;
                                    font-size:20px">{{count($orderWait)}}</h5>
                                @endif
                            </span>
                            
                            <span class="ti-truck" style="text-align:center; position: relative">
                                <h5>Đang vận chuyển</h5>
                                @if(count($orderTransport) != 0)
                                <h5 style="position: absolute;
                                    right: 0;top: 0; 
                                    background: #ffba00a3;
                                    width: 25px;
                                    border-radius: 50%;
                                    font-size:20px">{{count($orderTransport)}}</h5>
                                @endif
                            </span>

                            <span class="ti-check" style="text-align:center; position: relative">
                                <h5>Đã nhận</h5>
                                @if(count($orderFinish) != 0)
                                <h5 style="position: absolute;
                                    right: 0;top: 0; 
                                    background: #ffba00a3;
                                    width: 25px;
                                    border-radius: 50%;
                                    font-size:20px">{{count($orderFinish)}}</h5>
                                @endif
                            </span>

                            <span class="ti-close" style="text-align:center; position: relative">
                                <h5>Đã hủy</h5>
                                @if(count($orderClose) != 0)
                                <h5 style="position: absolute;
                                    right: 0;top: 0; 
                                    background: #ffba00a3;
                                    width: 25px;
                                    border-radius: 50%;
                                    font-size:20px">{{count($orderClose)}}</h5>
                                @endif
                            </span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                        <h5>Đơn hàng chờ xác nhận</h5>
                        @if(count($orderWait) == 0)
                            <span>Không có đơn hàng nào</span>
                        @endif
                        @foreach($orderWait as $items)
                        @csrf
                            <div style="margin-top:50px; background:#92909026; padding: 10px">
                                <input type="hidden" name="saleid" value="{{ $items->id }}">
                                <span>Họ tên khách hàng: {{ $items->fullname }}</span><br>
                                <span>Địa chỉ: {{ $items->ward . ' - ' . $items->district . ' - ' . $items->province }}</span><br>
                                <span>Số điện thoại: {{ $items->phone }}</span><br>
                                <span>Tổng tiền: {{ number_format($items->moneytotal) }} VNĐ</span><br>
                                <span>Phương thức thanh toán: 
                                    @if($items->pay == 0)
                                        Thanh toán sau khi nhận hàng
                                    @else
                                        Thanh toán online
                                    @endif
                                </span>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Kích cỡ</th>
                                            <th>Màu sắc</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orderWaitDetail->where('saleid', $items->id) as $item)
                                            <tr>
                                                <td>{{ $item->name_product }}</td>
                                                <td>{{ $item->size }}</td>
                                                <td>{{ $item->color }}</td>
                                                <td>{{ number_format($item->quantity) }}</td>
                                                <td>{{ number_format($item->discount) }}</td>
                                                <td>{{ number_format($item->total) }}</td>
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <td colspan=3></td>
                                                <td colspan=3>
                                                    <button style="background:red" class="primary-btn" type="submit" name="action" value="cancel">Hủy đơn hàng</button>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                        @endforeach
                        </div>
                        <!-- <div class="col-md-12 form-group p_star" style="display:flex;justify-content:space-between">
                            <button style="color:white" class="primary-btn" type="submit">Cập nhật tài khoản</button>
                        </div> -->
                    </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <table class="table">
                            <form action="account" method="POST" enctype="multipart/form-data">
                            @csrf
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="list-input-hidden-upload">
                                                <h5>Họ tên: </h5>
                                                <input type="text" class="form-control" id="first" name="name" placeholder="Họ và tên" required value="{{ $account->name }}">
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="list-input-hidden-upload">
                                                <input style="display:none" type="file" name="image" id="file_upload" class="myfrm form-control hidden">
                                            </div>
                                            <div class="input-group-btn">
                                                <button class="btn btn-success btn-add-image" type="button" style="border: 0;background-color: #ffba00;cursor: pointer;"><i class="fas fa-cloud-upload-alt"></i>Chọn ảnh đại diện</button>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="list-images" style="display:flex;flex-wrap: wrap;justify-content:center">
                                                <div class="box-image" style="position: relative; margin:6px">
                                                    <img style="width: 200px;height:200px;border-radius:50%;object-fit: cover;" src="images/{{ $account->avatar }}" class="picture-box">
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="col-md-12 form-group p_star">
                                                <button class="primary-btn" type="submit" style="width:100%; border-radius:5px; border:0; margin-bottom:15px">Cập nhật tài khoản</button>
                                                <a class="primary-btn" style="background:red;color:white; border-radius:5px" href="account/show">Cập nhật nâng cao</a>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                            </form>
                            </table>
                        </div>
                    </div>
                </div>
                @else
                <div class="row" style="justify-content:center">
                    <h3 style="color:green">Bạn đang sử dụng tài khoản với tư cách là admin</h3>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
    @endsection

    @section('script')
<script>
$(document).ready(function() {
    $(".btn-add-image").click(function(){
        $('#file_upload').trigger('click');
    });

    $('.list-input-hidden-upload').on('change', '#file_upload', function(event){
        let today = new Date();
        let time = today.getTime();
        let image = event.target.files[0];
        let file_name = event.target.files[0].name;
        $('.list-images').empty();
        let box_image = $('<div class="box-image" style="position: relative; margin:6px"></div>');
        box_image.append('<img style="width: 200px;height:200px;border-radius:50%;object-fit: cover;" src="' + URL.createObjectURL(image) + '" class="picture-box">');
        $(".list-images").append(box_image);
    });
});
</script>
@endsection