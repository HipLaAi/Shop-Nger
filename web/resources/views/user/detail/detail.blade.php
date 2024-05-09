<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                @if(count($product->images) > 1)
                <div class="s_Product_carousel">
                @else
                <div class="Product_carousel">
                @endif
                @foreach($product->images as $item)
                    <div class="single-prd-item">
                        <img class="img-fluid" src="{{ asset('images/' . $item->image) }}" alt="">
                    </div>
                @endforeach
                </div>
            </div>


            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3>{{ $product->name }}</h3>
                    <h2>{{ number_format($product->discount) }} VNĐ</h2>
                    <ul class="list">
                        <li><a class="active"><span>Danh mục</span> : {{ $product->categories->name ?? '' }}</a></li>
                        <li><a class="active"><span>Thương hiệu</span> : {{ $product->brands->name ?? ''}}</a></li>
                    </ul>
                    <hr>

                    <div class="product_count" style="width: 100%;">
                        <h2>Màu sắc</h2>
                        <select name="color" class="get-color" onchange="getSize({{ $product->id }},(this.value))" id="get-color">
                            <option value="0">Chọn màu sắc</option>
                            @foreach(array_unique($product->productDetails->pluck('color')->toArray()) as $item)
                            @if($item != '')
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="product_count" style="width: 100%;">
                        <h2>Kích cỡ</h2>
                        <select name="size" class="get-size" id="get-size">
                            <option value="0">Chọn kích cỡ</option>
                            @foreach(array_unique($product->productDetails->pluck('size')->toArray()) as $item)
                            @if($item != '')
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endif                            
                            @endforeach
                        </select>
                    </div>

                    <div class="product_count">
                        <label for="qty">Số lượng:</label>
                        <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                            class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                            class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                    </div>
                    <div class="card_area d-flex align-items-center">
                        @if(auth()->check())
                            <button style="border:0" class="primary-btn" onclick="addCart({{ $product->id }},(document.getElementById('get-color').value),(document.getElementById('get-size').value),parseInt(document.getElementById('sst').value))">Thêm vào giỏ hàng</button>
                            <a class="icon_btn" href="javascript:addLove({{ $product->id }})"><i class="lnr lnr lnr-heart"></i></a>
                        @else
                            <a class="primary-btn" href="sign in" onclick="return confirm('Vui lòng đăng nhập để thực hiện hành động này')">Thêm vào giỏ hàng</button>
                            <a class="icon_btn" href="sign in" onclick="return confirm('Vui lòng đăng nhập để thực hiện hành động này')"><i class="lnr lnr lnr-heart"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>