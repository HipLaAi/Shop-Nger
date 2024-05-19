@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách đơn đặt hàng</li>
        <li class="breadcrumb-item"><a href="#">Chi tiết đơn đặt hàng</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Chi tiết đơn đặt hàng</h3>
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
                <a class="btn btn-add btn-sm" href=""><i class="fa fa-info-circle"></i> Chi tiết sản phẩm</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" href=""><i class="fa fa-info-circle"></i> Chi tiết ảnh</a>
              </div>
            </div>

            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                  <tr>
                      <th style="text-align: center">Sản phẩm</th>
                      <th style="text-align: center">Kích cỡ</th>
                      <th style="text-align: center">Màu sắc</th>
                      <th style="text-align: center">Số lượng</th>
                      <th style="text-align: center">Đơn giá</th>
                      <th style="text-align: center">Thành tiền</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($orderDetail as $item)
                      <tr>
                      <td style="text-align: center">{{ $item->name_product }}</td>
                      <td style="text-align: center">{{$item->size}}</td>
                      <td style="text-align: center">{{$item->color}}</td>
                      <td style="text-align: center">{{$item->quantity}}</td>
                      <td style="text-align: center">{{ number_format($item->discount) }} VNĐ</td>
                      <td style="text-align: center">{{ number_format($item->total) }} VNĐ</td>
                  </tr>   
                  @endforeach     
              </tbody>
           </table>
           <form action="" class="row">
              <div class="form-group col-md-4">
                <label class="control-label">Tên khách hàng: {{$order->fullname}}</label>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Email: {{$order->email}}</label>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Số điện thoại: {{$order->phone}}</label>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Xã/Thị trấn: {{$order->ward}}</label>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Huyện/Quận: {{$order->district}}</label>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Tỉnh/Thành phố: {{$order->province}}</label>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Chi tiết địa chỉ: {{$order->address}}</label>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Đường/Quốc lộ: {{$order->street}}</label>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Mã bưu điện: {{$order->zip}}</label>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Tổng tiền: {{number_format($order->moneytotal)}} VNĐ</label>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Phương thức thanh toán: </label>
                  @if($order->pay == 0)
                  <span class="badge bg-info">Thanh toán khi nhận hàng</span>
                  @elseif($order->pay == 1)
                  <span class="badge bg-warning">Thanh toán online</span>
                  @endif
              </div>
              <div class="form-group col-md-4">
              <label class="control-label">Trạng thái:</label>
                @if($order->status == 0)
                <span class="badge bg-info">Chờ xử lý</span>
                @elseif($order->status == 1)
                <span class="badge bg-warning">Đang vận chuyển</span>
                @elseif($order->status == 2)
                <span class="badge bg-success">Đã hoàn thành</span>
                @elseif($order->status == 3)
                <span class="badge bg-danger">Đã hủy</span>
                @endif
              </div>
          </div>
    </div>
</main>
@endsection