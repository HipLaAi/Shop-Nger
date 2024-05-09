@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="admin/product">Danh sách sản phẩm</a></li>
        <li class="breadcrumb-item"><a href="admin/product/{{ $product->id }}/edit">Sửa sản phẩm</a></li>
        <li class="breadcrumb-item"><a href="admin/product/{{ $product->id }}/detail">Chi tiết sản phẩm</a></li>
      </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
              <h3 class="tile-title">Sửa chi tiết sản phẩm</h3>
                <div class="tile-body">
                    <div class="row element-button">
                        <div class="col-sm-8">
                            <span>Danh mục: {{$product->categories->name}}</span><br>
                            <span>Thương hiệu: {{$product->brands->name ?? ''}}</span>
                        </div>
                        <div class="col-sm-4">
                            <h3>Tên sản phẩm: {{$product->name}}</h3>
                        </div>
                    </div>
                    <form action="admin/product/{{ $product->id }}/detail/{{ $productDetail->id }}" method="POST" class="row"
                        enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        <div class="form-group col-md-3">
                            <label for="exampleSelect1" class="control-label">Kích cỡ</label>
                            <input name="size" class="form-control" type="text" value="{{ $productDetail->size }}">
                        </div>
                        <div class="form-group col-md-3 ">
                            <label for="exampleSelect1" class="control-label">Màu sắc</label>
                            <input name="color" class="form-control" type="text" value="{{ $productDetail->color }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Số lượng</label>
                            <input name="quantity" class="form-control" type="number" value="{{ $productDetail->quantity }}">
                        </div>
                    </div>
                    <button class="btn btn-save" type="submit">Lưu lại</button>
                    <a class="btn btn-cancel" href="admin/product/{{ $product->id }}/detail">Hủy bỏ</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection