@extends('user.layout')
@section('content')
    <!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Cửa hàng</h1>
					<nav class="d-flex align-items-center">
						<a href="">Trang chủ<span class="lnr lnr-arrow-right"></span></a>
						<a style="color:white">Cửa hàng</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<div class="container">
		<div class="row" style="margin-top: 10px;">
            <!-- Start Sidebar Left -->
            @include('user.shop.sidebar')
            <!-- End Sidebar Left -->
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting mr-auto">
                    <form action="">
                        <select name="perPage" onchange="this.form.submit()">
                            <option value="9" {{ request('perPage') == 9 ? 'selected' : '' }}>9</option>
                            <option value="15" {{ request('perPage') == 15 ? 'selected' : '' }}>15</option>
                            <option value="27" {{ request('perPage') == 27 ? 'selected' : '' }}>27</option>
                        </select>
                    </form>
					</div>
					<div class="pagination">
                    @if($product->currentPage() > 1)
                        <a href="{{ $product->previousPageUrl() }}" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                    @else
                        <a class="next-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true" style="opacity:0.2"></i></a>
                    @endif
                    @for ($i = 1; $i <= $product->lastPage(); $i++)
                        <a href="{{ $product->url($i) }}" class="{{ request()->input('page',1)==$i ? 'active':'' }}">{{ $i }}</a>
                    @endfor
                    @if($product->hasMorePages())
                        <a href="{{ $product->nextPageUrl() }}" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    @else
                        <a class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true" style="opacity:0.2"></i></a>
                    @endif
                    </div>
				</div>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
                @include('user.shop.product')
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting mr-auto">
                    <form action="">
                        <select name="perPage" onchange="this.form.submit()">
                            <option value="9" {{ request('perPage') == 9 ? 'selected' : '' }}>9</option>
                            <option value="15" {{ request('perPage') == 15 ? 'selected' : '' }}>15</option>
                            <option value="27" {{ request('perPage') == 27 ? 'selected' : '' }}>27</option>
                        </select>
                    </form>
					</div>
					<div class="pagination">
                    @if($product->currentPage() > 1)
                        <a href="{{ $product->previousPageUrl() }}" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                    @else
                        <a class="next-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true" style="opacity:0.2"></i></a>
                    @endif
                    @for ($i = 1; $i <= $product->lastPage(); $i++)
                        <a href="{{ $product->url($i) }}" class="{{ request()->input('page',1)==$i ? 'active':'' }}">{{ $i }}</a>
                    @endfor
                    @if($product->hasMorePages())
                        <a href="{{ $product->nextPageUrl() }}" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    @else
                        <a class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true" style="opacity:0.2"></i></a>
                    @endif
                    </div>
				</div>
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>

	<!-- Start related-product Area -->
	@include('user.home.product_discount')
	<!-- End related-product Area -->
@endsection