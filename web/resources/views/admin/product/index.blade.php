@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Danh sách sản phẩm</b></a></li>
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
                        <!-- <div class="col-sm-2">
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
                        </div> -->
                      </div>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th style="text-align: center">Ảnh</th>
                                <th style="text-align: center">Tên sản phẩm</th>
                                <th style="text-align: center">Số lượng</th>
                                <th style="text-align: center">Tình trạng</th>
                                <th style="text-align: center">Giá tiền</th>
                                <th style="text-align: center">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $item)
                                <tr>
                                <td style="text-align: center"><img src="../images/{{$item->images[0]->image ?? ''}}" alt="" width="100px;"></td>
                                <td style="text-align: center">{{$item->name}}</td>
                                <td style="text-align: center">{{ number_format($item->productDetails->sum('quantity')) }}</td>
                                <td style="text-align: center">
                                    @if($item->productDetails->sum('quantity') > 50)
                                        <span class="badge bg-success">Còn hàng</span>
                                    @else
                                        <span class="badge bg-danger">Sắp hết hàng</span>
                                    @endif
                                </td>
                                <td style="text-align: center">{{ number_format($item->discount) }} VNĐ</td>
                                <td style="text-align: center">
                                    <form action="admin/product/{{ $item->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp" data-toggle="modal" data-target="#ModalUP"
                                            onclick="window.location.href='{{ url('admin/product/'.$item->id.'/edit') }}'"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-primary btn-sm trash" type="submit" title="Xóa"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')"><i class="fas fa-trash-alt"></i> 
                                        </button>
                                    </form>
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