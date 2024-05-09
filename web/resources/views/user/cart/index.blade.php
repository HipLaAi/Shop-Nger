@extends('user.layout')
@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Chi tiết giỏ hàng</h1>
                    <nav class="d-flex align-items-center">
                        <a href="">Trang chủ<span class="lnr lnr-arrow-right"></span></a>
                        <a style="color:white">Giỏ hàng</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive" style="overflow-x:visible">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Chọn</th>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Kích cỡ</th>
                                <th scope="col">Màu sắc</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Thành tiền</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartDetail as $item)
                            <tr data-row="{{ $item->id }}">
                                <td>
                                <div class="disabled-checkbox">
                                    <input onchange="checkCart({{ $item->id }})" type="checkbox" id="disabled-checkbox-{{ $item->id }}" {{ $item->status == 1 ? 'checked' : '' }}>
									<label for="disabled-checkbox-{{ $item->id }}" style="border: 1px solid"></label>
								</div>
                                </td>
                                <td onclick="window.location.href='{{ url('product/'.$item->productDetails->products->id) }}'" style="cursor:pointer">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img style="width:100px;height:100px" src="images/{{ $item->productDetails->products->images[0]->image }}" alt="">
                                        </div>
                                        <div class="media-body">
                                            <p>{{ $item->productDetails->products->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <select id="size-{{$item->id}}" onchange="updateCart({{ $item->id }},(this.value),(document.getElementById('color-{{$item->id}}').value))">
                                        @php
                                            $usedSizes = [];
                                        @endphp

                                        @foreach($productDetail as $detail)
                                            @if($detail->proid == $item->productDetails->products->id && !in_array($detail->size, $usedSizes))
                                                <option value="{{ $detail->size }}" {{ $item->productDetails->size == $detail->size ? 'selected' : '' }}>{{ $detail->size }}</option>
                                                @php
                                                    $usedSizes[] = $detail->size;
                                                @endphp
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select id="color-{{$item->id}}" onchange="updateCart({{ $item->id }},(document.getElementById('size-{{$item->id}}').value),(this.value))">
                                        @php
                                            $usedColors = [];
                                        @endphp

                                        @foreach($productDetail as $detail)
                                            @if($detail->proid == $item->productDetails->products->id && !in_array($detail->color, $usedColors))
                                                <option value="{{ $detail->color }}" {{ $item->productDetails->color == $detail->color ? 'selected' : '' }}>{{ $detail->color }}</option>
                                                @php
                                                    $usedColors[] = $detail->color;
                                                @endphp
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <h5>{{ number_format($item->productDetails->products->discount) }}</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input data-id="{{ $item->id }}" type="text" name="qty" id="{{ $item->id }}" maxlength="12" value="{{ $item->quantity }}" title="Quantity:"
                                            class="input-text qty" onchange="editCart({{ $item->id }},parseInt(this.value),{{ $item->productDetails->products->discount }})">
                                        <button onclick="editCart({{ $item->id }},parseInt(document.getElementById('{{ $item->id }}').value) + 1,{{ $item->productDetails->products->discount }});
                                                var result = document.getElementById('{{ $item->id }}'); 
                                                var sst = result.value; 
                                                if( !isNaN( sst )) result.value++;
                                                return false;"
                                            class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                        <button onclick="editCart({{ $item->id }},parseInt(document.getElementById('{{ $item->id }}').value) - 1,{{ $item->productDetails->products->discount }});
                                                var result = document.getElementById('{{ $item->id }}'); 
                                                var sst = result.value; 
                                                if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;
                                                return false;"
                                            class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                    </div>
                                </td>
                                <td>
                                    <h5 class="total-{{$item->id}}">{{ number_format($item->productDetails->products->discount*$item->quantity) }}</h5>
                                </td>
                                <td>
                                    <a href="javascript:deleteCart({{ $item->id }})" class="genric-btn primary-border circle arrow">Xóa</a>
                                </td>
                            </tr>
                            @endforeach

                            <tr class="bottom_button">
                                <td></td>
                                <td>
                                    <!-- <a class="gray_btn">Cập nhật giỏ hàng</a> -->
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="cupon_text d-flex align-items-center">
                                        <input type="text" placeholder="Mã giảm giá">
                                        <a class="primary-btn">Áp dụng</a>
                                        <a class="gray_btn">Đóng</a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h4>Tổng tiền: </h4>
                                </td>
                                <td class="cart-total">
                                    <h4>{{ number_format($cartDetails->sum('total')) }}</h4>
                                </td>
                                <td>
                                    <h4>VNĐ</h4>
                                </td>
                            </tr>

                            <tr class="out_button_area">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="" style="width: 250px;">Tiếp tục mua sắm</a>
                                        <a class="primary-btn" href="checkout">Tiến hành thanh toán</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
    @endsection