@extends('user.layout')
@section('content')
    <!-- Start slide Area -->
    @include('user.home.slide')
	<!-- End slide Area -->

	<!-- Start features Area -->
	<section class="features-area section_gap">
		<div class="container">
			<div class="row features-inner">
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="user/img/features/f-icon1.png" alt="">
						</div>
						<h6>Giao hàng miễn phí</h6>
						<p>Miễn phí vận chuyển cho mọi đơn hàng</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="user/img/features/f-icon2.png" alt="">
						</div>
						<h6>Chính sách hoàn trả</h6>
						<p>Hài lòng hoặc hoàn tiền</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="user/img/features/f-icon3.png" alt="">
						</div>
						<h6>Hỗ trợ tư vấn 24/7</h6>
						<p>Luôn sẵn sàng để giúp đỡ bạn</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="user/img/features/f-icon4.png" alt="">
						</div>
						<h6>Thanh toán an toàn</h6>
						<p>Tin cậy mọi lúc</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End features Area -->

	<!-- Start category Area -->
    @include('user.home.category')
	<!-- End category Area -->

	<!-- start product Area -->
    @include('user.home.product')
	<!-- end product Area -->

	<!-- Start exclusive deal Area -->
	<section class="exclusive-deal-area">
		<div class="container-fluid">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-6 no-padding exclusive-left">
					<div class="row clock_sec clockdiv" id="clockdiv">
						<div class="col-lg-12">
							<h1>Ưu đãi hấp dẫn độc quyền sắp kết thúc!</h1>
							<p></p>
						</div>
						<div class="col-lg-12">
							<div class="row clock-wrap">
								<div class="col clockinner1 clockinner">
									<h1 class="days">150</h1>
									<span class="smalltext">Days</span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="hours">23</h1>
									<span class="smalltext">Hours</span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="minutes">47</h1>
									<span class="smalltext">Mins</span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="seconds">59</h1>
									<span class="smalltext">Secs</span>
								</div>
							</div>
						</div>
					</div>
					<a href="" class="primary-btn">Cửa hàng</a>
				</div>
				<div class="col-lg-6 no-padding exclusive-right">
					<div class="active-exclusive-product-slider">
						@foreach($product as $item)
						<!-- single exclusive carousel -->
						<div class="single-exclusive-slider">
							<img class="img-fluid" src="images/{{ $item->images[0]->image }}" alt="">
							<div class="product-details">
								<div class="price">
									<h6>{{ number_format($item->discount) }} VNĐ</h6>
									<!-- <h6 class="l-through">{{ number_format($item->price) }}</h6> -->
								</div>
								<h4>{{ $item->name }}</h4>
								<div class="add-bag d-flex align-items-center justify-content-center">
									@if(auth()->check())
										<a class="add-btn" href="javascript:addCart({{ $item->id }})"><span class="ti-bag"></span></a>
										<span class="add-text text-uppercase">Thêm vào giỏ hàng</span>
									@else
										<a class="add-btn" href="sign in" onclick="return confirm('Vui lòng đăng nhập để thực hiện hành động này')"><span class="ti-bag"></span></a>
										<span class="add-text text-uppercase">Thêm vào giỏ hàng</span>
									@endif
								</div>
							</div>
						</div>
						@endforeach
						<!-- single exclusive carousel -->
						<!-- <div class="single-exclusive-slider">
							<img class="img-fluid" src="img/product/e-p1.png" alt="">
							<div class="product-details">
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<h4>addidas New Hammer sole
									for Sports person</h4>
								<div class="add-bag d-flex align-items-center justify-content-center">
									<a class="add-btn" href=""><span class="ti-bag"></span></a>
									<span class="add-text text-uppercase">Add to Bag</span>
								</div>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End exclusive deal Area -->

	<!-- Start brand Area -->
    @include('user.home.brand')
	<!-- End brand Area -->

	<!-- Start related-product Area -->
    @include('user.home.product_discount')
	<!-- End related-product Area -->
@endsection