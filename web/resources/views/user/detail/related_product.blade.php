<section class="related-product-area section_gap_bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Sản phẩm tương tự</h1>
                    <p>Sự lựa chọn hoàn hảo - Khám phá các sản phẩm tương tự, đáp ứng mọi nhu cầu thời trang của bạn.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                @foreach($relatedProduct as $item)
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                        <div class="single-related-product d-flex">
                            <a href="#"><img style="width:70px; height:70px" src="images/{{ $item->images[0]->image }}" alt=""></a>
                            <div class="desc">
                                <a href="product/{{ $item->id }}" class="title">{{ $item->name }}</a>
                                <div class="price">
                                    <h6>{{ number_format($item->discount) }} VNĐ</h6>
                                    <h6 class="l-through">{{ number_format($item->price) }} VNĐ</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                </div>
            </div>
        </div>
    </div>
</section>