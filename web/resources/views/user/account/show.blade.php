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
                        <a href="account">Tài khoản<span class="lnr lnr-arrow-right"></span></a>
                        <a style="color:white">Cài đặt nâng cao</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details" style="display: flex;justify-content: center;">
                @if($account->roleid != 1)
                <div>
                <form class="row contact_form" action="account/show" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="col-lg-12" style="width:780px">
                        <h3 style="width:100%">Cài đặt nâng cao tài khoản</h3>
                        <h5>Email liên kết</h5>
                        <div class="col-md-12 form-group p_star">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ $email }}" readonly>
                        </div>
                        <h5>Đổi mật khẩu</h5>
                        <div class="col-md-12 form-group p_star">
                            <label for="password">Mật khẩu cũ</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Nhập lại mật khẩu cũ" required>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <label for="newpassword">Mật khẩu mới</label>
                            <input id="newpassword" type="password" class="form-control" name="newpassword" placeholder="Nhập mật khẩu mới" required>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <label for="authpassword">Xác thực lại mật khẩu</label>
                            <input id="authpassword" type="password" class="form-control" name="authpassword" placeholder="Xác thực lại mật khẩu" required>
                        </div>
                        <div class="col-md-12 form-group p_star" style="display:flex;justify-content:space-between">
                            <button style="color:white" class="primary-btn" type="submit">Cập nhật tài khoản</button>
                        </div>
                    </div>
                </form>
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

@if (session('success'))
  <div class="alert alert-success">
    <script>
      alert("{{ session('success') }}");
    </script>
  </div>
@endif

@if (session('error'))
  <div class="alert alert-success">
    <script>
      alert("{{ session('error') }}");
    </script>
  </div>
@endif

@endsection