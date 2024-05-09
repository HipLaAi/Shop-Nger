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
                <div class="row">
                    <form class="row contact_form" action="account" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-8" style="width:780px">
                            <h3>Thông tin chi tiết tài khoản</h3>
                            <div class="col-md-12 form-group p_star">
                                <h5>Họ tên: </h5>
                                <input type="text" class="form-control" id="first" name="name" placeholder="Họ và tên" required value="{{ $account->name }}">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <h5>Email: </h5>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required value="{{ $account->email }}">
                            </div>
                            <div class="col-md-12 form-group p_star" style="display:flex;justify-content:space-between">
                                <button style="color:white" class="primary-btn" type="submit">Cập nhật tài khoản</button>
                                <!-- <a class="primary-btn" style="background:green;color:white">Kiểm tra đơn đặt hàng</a> -->
                                <!-- <a href="sign out" class="primary-btn" style="background:red;color:white">Đăng xuất</a> -->
                            </div>
                        </div>
                        <div class="col-lg-4" style="width:390px">
                            <div class="order_box">
                                <table class="table">
                                    <thead>
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
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
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