@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách sản phẩm</li>
        <li class="breadcrumb-item"><a href="#">Sửa sản phẩm</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Sửa sản phẩm</h3>
          <div class="tile-body">
            <div class="row element-button">
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" href="admin/category/create"><i
                    class="fas fa-folder-plus"></i> Thêm danh mục</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" href="admin/brand/create"><i
                    class="fas fa-folder-plus"></i> Thêm thương hiệu</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" href="admin/product/{{ $product->id }}/detail"><i class="fa fa-info-circle"></i> Chi tiết sản phẩm</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" href="admin/product/{{ $product->id }}/image"><i class="fa fa-info-circle"></i> Chi tiết ảnh</a>
              </div>
            </div>
            <form action="{{ route('product.update', $product->id) }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="form-group col-md-3">
              <label for="exampleSelect1" class="control-label">Danh mục</label>
                <select name="catid" class="form-control" id="exampleSelect1">
                <option value="0">-- Chọn danh mục --</option>
                 @foreach($category as $item)
                  <option value="{{ $item->id }}" {{ $item->id == $product->catid ? 'selected' : '' }}> {{$item->name}} </option>
                 @endforeach
                </select>
              </div>
              <div class="form-group col-md-3">
              <label for="exampleSelect1" class="control-label">Thương hiệu</label>
                <select name="brandid" class="form-control" id="exampleSelect1">
                <option value="0">-- Chọn thương hiệu --</option>
                 @foreach($brand as $item)
                  <option value="{{ $item->id }}" {{ $item->id == $product->brandid ? 'selected' : '' }}> {{$item->name}} </option>
                 @endforeach
                </select>
              </div>
              <div class="form-group col-md-3">
                <label class="control-label">Tên sản phẩm</label>
                <input value="{{$product->name}}" name="name" class="form-control" type="text">
              </div>
              <div class="form-group col-md-3">
                  <label for="exampleSelect1" class="control-label">Tình trạng</label>
                  <select name="status" class="form-control" id="exampleSelect1">
                      <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Còn hàng</option>
                      <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Hết hàng</option>
                  </select>
              </div>
              <div class="form-group col-md-3">
                <label class="control-label">Giá</label>
                <input value="{{$product->price}}" name="price" class="form-control" type="number">
              </div>
              <div class="form-group col-md-3">
                <label class="control-label">Giá khuyến mãi</label>
                <input value="{{$product->discount}}" name="discount" class="form-control" type="number">
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Mô tả sản phẩm</label>
                <textarea name="description" class="form-control" name="description" id="description">{!! $product->description !!}</textarea>
              </div>
          </div>
          <button class="btn btn-save" type="submit">Lưu lại</button>
          <a class="btn btn-cancel" href="admin/product">Hủy bỏ</a>
    </div>
</main>
@endsection