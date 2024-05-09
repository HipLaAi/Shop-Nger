@extends('user.layout')
@section('content')
        <!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Liên hệ</h1>
					<nav class="d-flex align-items-center">
						<a href="">Trang chủ<span class="lnr lnr-arrow-right"></span></a>
						<a style="color:white">Liên hệ</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Contact Area =================-->
	<section class="contact_area section_gap_bottom">
		<div class="container">
			<!-- <div id="mapBox" class="mapBox" data-lat="21.0285" data-lon="105.8542" data-zoom="10" data-info="Hà Nội, Việt Nam" data-mlat="40.701083" data-mlon="-74.1522848"></div> -->
			<div id="mapBox" class="mapBox" data-lat="20.84149" data-lon="106.017332" data-zoom="13" data-info="Thành phố Hưng Yên, Việt Nam" data-mlat="40.701083" data-mlon="-74.1522848"></div>
			<div class="row">
				<div class="col-lg-3">
					<div class="contact_info">
						<div class="info_item">
							<i class="lnr lnr-home"></i>
							<h6>Hung Yen University of Technology and Education</h6>
							<p></p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-phone-handset"></i>
							<h6>(+84) 0901519038</h6>
							<p>Hỗ trợ (24/7)</p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-envelope"></i>
							<h6>gvenh59@gmail.com</h6>
							<p>Liên hệ với chúng tôi!</p>
						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<form class="row contact_form" action="" id="contactForm" novalidate="novalidate">
						<div class="col-md-6">
							<div class="form-group" style="margin-top: 10px;">
								<input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập tên'">
							</div>
							<div class="form-group" style="margin-top: 30px;">
								<input type="email" class="form-control" id="email" name="email" placeholder="Nhập địa chỉ email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập địa chỉ email'">
							</div>
							<div class="form-group" style="margin-top: 30px;">
								<input type="text" class="form-control" id="subject" name="subject" placeholder="Nhập tiêu đề" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập tiêu đề'">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<textarea style="height:175px; margin-top: 10px;" class="form-control" name="message" id="message" rows="1" placeholder="Nhập nội dung" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập nội dung'"></textarea>
							</div>
						</div>
						<div class="col-md-12 text-right">
							<button type="button" value="submit" class="primary-btn">Gửi</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!--================Contact Area =================-->
    @endsection