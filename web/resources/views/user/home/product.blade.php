<section class="owl-carousel active-product-area section_gap">

    <div class="single-product-slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Sản phẩm mới nhất</h1>
                        <p>Phong cách mới mỗi khi bạn muốn</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($latestProduct as $item)
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <img class="img-fluid" src="images/{{ $item->images[0]->image ?? ''}}" alt="">
                        <div class="product-details">
                            <h6>{{ $item->name }}</h6>
                            <div class="price">
                                <h6>{{ number_format($item->discount) }} VNĐ</h6>
                                <h6 class="l-through">{{ number_format($item->price) }} VNĐ</h6>
                            </div>
                            <div class="prd-bottom">
                                <!-- Cart -->
                                @if(auth()->check())
                                <a href="javascript:addCart({{ $item->id }},null,null,1)" class="social-info">
                                    <span class="ti-bag"></span>
                                    <p class="hover-text">Giỏ hàng</p>
                                </a>
                                @else
                                <a href="sign in" class="social-info" onclick="return confirm('Vui lòng đăng nhập để thực hiện hành động này')">
                                    <span class="ti-bag"></span>
                                    <p class="hover-text">Giỏ hàng</p>
                                </a>
                                @endif
                                <!-- Love -->
                                @if(auth()->check())
                                    <a href="javascript:addLove({{ $item->id }})" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Yêu thích</p>
                                    </a>
                                @else
                                <a href="sign in" class="social-info" onclick="return confirm('Vui lòng đăng nhập để thực hiện hành động này')">
                                    <span class="lnr lnr-heart"></span>
                                    <p class="hover-text">Yêu thích</p>
                                </a>
                                @endif
                                <!-- Detail -->
                                <a href="product/{{ $item->id }}" class="social-info">
                                    <span class="lnr lnr-move"></span>
                                    <p class="hover-text">Chi tiết</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="single-product-slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Sản phẩm bán chạy</h1>
                        <p>Dẫn đầu xu hướng</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($bestSellingProducts as $item)
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <img class="img-fluid" src="images/{{ $item->images[0]->image ?? ''}}" alt="">
                        <div class="product-details">
                            <h6>{{ $item->name }}</h6>
                            <div class="price">
                                <h6>{{ number_format($item->discount) }} VNĐ</h6>
                                <h6 class="l-through">{{ number_format($item->price) }} VNĐ</h6>
                            </div>
                            <div class="prd-bottom">
                                <!-- Cart -->
                                @if(auth()->check())
                                <a href="javascript:addCart({{ $item->id }},null,null,1)" class="social-info">
                                    <span class="ti-bag"></span>
                                    <p class="hover-text">Giỏ hàng</p>
                                </a>
                                @else
                                <a href="sign in" class="social-info" onclick="return confirm('Vui lòng đăng nhập để thực hiện hành động này')">
                                    <span class="ti-bag"></span>
                                    <p class="hover-text">Giỏ hàng</p>
                                </a>
                                @endif
                                <!-- Love -->
                                @if(auth()->check())
                                    <a href="javascript:addLove({{ $item->id }})" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Yêu thích</p>
                                    </a>
                                @else
                                <a href="sign in" class="social-info" onclick="return confirm('Vui lòng đăng nhập để thực hiện hành động này')">
                                    <span class="lnr lnr-heart"></span>
                                    <p class="hover-text">Yêu thích</p>
                                </a>
                                @endif
                                <!-- Detail -->
                                <a href="product/{{ $item->id }}" class="social-info">
                                    <span class="lnr lnr-move"></span>
                                    <p class="hover-text">Chi tiết</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="single-product-slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Sản phẩm yêu thích</h1>
                        <p>Mọi người đều thèm muốn</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($mostLovedProducts as $item)
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <img class="img-fluid" src="images/{{ $item->images[0]->image ?? ''}}" alt="">
                        <div class="product-details">
                            <h6>{{ $item->name }}</h6>
                            <div class="price">
                                <h6>{{ number_format($item->discount) }} VNĐ</h6>
                                <h6 class="l-through">{{ number_format($item->price) }} VNĐ</h6>
                            </div>
                            <div class="prd-bottom">
                                <!-- Cart -->
                                @if(auth()->check())
                                <a href="javascript:addCart({{ $item->id }},null,null,1)" class="social-info">
                                    <span class="ti-bag"></span>
                                    <p class="hover-text">Giỏ hàng</p>
                                </a>
                                @else
                                <a href="sign in" class="social-info" onclick="return confirm('Vui lòng đăng nhập để thực hiện hành động này')">
                                    <span class="ti-bag"></span>
                                    <p class="hover-text">Giỏ hàng</p>
                                </a>
                                @endif
                                <!-- Love -->
                                @if(auth()->check())
                                    <a href="javascript:addLove({{ $item->id }})" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Yêu thích</p>
                                    </a>
                                @else
                                <a href="sign in" class="social-info" onclick="return confirm('Vui lòng đăng nhập để thực hiện hành động này')">
                                    <span class="lnr lnr-heart"></span>
                                    <p class="hover-text">Yêu thích</p>
                                </a>
                                @endif
                                <!-- Detail -->
                                <a href="product/{{ $item->id }}" class="social-info">
                                    <span class="lnr lnr-move"></span>
                                    <p class="hover-text">Chi tiết</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</section>
