@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Danh sách đơn đặt hàng</b></a></li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="row element-button">
                        <div class="col-sm-2">
                          <a class="btn btn-add btn-sm" href="admin/product/create" title="Thêm"><i class="fas fa-plus"></i>
                            Tạo mới sản phẩm</a>
                        </div>
                        <div class="col-sm-2">
                          <a class="btn btn-delete btn-sm nhap-tu-file" type="button" title="Nhập" onclick="myFunction(this)"><i
                              class="fas fa-file-upload"></i> Tải từ file</a>
                        </div>
          
                        <div class="col-sm-2">
                          <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i
                              class="fas fa-print"></i> In dữ liệu</a>
                        </div>
                        <div class="col-sm-2">
                          <a class="btn btn-delete btn-sm print-file js-textareacopybtn" type="button" title="Sao chép"><i
                              class="fas fa-copy"></i> Sao chép</a>
                        </div>
          
                        <div class="col-sm-2">
                          <a class="btn btn-excel btn-sm" href="" title="In"><i class="fas fa-file-excel"></i> Xuất Excel</a>
                        </div>
                        <div class="col-sm-2">
                          <a class="btn btn-delete btn-sm pdf-file" type="button" title="In" onclick="myFunction(this)"><i
                              class="fas fa-file-pdf"></i> Xuất PDF</a>
                        </div>
                        <div class="col-sm-2">
                          <a class="btn btn-delete btn-sm" type="button" title="Xóa" onclick="myFunction(this)"><i
                              class="fas fa-trash-alt"></i> Xóa tất cả </a>
                        </div>
                      </div>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th style="text-align: center">Tên khách hàng</th>
                                <th style="text-align: center">Địa chỉ</th>
                                <th style="text-align: center">Tổng tiền</th>
                                <th style="text-align: center">Trạng thái</th>
                                <th style="text-align: center">Ngày tạo</th>
                                <th style="text-align: center">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $item)
                                <tr>
                                <td style="text-align: center">{{ $item->fullname }}</td>
                                <td style="text-align: center">{{$item->ward}} - {{$item->district}} - {{$item->province}}</td>
                                <td style="text-align: center">{{ number_format($item->moneytotal) }} VNĐ</td>
                                <td style="text-align: center">
                                    @if($item->status == 1)
                                        <span class="badge bg-success">Đang vận chuyển</span>
                                    @elseif($item->status == 0)
                                        <span class="badge bg-danger">Giao hàng thành công</span>
                                    @endif
                                </td>
                                <td style="text-align: center">{{ $item->created_at }}</td>
                                <td style="text-align: center">
                                    <button class="btn btn-primary btn-sm edit" type="button" title="Chi tiết" id="show-emp" data-toggle="modal" data-target="#ModalUP"
                                        onclick="window.location.href='{{ url('admin/order/'.$item->id) }}'"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>   
                            @endforeach     
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection