@extends('user.layout')
@section('content')
	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Đặt hàng</h1>
					<nav class="d-flex align-items-center">
						<a href="">Trang chủ<span class="lnr lnr-arrow-right"></span></a>
                        <a href="checkout">Thanh toán<span class="lnr lnr-arrow-right"></span></a>
                        <a style="color:white">Đặt hàng</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Order Details Area =================-->
	<section class="order_details section_gap">
		<div class="container">
			<h3 class="title_confirmation">Trân thành cảm ơn! Đơn đặt hàng của bạn đang đợi xét duyệt</h3>
			<div class="row order_d_inner">
				<div class="col-lg-6">
					<div class="details_item">
						<h4>Thông tin đặt hàng</h4>
						<ul class="list">
							<li><a><span>Họ tên khách hàng</span> : {{ $saleBill->fullname }}</a></li>
							<li><a><span>Email</span> : {{ $saleBill->email }}</a></li>
							<li><a><span>Số điện thoại</span> : {{ $saleBill->phone }}</a></li>
							<li><a><span>Tổng tiền</span> : {{ number_format($saleBill->moneytotal) }} VNĐ</a></li>
                            <li><a><span>Ngày đặt</span> : {{ $saleBill->created_at }}</a></li>
                            <li><a><span>Thanh toán</span> : Trực tiếp</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="details_item">
						<h4>Địa chỉ thanh toán/nhận hàng</h4>
						<ul class="list">
							<li><a><span>Tỉnh/Thành phố</span> : {{ $saleBill->province }}</a></li>
							<li><a><span>Huyện/Quận</span> : {{ $saleBill->district }}</a></li>
							<li><a><span>Xã/Thị trấn</span> : {{ $saleBill->ward }}</a></li>
							<li><a><span>Đường/Quốc lộ</span> : {{ $saleBill->street }}</a></li>
                            <li><a><span>Mã bưu điện</span> : {{ $saleBill->zip }}</a></li>
                            <li><a><span>Địa chỉ chi tiết</span> : {{ $saleBill->address }}</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="order_details_table">
				<h2>Chi tiết đơn hàng</h2>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Sản phẩm</th>
                                <th scope="col">Màu sắc</th>
                                <th scope="col">Kích cỡ</th>
								<th scope="col">Số lượng</th>
								<th scope="col">Thành tiền (VNĐ)</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($saleBillDetail as $item)
							<tr>
								<td>
									<p>{{ $item->name_product }}</p>
								</td>
                                <td>
									<p>{{ $item->color }}</p>
								</td>
                                <td>
									<p>{{ $item->size }}</p>
								</td>
								<td>
									<h5>x {{ $item->quantity }}</h5>
								</td>
								<td>
									<p>{{ number_format($item->total) }}</p>
								</td>
							</tr>
                            @endforeach
							<tr>
								<td>
									<h4>Tổng tiền</h4>
								</td>
                                <td>
									<p></p>
								</td>
                                <td>
									<p></p>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p>{{ number_format($saleBill->moneytotal) }}</p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	<!--================End Order Details Area =================-->
    @endsection