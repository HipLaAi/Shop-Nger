<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="table-responsive">
        <table class="table">
            <tbody>
                <tr>
                    <td>
                        <h5>Kích cỡ</h5>
                    </td>
                    <td>
                        @foreach(array_unique($product->productDetails->pluck('size')->toArray()) as $item)
                            {{ $item . ',' }}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>Màu sắc</h5>
                    </td>
                    <td>
                        @foreach(array_unique($product->productDetails->pluck('color')->toArray()) as $item)
                            {{ $item . ',' }}
                        @endforeach                    
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>Danh mục</h5>
                    </td>
                    <td>
                        <h5>{{ $product->categories->name ?? '' }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>Thương hiệu</h5>
                    </td>
                    <td>
                        <h5>{{ $product->brands->name ?? '' }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>Kiểm tra chất lượng</h5>
                    </td>
                    <td>
                        <h5>Tốt</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>Đóng gói</h5>
                    </td>
                    <td>
                        <h5>Cẩn thận</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>Độ bền</h5>
                    </td>
                    <td>
                        <h5>Bền bỉ</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>Hướng dẫn chăm sóc</h5>
                    </td>
                    <td>
                        <h5>Hướng dẫn cách giặt, ủi và bảo quản sản phẩm</h5>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>